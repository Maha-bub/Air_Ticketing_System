<?php

namespace App\Services;

use Illuminate\Support\Str;

/**
 * Simulated card gateway for local/demo checkout.
 *
 * Accepts Stripe-style sandbox test cards without calling an external API.
 */
class SandboxCardPaymentService
{
    public const SUCCESS_CARD = '4242424242424242';

    public const DECLINE_CARD = '4000000000000002';

    public function process(array $cardData, float $amount): array
    {
        $number = preg_replace('/\D/', '', $cardData['card_number'] ?? '');
        $expiry = trim($cardData['card_expiry'] ?? '');
        $cvc = trim($cardData['card_cvc'] ?? '');
        $holder = trim($cardData['card_holder'] ?? '');

        if ($holder === '') {
            return ['success' => false, 'message' => 'Cardholder name is required.'];
        }

        if (! preg_match('/^(0[1-9]|1[0-2])\/(\d{2})$/', $expiry)) {
            return ['success' => false, 'message' => 'Use expiry format MM/YY.'];
        }

        if (! preg_match('/^\d{3,4}$/', $cvc)) {
            return ['success' => false, 'message' => 'Enter a valid CVC.'];
        }

        if ($number === self::DECLINE_CARD) {
            return ['success' => false, 'message' => 'Card declined (sandbox test card).'];
        }

        if ($number !== self::SUCCESS_CARD) {
            return [
                'success' => false,
                'message' => 'Sandbox mode: use test card 4242 4242 4242 4242.',
            ];
        }

        $transactionId = 'SANDBOX-CARD-'.strtoupper(Str::random(12));

        return [
            'success' => true,
            'transaction_id' => $transactionId,
            'reference' => 'SANDBOX-'.now()->format('YmdHis'),
            'amount' => $amount,
        ];
    }
}
