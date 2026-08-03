<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\AgentManageController;
use App\Http\Controllers\AgentBookingController;
use App\Http\Controllers\AirlineController;
use App\Http\Controllers\AirplaneController;
use App\Http\Controllers\AirportController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FlightRouteController;
use App\Http\Controllers\FlightScheduleController;
use App\Http\Controllers\frontend\FrontendController;
use App\Http\Controllers\frontend\ContactController;
use App\Http\Controllers\frontend\PaymentController;
use App\Http\Controllers\ContactMessageController;

use App\Http\Controllers\SettingController;


Route::get('/', [FrontendController::class, 'index'])->name('home');

Route::get('/service', function () {
    return Inertia::render('Service', []);
});

Route::get('/about', function () {
    return Inertia::render('About', []);
});
Route::get('/gallery', function () {
    return Inertia::render('Gallery', []);
});
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Public: browse destinations & search flights, no login needed to look.
Route::get('/destinations', [FrontendController::class, 'destinations'])->name('destinations');
Route::get('/flights', [FrontendController::class, 'searchFlights'])->name('flights.search');

// Booking a specific flight (choosing seats) requires an account. Guests are
// redirected to /login and Laravel sends them straight back here afterwards.
Route::middleware('auth')->group(function () {
    Route::get('/flights/{flightSchedule}/seats', [FrontendController::class, 'seatMap'])->name('flights.seatmap');
    Route::post('/flights/{flightSchedule}/seats', [FrontendController::class, 'addToCart'])->name('flights.addToCart');

    Route::get('/cart', [FrontendController::class, 'cart'])->name('cart');
    Route::delete('/cart', [FrontendController::class, 'clearCart'])->name('cart.clear');

    Route::get('/checkout', [FrontendController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [FrontendController::class, 'placeOrder'])->name('checkout.store');

    // bKash redirects the customer's browser back here (GET) after they
    // approve or cancel payment on bKash's hosted sandbox checkout page.
    // This route was missing, which meant the bKash flow 404'd on return.
    Route::get('/payments/bkash/callback', [PaymentController::class, 'bkashCallback'])->name('payments.bkash.callback');

    Route::get('/booking/{booking}/confirmation', [FrontendController::class, 'confirmation'])->name('booking.confirmation');
    Route::get('/booking/{booking}/ticket', [FrontendController::class, 'ticketPdf'])->name('booking.ticket');
});

Route::get('/dashboard', function () {
    $user = auth()->user();

    return match ($user->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'agent' => redirect()->route('agent.dashboard'),
        default => redirect()->route('customer.dashboard'),
    };
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Admin panel: air ticketing management
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {

    Route::resource('airports', AirportController::class)->except(['show']);
    Route::resource('airlines', AirlineController::class)->except(['show']);
    Route::resource('airplanes', AirplaneController::class)->except(['show']);
    Route::resource('routes', FlightRouteController::class)->except(['show'])
        ->parameters(['routes' => 'route']);
    Route::resource('flight-schedules', FlightScheduleController::class)->except(['show']);

    Route::resource('agents', AgentManageController::class)->except(['show'])
        ->parameters(['agents' => 'agentlist']);

    Route::resource('settings', SettingController::class)->except(['show']);

    Route::get('contact-messages', [ContactMessageController::class, 'index'])->name('contact-messages.index');
    Route::get('contact-messages/{contactMessage}', [ContactMessageController::class, 'show'])->name('contact-messages.show');
    Route::delete('contact-messages/{contactMessage}', [ContactMessageController::class, 'destroy'])->name('contact-messages.destroy');
});

Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
    Route::get('/customer/bookings', [CustomerController::class, 'bookings'])->name('customer.bookings.index');
});

Route::middleware(['auth', 'role:agent'])->group(function () {
    Route::get('/agent/dashboard', [AgentController::class, 'dashboard'])->name('agent.dashboard');

    // agent's own profile & password management
    Route::get('/agent/profile', [AgentController::class, 'profile'])->name('agent.profile');
    Route::get('/agent/profile/edit', [AgentController::class, 'editProfile'])->name('agent.profile.edit');
    Route::put('/agent/profile', [AgentController::class, 'updateProfile'])->name('agent.profile.update');
    Route::put('/agent/password', [AgentController::class, 'updatePassword'])->name('agent.password.update');

    // browse available flights & book on behalf of a customer
    Route::get('/agent/services', [AgentBookingController::class, 'services'])->name('agent.services.index');
    Route::get('/agent/services/{flightSchedule}/book', [AgentBookingController::class, 'create'])->name('agent.services.create');
    Route::post('/agent/services/{flightSchedule}/book', [AgentBookingController::class, 'store'])->name('agent.services.store');

    Route::get('/agent/bookings', [AgentBookingController::class, 'history'])->name('agent.bookings.index');
    Route::get('/agent/bookings/{booking}', [AgentBookingController::class, 'show'])->name('agent.bookings.show');
});

require __DIR__ . '/auth.php';
