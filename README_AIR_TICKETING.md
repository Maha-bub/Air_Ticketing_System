# Air Ticketing System

A full-stack flight booking platform built with **Laravel 12 + Inertia.js + React** for the
public-facing site, and **Laravel Blade** for the Admin, Agent, and Customer dashboards.

---

## 1. Requirements

- PHP 8.2+
- Composer
- Node.js 18+ / npm
- MySQL (or MariaDB)

---

## 2. First-time setup

```bash
composer install
npm install

copy .env.example .env      # if .env doesn't already exist — on Mac/Linux use: cp .env.example .env
php artisan key:generate

# Create the database itself first (e.g. via phpMyAdmin or the mysql CLI),
# matching the name in .env → DB_DATABASE (default: air_ticketing_system)

php artisan migrate
php artisan db:seed
php artisan storage:link

npm run build
php artisan serve
```

That's it — visit `http://127.0.0.1:8000`.

**If you're on Windows/XAMPP and get a "bootstrap/cache directory must be present and
writable" or a missing `bootstrap/app.php` error:** your zip extraction likely dropped
some files (this has happened with Windows' built-in extractor on this project before —
use 7-Zip instead), or antivirus quarantined a `.php` file. Delete the project folder
completely, re-extract with 7-Zip, and confirm `bootstrap/app.php` and
`bootstrap/providers.php` exist before running `composer install`.

---

## 3. Test accounts (from `UserSeeder`)

| Role     | Email               | Password |
|----------|----------------------|----------|
| Admin    | admin@gmail.com      | 123456   |
| Customer | customer@gmail.com   | 123456   |
| Agent    | agent@gmail.com      | 123456   |

New customer sign-ups via the public Register page work too (role defaults to `customer`).

---

## 4. What `php artisan db:seed` creates

`DatabaseSeeder` runs `UserSeeder` + `DemoDataSeeder` automatically (no `--class` flag
needed). This seeds:

- 8 airports (Dhaka, Chattogram, Sylhet, Cox's Bazar, Delhi, Singapore, Dubai, Bangkok)
- 3 airlines (Biman Bangladesh, US-Bangla, Novoair)
- 3 airplanes (Boeing 787-8 Dreamliner, Boeing 737-800, ATR 72-600) — each with a real
  aircraft photo copied from `public/frontend-assets/images/` into `storage/app/public/airplanes/`
- 14 routes/flight schedules covering every seeded city **in both directions** (so
  searching "from" any seeded city returns real results, not just from Dhaka)

---

## 5. Public site structure (Inertia + React, `resources/js/Pages`)

| Route                              | Page              | Notes |
|-------------------------------------|-------------------|-------|
| `/`                                  | Home              | Live search widget + "Popular charter destinations" carousel |
| `/flights`                           | Flights           | Search results — filters by city, and by time-of-day if the date is today |
| `/flights/{schedule}/seats`          | SeatMap           | **Auth required.** Guests are sent to **Register** (not Login) — Register has an "Already have an account? Login" link for returning customers |
| `/cart`, `/checkout`                 | Cart, Checkout    | Auth required |
| `/booking/{id}/confirmation`         | Confirmation      | E-ticket + PDF download (DomPDF) |
| `/about`, `/service`, `/gallery`, `/contact`, `/destinations` | — | Public, dynamic PageHeader banner |

Guests trying to reach the booking flow (seat selection, cart, checkout, profile) are
redirected to **Register**; Admin/Agent dashboards still redirect guests to **Login**
(configured in `bootstrap/app.php` via `redirectGuestsTo`).

---

## 6. Dashboards (Blade, `resources/views/{admin,agent,customer}`)

- **Admin** (`/admin/dashboard`) — manage Airports, Airlines, Routes, Flight Schedules,
  Airplanes (with image upload), Agents, Settings, Contact Messages.
- **Agent** (`/agent/dashboard`) — check available services (live seat availability) and
  book a flight on a customer's behalf (looks up the customer by email, creates the
  account automatically if it doesn't exist yet).
- **Customer** (`/customer/dashboard`) — profile summary + recent bookings, with a
  separate **Previous Trips** page for full booking history and ticket downloads.

`/dashboard` (the generic post-login redirect target) routes each user to the correct
one of the three above based on their `role`.

---

## 7. Known follow-ups (not yet built)

- The Contact page's form now saves to the database and shows up in Admin → Contact
  Messages, but there's no email notification sent to staff yet.
- Password reset ("Forgot password?") still uses the default Inertia/React pages, not a
  themed Blade page like Login/Register.
- No automated tests have been added for the booking flow.

---

## 8. If something looks broken after I've said it's fixed

Laravel caches compiled views/config/routes. After pulling any update to this project,
always run:

```bash
php artisan view:clear
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

Stale `storage/framework/views/*.php` compiled templates are the most common reason a
fix doesn't seem to apply — clearing them forces Laravel to recompile from the current
source files.
