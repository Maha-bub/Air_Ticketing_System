<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Thin wrapper around bKash's Tokenized Checkout API (v1.2.0-beta).
 *
 * Flow used by this app:
 *  1. grantToken()    — authenticate and get a short-lived id_token (cached).
 *  2. createPayment() — opens a payment session, returns a bKash-hosted
 *                        checkout URL to redirect the donor to.
 *  3. executePayment()— called from our callback route once bKash redirects
 *                        the donor back, to confirm the payment actually
 *                        completed before we write anything to our database.
 *
 * Docs: https://developer.bka.sh/docs/tokenized-checkout-overview
 */
class BkashService
{
    protected string $baseUrl;
    protected string $appKey;
    protected string $appSecret;
    protected string $username;
    protected string $password;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('services.bkash.base_url'), '/');
        $this->appKey = (string) config('services.bkash.app_key');
        $this->appSecret = (string) config('services.bkash.app_secret');
        $this->username = (string) config('services.bkash.username');
        $this->password = (string) config('services.bkash.password');
    }

    /**
     * Get a valid id_token, cached for slightly under bKash's ~60 minute
     * token lifetime so we don't call Grant Token on every request.
     */
    public function grantToken(): ?string
    {
        return Cache::remember('bkash_sandbox_id_token', now()->addMinutes(50), function () {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'username' => $this->username,
                'password' => $this->password,
            ])->post("{$this->baseUrl}/checkout/token/grant", [
                'app_key' => $this->appKey,
                'app_secret' => $this->appSecret,
            ]);

            if ($response->failed() || !$response->json('id_token')) {
                Log::warning('bKash grant token failed', ['body' => $response->body()]);
                return null;
            }

            return $response->json('id_token');
        });
    }

    /**
     * Start a new payment session. Returns the full bKash response (which
     * includes `paymentID` and `bkashURL`) or null on failure.
     */
    public function createPayment(float $amount, string $invoiceNumber, string $payerReference, string $callbackUrl): ?array
    {
        $token = $this->grantToken();

        if (!$token) {
            return null;
        }

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => $token,
            'X-App-Key' => $this->appKey,
        ])->post("{$this->baseUrl}/checkout/create", [
            'mode' => '0011',
            'payerReference' => $payerReference,
            'callbackURL' => $callbackUrl,
            'amount' => number_format($amount, 2, '.', ''),
            'currency' => 'BDT',
            'intent' => 'sale',
            'merchantInvoiceNumber' => $invoiceNumber,
        ]);

        if ($response->failed()) {
            Log::warning('bKash create payment failed', ['body' => $response->body()]);
            return null;
        }

        $data = $response->json();

        // A successful create still comes back as HTTP 200 with an error
        // code inside the body (e.g. token expired), so double-check.
        if (empty($data['bkashURL']) || empty($data['paymentID'])) {
            Log::warning('bKash create payment returned no checkout URL', ['body' => $data]);
            return null;
        }

        return $data;
    }

    /**
     * Confirm/finalize a payment after the donor approves it on bKash's
     * hosted page and is redirected back to our callback route.
     */
    public function executePayment(string $paymentId): ?array
    {
        $token = $this->grantToken();

        if (!$token) {
            return null;
        }

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => $token,
            'X-App-Key' => $this->appKey,
        ])->post("{$this->baseUrl}/checkout/execute", [
            'paymentID' => $paymentId,
        ]);

        if ($response->failed()) {
            Log::warning('bKash execute payment failed', ['body' => $response->body()]);
            return null;
        }

        return $response->json();
    }

    /**
     * Look up the current status of a payment (useful for reconciliation
     * or if the donor's browser lost the callback redirect).
     */
    public function queryPayment(string $paymentId): ?array
    {
        $token = $this->grantToken();

        if (!$token) {
            return null;
        }

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => $token,
            'X-App-Key' => $this->appKey,
        ])->post("{$this->baseUrl}/checkout/payment/status", [
            'paymentID' => $paymentId,
        ]);

        if ($response->failed()) {
            return null;
        }

        return $response->json();
    }
}
