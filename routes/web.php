<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\AgentManageController;
use App\Http\Controllers\AirlineController;
use App\Http\Controllers\AirportController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FlightRouteController;
use App\Http\Controllers\FlightScheduleController;

use App\Http\Controllers\SettingController;


Route::get('/', function () {
    return Inertia::render('Home', []);
});

Route::get('/service', function () {
    return Inertia::render('Service', []);
});

Route::get('/about', function () {
    return Inertia::render('About', []);
});
Route::get('/gallery', function () {
    return Inertia::render('Gallery', []);
});
Route::get('/destinations', function () {
    return Inertia::render('Destinations', []);
});
Route::get('/chekout', function () {
    return Inertia::render('Chekout', []);
});
Route::get('/cart', function () {
    return Inertia::render('Cart', []);
});

Route::get('/dashboard', [AdminController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])->name('dashboard');


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
    Route::resource('routes', FlightRouteController::class)->except(['show'])
        ->parameters(['routes' => 'route']);
    Route::resource('flight-schedules', FlightScheduleController::class)->except(['show']);

    Route::resource('agents', AgentManageController::class)->except(['show'])
        ->parameters(['agents' => 'agentlist']);

    Route::resource('settings', SettingController::class)->except(['show']);
});

Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
});

Route::middleware(['auth', 'role:agent'])->group(function () {
    Route::get('/agent/dashboard', [AgentController::class, 'dashboard'])->name('agent.dashboard');

    // agent's own profile & password management
    Route::get('/agent/profile', [AgentController::class, 'profile'])->name('agent.profile');
    Route::get('/agent/profile/edit', [AgentController::class, 'editProfile'])->name('agent.profile.edit');
    Route::put('/agent/profile', [AgentController::class, 'updateProfile'])->name('agent.profile.update');
    Route::put('/agent/password', [AgentController::class, 'updatePassword'])->name('agent.password.update');
});

require __DIR__ . '/auth.php';
