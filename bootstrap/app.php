<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);

        $middleware->alias([
            'role' => \App\Http\Middleware\Role::class,
        ]);

        // Guests hitting the customer booking flow (select seats, cart,
        // checkout, profile) are sent to Register first — most people
        // reaching this wall don't have an account yet, and Register
        // itself has an "Already have an account? Login" link for
        // returning customers. Admin/agent areas still redirect to Login.
        $middleware->redirectGuestsTo(function ($request) {
            $customerBookingPaths = [
                'flights/*/seats',
                'cart',
                'cart/*',
                'checkout',
                'checkout/*',
                'booking/*',
                'profile',
                'profile/*',
            ];

            if ($request->is($customerBookingPaths)) {
                return route('register');
            }

            return route('login');
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
