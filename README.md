# Air Ticketing System (Backend)

A Laravel-based Air Ticketing backend with three role-based panels — **Admin**,
**Customer**, and **Agent** — sharing one login system and admin-style dashboard theme.
There is no public-facing frontend; every panel sits behind authentication.

## Modules

- **Admin panel**
  - Dashboard (airports / airlines / routes / flight schedule stats)
  - Airports CRUD (`/admin/airports`)
  - Airlines CRUD (`/admin/airlines`)
  - Routes CRUD (`/admin/routes`) — links an airline to an origin/destination airport pair
  - Flight Schedules CRUD (`/admin/flight-schedules`) — flight number, times, days,
    price, and status for a route
  - Agents management (`/admin/agents`)
  - Settings (site name, logo, favicon, contact info)
- **Customer panel** — simple dashboard and profile
- **Agent panel** — dashboard and profile/password management

## Project structure

- Same Blade template/theme (`resources/views/admin/master.blade.php` and layout assets in
  `public/assets`).
- 3-role architecture: `admin`, `customer`, `agent`, guarded by the `role:` middleware.
- Standard CRUD conventions throughout (`Route::resource`, form validation, redirect +
  flash messages).

## Setup

This zip does **not** include `vendor/`, `node_modules/`, or `.git` to keep the download
small. To run the project:

```bash
composer install
npm install && npm run build   # or npm run dev
cp .env.example .env           # if you don't already have a .env (one is already included)
php artisan key:generate       # only if APP_KEY is empty in .env
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

### Seeded accounts (from `UserSeeder`)

| Role     | Email              | Password |
|----------|--------------------|----------|
| Admin    | admin@gmail.com    | 123456   |
| Customer | customer@gmail.com | 123456   |
| Agent    | agent@gmail.com    | 123456   |

## Notes

- The `routes` DB table (flight routes) is modeled by `App\Models\FlightRoute` instead of
  `Route`, to avoid clashing with Laravel's `Illuminate\Support\Facades\Route`.
- Deleting an Airport/Airline/Route that still has dependent Routes/Flight Schedules is
  blocked with a friendly error instead of a foreign-key crash.
- The Customer and Agent dashboards are intentionally simple (welcome screen / profile) —
  add booking, ticketing, and payment features on top of this foundation as needed.
