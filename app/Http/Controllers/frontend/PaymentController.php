<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\FlightSchedule;
use App\Services\BkashService;
use App\Services\BookingCheckoutService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function __construct(
        protected BkashService $bkash,
        protected BookingCheckoutService $checkout
    ) {}

    /**
     * bKash redirects here after the customer approves or cancels payment.
     */
    public function bkashCallback(Request $request): RedirectResponse
    {
        $paymentId = $request->query('paymentID');
        $status = $request->query('status');

        if (! $paymentId) {
            return redirect()->route('checkout')->with('error', 'bKash payment was cancelled.');
        }

        if ($status === 'cancel' || $status === 'failure') {
            session()->forget(['pending_checkout', 'bkash_payment_id']);

            return redirect()->route('checkout')->with('error', 'bKash payment was not completed.');
        }

        $pending = session('pending_checkout');

        if (! $pending) {
            return redirect()->route('cart')->with('error', 'Your checkout session expired. Please try again.');
        }

        $result = $this->bkash->executePayment($paymentId);

        if (! $result || ($result['transactionStatus'] ?? null) !== 'Completed') {
            Log::warning('bKash execute did not complete', ['result' => $result]);
            session()->forget(['pending_checkout', 'bkash_payment_id']);

            return redirect()->route('checkout')->with('error', 'bKash payment could not be confirmed. Please try again.');
        }

        $schedule = FlightSchedule::with('airplane')->find($pending['cart']['flight_schedule_id']);

        if (! $schedule) {
            session()->forget(['pending_checkout', 'bkash_payment_id', 'cart']);

            return redirect()->route('cart')->with('error', 'That flight is no longer available.');
        }

        $booking = $this->checkout->create(
            $pending,
            $schedule,
            $pending['cart'],
            [
                'payment_status' => 'paid',
                'payment_reference' => $result['merchantInvoiceNumber'] ?? $pending['invoice_number'],
                'payment_transaction_id' => $result['trxID'] ?? $paymentId,
            ]
        );

        if (! $booking) {
            return redirect()->route('cart')->with('error', 'Seat(s) were just booked by someone else. Please choose different seats.');
        }

        session()->forget(['pending_checkout', 'bkash_payment_id', 'cart']);

        return redirect()->route('booking.confirmation', $booking->id)
            ->with('success', 'Payment completed successfully via bKash sandbox.');
    }
}
