<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use App\Models\Booking;
use App\Models\FlightSchedule;
use App\Services\BkashService;
use App\Services\BookingCheckoutService;
use App\Services\SandboxCardPaymentService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class FrontendController extends Controller
{
    /**
     * Homepage: hero search form + a handful of real, bookable routes for
     * the "popular destinations" carousel.
     */
    public function index()
    {
        $airports = Airport::where('status', 'active')->orderBy('city')->get(['id', 'name', 'code', 'city', 'country']);

        $destinations = FlightSchedule::query()
            ->with(['route.airline', 'route.originAirport', 'route.destinationAirport', 'airplane'])
            ->where('status', 'scheduled')
            ->whereHas('route', fn($q) => $q->where('status', 'active'))
            ->orderBy('price')
            ->take(6)
            ->get();

        return Inertia::render('Home', [
            'airports' => $airports,
            'destinations' => $destinations->map->toCard(),
        ]);
    }

    /**
     * Dedicated "Destinations" page — every currently scheduled, active route.
     */
    public function destinations()
    {
        $destinations = FlightSchedule::query()
            ->with(['route.airline', 'route.originAirport', 'route.destinationAirport', 'airplane'])
            ->where('status', 'scheduled')
            ->whereHas('route', fn($q) => $q->where('status', 'active'))
            ->orderBy('price')
            ->get();

        return Inertia::render('Destinations', [
            'destinations' => $destinations->map->toCard(),
        ]);
    }

    /**
     * Flight search results — filtered by origin/destination city or airport
     * code and (optionally) a travel date. The date does not change which
     * schedules exist (this project does not track per-day flight instances),
     * it is passed through only so the booking form can echo it back to the
     * passenger.
     */
    public function searchFlights(Request $request)
    {
        $from = $request->query('from');
        $to = $request->query('to');
        $date = $request->query('date');
        $passengers = max(1, (int) $request->query('passengers', 1));

        $query = FlightSchedule::query()
            ->with(['route.airline', 'route.originAirport', 'route.destinationAirport', 'airplane'])
            ->where('status', 'scheduled')
            ->whereHas('route', fn($q) => $q->where('status', 'active'));

        if ($from) {
            $query->whereHas('route.originAirport', function ($q) use ($from) {
                $q->where('city', 'like', "%{$from}%")->orWhere('code', $from)->orWhere('name', 'like', "%{$from}%");
            });
        }

        if ($to) {
            $query->whereHas('route.destinationAirport', function ($q) use ($to) {
                $q->where('city', 'like', "%{$to}%")->orWhere('code', $to)->orWhere('name', 'like', "%{$to}%");
            });
        }

        if ($date) {
            try {
                $searchDate = \Carbon\Carbon::parse($date)->startOfDay();
                $today = \Carbon\Carbon::today();

                if ($searchDate->lt($today)) {
                    // A date that has completely passed can't have any bookable flights left.
                    $query->whereRaw('1 = 0');
                } elseif ($searchDate->isSameDay($today)) {
                    // Today: only show flights that haven't departed yet.
                    $query->where('departure_time', '>', now()->format('H:i:s'));
                }
                // Any future date: every scheduled flight for that route is still valid, no time filter needed.
            } catch (\Exception $e) {
                // Unparseable date — ignore the date filter rather than break the search.
            }
        }

        $results = $query->orderBy('price')->get()->map->toCard();

        return Inertia::render('Flights', [
            'results' => $results,
            'filters' => [
                'from' => $from,
                'to' => $to,
                'date' => $date,
                'passengers' => $passengers,
            ],
        ]);
    }

    /**
     * Seat selection page for one flight schedule. Requires login (route is
     * behind the `auth` middleware) — guests are bounced to /login and
     * Laravel automatically returns them here afterwards.
     */
    public function seatMap(FlightSchedule $flightSchedule, Request $request)
    {
        $flightSchedule->load(['route.airline', 'route.originAirport', 'route.destinationAirport', 'airplane']);

        if (!$flightSchedule->airplane) {
            abort(404, 'No airplane has been assigned to this flight schedule yet.');
        }

        $bookedSeats = $flightSchedule->bookedSeats();
        $allSeats = $flightSchedule->airplane->seatMap();

        return Inertia::render('SeatMap', [
            'schedule' => $flightSchedule->toCard(),
            'airplane' => [
                'name' => $flightSchedule->airplane->name,
                'seat_rows' => $flightSchedule->airplane->seat_rows,
                'seat_columns' => $flightSchedule->airplane->seat_columns,
                'total_seats' => $flightSchedule->airplane->total_seats,
                'image' => $flightSchedule->airplane->image ? asset('storage/' . $flightSchedule->airplane->image) : null,
            ],
            'seats' => $allSeats,
            'bookedSeats' => $bookedSeats,
            'passengers' => max(1, (int) $request->query('passengers', 1)),
        ]);
    }

    /**
     * Put the chosen seats for one flight into the (single-flight) session
     * cart, then send the passenger to the cart page to review before
     * checkout.
     */
    public function addToCart(Request $request, FlightSchedule $flightSchedule)
    {
        $data = $request->validate([
            'seats' => 'required|array|min:1|max:9',
            'seats.*' => 'required|string',
        ]);

        $flightSchedule->load('airplane');

        $alreadyBooked = $flightSchedule->bookedSeats();
        $clash = array_intersect($data['seats'], $alreadyBooked);

        if (!empty($clash)) {
            return back()->with('error', 'Sorry, seat(s) ' . implode(', ', $clash) . ' were just booked by someone else. Please pick different seats.');
        }

        session([
            'cart' => [
                'flight_schedule_id' => $flightSchedule->id,
                'seats' => array_values($data['seats']),
                'unit_price' => (float) $flightSchedule->price,
                'added_at' => now()->toDateTimeString(),
            ],
        ]);

        return redirect()->route('cart');
    }

    /**
     * Cart page — shows whatever is currently held in the session, re-reading
     * the flight schedule fresh from the database so the price/availability
     * shown is always current.
     */
    public function cart()
    {
        $cart = session('cart');
        $item = null;

        if ($cart) {
            $schedule = FlightSchedule::with(['route.airline', 'route.originAirport', 'route.destinationAirport', 'airplane'])
                ->find($cart['flight_schedule_id']);

            if ($schedule) {
                $item = [
                    'schedule' => $schedule->toCard(),
                    'seats' => $cart['seats'],
                    'seat_count' => count($cart['seats']),
                    'unit_price' => $cart['unit_price'],
                    'total' => $cart['unit_price'] * count($cart['seats']),
                ];
            }
        }

        return Inertia::render('Cart', ['item' => $item]);
    }

    public function clearCart()
    {
        session()->forget('cart');

        return redirect()->route('cart');
    }

    /**
     * Checkout page — passenger details form, pre-filled from the logged in
     * user's account.
     */
    public function checkout()
    {
        $cart = session('cart');

        if (!$cart) {
            return redirect()->route('cart')->with('error', 'Your cart is empty. Please select a flight and seats first.');
        }

        $schedule = FlightSchedule::with(['route.airline', 'route.originAirport', 'route.destinationAirport', 'airplane'])
            ->find($cart['flight_schedule_id']);

        if (!$schedule) {
            session()->forget('cart');

            return redirect()->route('cart')->with('error', 'That flight is no longer available.');
        }

        $user = Auth::user();

        return Inertia::render('Checkout', [
            'item' => [
                'schedule' => $schedule->toCard(),
                'seats' => $cart['seats'],
                'seat_count' => count($cart['seats']),
                'unit_price' => $cart['unit_price'],
                'total' => $cart['unit_price'] * count($cart['seats']),
            ],
            'passenger' => [
                'name' => $user->name,
                'email' => $user->email,
            ],
            'paymentSandbox' => [
                'card' => [
                    'success' => SandboxCardPaymentService::SUCCESS_CARD,
                    'decline' => SandboxCardPaymentService::DECLINE_CARD,
                ],
                'bkash' => [
                    'enabled' => (bool) config('services.bkash.app_key'),
                    'wallet' => '01XXXXXXXXX (sandbox)',
                ],
            ],
            'flash' => [
                'error' => session('error'),
            ],
        ]);
    }

    /**
     * Place the order: re-validate seat availability one last time (to guard
     * against a race with someone else booking the same seat), create the
     * booking, clear the cart, and send the passenger to their confirmation
     * page.
     */
    public function placeOrder(Request $request, BkashService $bkash, SandboxCardPaymentService $cardGateway, BookingCheckoutService $checkout)
    {
        $cart = session('cart');

        if (!$cart) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        $data = $request->validate([
            'passenger_name' => 'required|string|max:150',
            'passenger_email' => 'required|email|max:150',
            'passenger_phone' => 'required|string|max:30',
            'payment_method' => 'required|in:cash_on_counter,bkash,card',
            'card_holder' => 'required_if:payment_method,card|nullable|string|max:120',
            'card_number' => 'required_if:payment_method,card|nullable|string|max:24',
            'card_expiry' => 'required_if:payment_method,card|nullable|string|max:7',
            'card_cvc' => 'required_if:payment_method,card|nullable|string|max:4',
        ]);

        $schedule = FlightSchedule::with('airplane')->find($cart['flight_schedule_id']);

        if (!$schedule) {
            session()->forget('cart');

            return redirect()->route('cart')->with('error', 'That flight is no longer available.');
        }

        $totalAmount = $cart['unit_price'] * count($cart['seats']);

        if ($data['payment_method'] === 'cash_on_counter') {
            $booking = $checkout->create($data, $schedule, $cart, [
                'payment_status' => 'pay_at_counter',
            ]);

            if (! $booking) {
                return redirect()->route('cart')->with('error', 'Seat(s) ' . implode(', ', array_intersect($cart['seats'], $schedule->bookedSeats())) . ' were just booked by someone else. Please choose different seats.');
            }

            session()->forget('cart');

            return redirect()->route('booking.confirmation', $booking->id);
        }

        if ($data['payment_method'] === 'card') {
            $payment = $cardGateway->process([
                'card_holder' => $data['card_holder'],
                'card_number' => $data['card_number'],
                'card_expiry' => $data['card_expiry'],
                'card_cvc' => $data['card_cvc'],
            ], $totalAmount);

            if (! $payment['success']) {
                return back()->withErrors(['payment' => $payment['message']]);
            }

            $booking = $checkout->create($data, $schedule, $cart, [
                'payment_status' => 'paid',
                'payment_reference' => $payment['reference'],
                'payment_transaction_id' => $payment['transaction_id'],
            ]);

            if (! $booking) {
                return redirect()->route('cart')->with('error', 'Seat(s) were just booked by someone else. Please choose different seats.');
            }

            session()->forget('cart');

            return redirect()->route('booking.confirmation', $booking->id)
                ->with('success', 'Sandbox card payment completed successfully.');
        }

        $invoiceNumber = 'BK'.now()->format('YmdHis').Auth::id();
        $callbackUrl = url(config('services.bkash.callback_path'));

        session([
            'pending_checkout' => [
                'passenger_name' => $data['passenger_name'],
                'passenger_email' => $data['passenger_email'],
                'passenger_phone' => $data['passenger_phone'],
                'payment_method' => 'bkash',
                'invoice_number' => $invoiceNumber,
                'cart' => $cart,
            ],
        ]);

        $payment = $bkash->createPayment(
            $totalAmount,
            $invoiceNumber,
            (string) Auth::id(),
            $callbackUrl
        );

        if (! $payment || empty($payment['bkashURL'])) {
            session()->forget('pending_checkout');

            return back()->withErrors([
                'payment' => 'Could not start bKash sandbox payment. Check your bKash sandbox credentials in .env.',
            ]);
        }

        session(['bkash_payment_id' => $payment['paymentID']]);

        return Inertia::location($payment['bkashURL']);
    }

    /**
     * Booking confirmation / e-ticket page.
     */
    public function confirmation(Booking $booking)
    {
        $this->authorizeBookingAccess($booking);

        $booking->load(['flightSchedule.route.airline', 'flightSchedule.route.originAirport', 'flightSchedule.route.destinationAirport', 'flightSchedule.airplane']);

        return Inertia::render('Confirmation', [
            'booking' => $booking->toTicketArray(),
        ]);
    }

    /**
     * Download the e-ticket as a PDF.
     */
    public function ticketPdf(Booking $booking)
    {
        $this->authorizeBookingAccess($booking);

        $booking->load(['flightSchedule.route.airline', 'flightSchedule.route.originAirport', 'flightSchedule.route.destinationAirport', 'flightSchedule.airplane']);

        $pdf = Pdf::loadView('pdf.ticket', ['booking' => $booking->toTicketArray()]);

        return $pdf->download('ticket-' . $booking->pnr . '.pdf');
    }

    /**
     * A booking can be viewed by the passenger it belongs to, the agent who
     * created it on their behalf, or an admin.
     */
    private function authorizeBookingAccess(Booking $booking): void
    {
        $user = Auth::user();

        abort_unless(
            $booking->user_id === $user->id
                || $booking->agent_id === $user->id
                || $user->role === 'admin',
            403
        );
    }
}
