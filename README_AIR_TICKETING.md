# Air Ticketing System (Backend)

This project was converted from the original **Laravel Donation Management System** into a
backend-only **Air Ticketing System**, keeping the same Admin/Customer/Agent panel design
and structure. The public-facing frontend has been removed.

## What changed

- **Removed:** public frontend (`FrontendController`, frontend views/routes), bKash payment
  integration, and all donation-domain features (Donations, Categories, Campaigns, Donor
  List, Donor Donations, Reports).
- **Renamed roles/panels** (same login system, same 3 roles, same layout/theme):
  - `donor` → **`customer`** (`CustomerController`, `resources/views/customer/*`)
  - `volunteer` → **`agent`** (`AgentController` / `AgentManageController`,
    `resources/views/agent/*`, agents table)
- **New Air Ticketing modules (Admin only), following the same CRUD/design pattern as the
  old Category module:**
  - Airports CRUD (`/admin/airports`)
  - Airlines CRUD (`/admin/airlines`)
  - Routes CRUD (`/admin/routes`) — links an airline to an origin/destination airport pair
  - Flight Schedules CRUD (`/admin/flight-schedules`) — flight number, times, days,
    price, and status for a route
- **Admin dashboard** now shows air-ticketing stats (total airports, airlines, routes,
  flight schedules, and a breakdown of scheduled/delayed/cancelled flights) instead of
  donation stats.
- **Sidebar** rebuilt: Dashboard, Airports, Airlines, Routes, Flight Schedules, Agents,
  Settings.
- Site branding/title updated to "Air Ticketing System"; the generic Settings module
  (site name, logo, favicon, contact info) was kept as-is since it isn't donation-specific.

## Project structure kept

- Same Blade template/theme (`resources/views/admin/master.blade.php` and layout assets in
  `public/assets`) — no visual redesign, only content/navigation changes.
- Same 3-role architecture: `admin`, `customer`, `agent`, guarded by the existing
  `role:` middleware.
- Same CRUD coding conventions used throughout (`Route::resource`, form validation,
  redirect + flash messages) so new modules match the existing codebase style.

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
