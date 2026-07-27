@extends('admin.master')
@push('styles')
@endpush

@section('content')
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-md-flex justify-content-between align-items-center">

                    <h4 class="page-title">
                        Dashboard
                    </h4>

                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="#">Air Ticketing</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Dashboard
                        </li>
                    </ol>

                </div>
            </div>
        </div>


        <!-- Hero Section -->
        <div class="row mb-4">

            <div class="col-xl-8">

                <div class="card hero-card h-100">

                    <div class="card-body p-4">

                        <span class="text-white-50">
                            Welcome back, Admin 👋
                        </span>

                        <h1 class="fw-bold mt-3">
                            Manage Your Flight Operations Easily
                        </h1>
                        <p class="text-white-50 mb-0">
                            Track live flight schedules, monitor airline performance and
                            keep your routes running on time — all from a single dashboard.
                        </p>
                        <div class="d-flex flex-wrap align-items-center gap-2 mt-4">

                            <a href="{{ route('admin.flight-schedules.index') }}" class="btn btn-light">
                                <i class="fas fa-plane me-2"></i>
                                Manage Flights
                            </a>

                            <span class="status-badge bg-white text-primary">
                                <i class="fas fa-calendar-check me-1"></i>
                                Total Schedules: {{ $totalFlightSchedules }}
                            </span>

                            <span class="status-badge" style="background: rgba(255,255,255,.15); color:#fff;">
                                <i class="fas fa-clock me-1"></i>
                                Updated just now
                            </span>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Flight Status -->
            <div class="col-xl-4 mt-3 mt-xl-0">

                <div class="card dashboard-card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="mb-0">
                                Flight Status
                            </h5>
                            <span class="text-muted" style="font-size:12px;">
                                {{ $totalFlightSchedules }} total
                            </span>
                        </div>
                        @php
                            $statusTotal = max($scheduledFlights + $delayedFlights + $cancelledFlights, 1);
                            $scheduledPct = round(($scheduledFlights / $statusTotal) * 100);
                            $delayedPct = round(($delayedFlights / $statusTotal) * 100);
                            $cancelledPct = round(($cancelledFlights / $statusTotal) * 100);
                        @endphp

                        <div class="d-flex justify-content-between mb-2">

                            <span>
                                <i class="fas fa-circle text-success" style="font-size:8px;"></i>
                                Scheduled
                            </span>

                            <strong class="text-success">
                                {{ $scheduledFlights }} <span class="text-muted fw-normal">({{ $scheduledPct }}%)</span>
                            </strong>
                        </div>
                        <div class="progress mb-4" style="height:8px">
                            <div class="progress-bar bg-success js-animate-bar"
                                style="--target-width: {{ $scheduledPct }}%">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span>
                                <i class="fas fa-circle text-warning" style="font-size:8px;"></i>
                                Delayed
                            </span>

                            <strong class="text-warning">
                                {{ $delayedFlights }} <span class="text-muted fw-normal">({{ $delayedPct }}%)</span>
                            </strong>

                        </div>
                        <div class="progress mb-4" style="height:8px">

                            <div class="progress-bar bg-warning js-animate-bar"
                                style="--target-width: {{ $delayedPct }}%">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mb-2">

                            <span>
                                <i class="fas fa-circle text-danger" style="font-size:8px;"></i>
                                Cancelled
                            </span>

                            <strong class="text-danger">
                                {{ $cancelledFlights }} <span class="text-muted fw-normal">({{ $cancelledPct }}%)</span>
                            </strong>

                        </div>

                        <div class="progress" style="height:8px">

                            <div class="progress-bar bg-danger js-animate-bar"
                                style="--target-width: {{ $cancelledPct }}%">
                            </div>

                        </div>


                    </div>

                </div>

            </div>


        </div>



        <!-- Statistics Cards -->

        <div class="row g-4">


            <!-- Airports -->
            <div class="col-md-6 col-xl-3">

                <div class="card dashboard-card">

                    <div class="card-body d-flex justify-content-between align-items-center">

                        <div>

                            <p class="card-title-text mb-1">
                                Airports
                            </p>

                            <h2 class="mb-1">
                                {{ $totalAirports }}
                            </h2>

                            <span class="trend-chip trend-up">
                                <i class="fas fa-map-marker-alt me-1"></i> Active network
                            </span>

                        </div>


                        <div class="stat-icon bg-primary-subtle text-primary">

                            <i class="iconoir-city"></i>

                        </div>


                    </div>

                </div>

            </div>



            <!-- Airlines -->
            <div class="col-md-6 col-xl-3">

                <div class="card dashboard-card">

                    <div class="card-body d-flex justify-content-between align-items-center">


                        <div>

                            <p class="card-title-text mb-1">
                                Airlines
                            </p>

                            <h2 class="mb-1 text-success">
                                {{ $totalAirlines }}
                            </h2>

                            <span class="trend-chip trend-up">
                                <i class="fas fa-check-circle me-1"></i> Partnered
                            </span>

                        </div>


                        <div class="stat-icon bg-success-subtle text-success">

                            <i class="iconoir-airplane"></i>

                        </div>


                    </div>

                </div>

            </div>




            <!-- Routes -->
            <div class="col-md-6 col-xl-3">

                <div class="card dashboard-card">

                    <div class="card-body d-flex justify-content-between align-items-center">


                        <div>

                            <p class="card-title-text mb-1">
                                Routes
                            </p>

                            <h2 class="mb-1 text-primary">
                                {{ $totalRoutes }}
                            </h2>

                            <span class="trend-chip trend-up">
                                <i class="fas fa-route me-1"></i> Operational
                            </span>

                        </div>


                        <div class="stat-icon bg-primary-subtle text-primary">

                            <i class="iconoir-route"></i>

                        </div>


                    </div>

                </div>

            </div>




            <!-- Schedules -->
            <div class="col-md-6 col-xl-3">

                <div class="card dashboard-card">

                    <div class="card-body d-flex justify-content-between align-items-center">


                        <div>

                            <p class="card-title-text mb-1">
                                Schedules
                            </p>

                            <h2 class="mb-1 text-info">
                                {{ $totalFlightSchedules }}
                            </h2>

                            <span class="trend-chip trend-up">
                                <i class="fas fa-calendar-alt me-1"></i> This period
                            </span>

                        </div>


                        <div class="stat-icon bg-info-subtle text-info">

                            <i class="iconoir-calendar"></i>

                        </div>


                    </div>

                </div>

            </div>


        </div>

        <!-- Quick Actions + Overview -->

        <div class="row g-4 mt-2">

            <!-- Quick Actions -->
            <div class="col-xl-4">

                <div class="card dashboard-card h-100">

                    <div class="card-body">

                        <h5 class="mb-4">
                            Quick Actions
                        </h5>


                        <a href="{{ route('admin.flight-schedules.create') }}" class="btn btn-primary w-100 quick-btn">

                            <i class="fas fa-plus me-2"></i>
                            Add Flight Schedule

                        </a>


                        <a href="{{ route('admin.routes.create') }}" class="btn btn-outline-primary w-100 quick-btn">

                            <i class="fas fa-route me-2"></i>
                            Add Route

                        </a>


                        <a href="{{ route('admin.airports.create') }}" class="btn btn-outline-success w-100 quick-btn">

                            <i class="fas fa-city me-2"></i>
                            Add Airport

                        </a>


                        <a href="{{ route('admin.airlines.create') }}"
                            class="btn btn-outline-warning w-100 quick-btn mb-0">

                            <i class="fas fa-plane me-2"></i>
                            Add Airline

                        </a>


                    </div>

                </div>
            </div>
            <!-- Flight Overview -->
            <div class="col-xl-8">
                <div class="card dashboard-card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h5 class="mb-1">
                                    Flight Overview
                                </h5>
                                <span class="text-muted" style="font-size:13px;">
                                    On-time performance across {{ $totalFlightSchedules }} scheduled flights
                                </span>
                            </div>
                            <a href="{{ route('admin.flight-schedules.index') }}" class="btn btn-sm btn-primary">
                                View All
                            </a>
                        </div>
                        @php
                            $onTimeRate = $statusTotal > 0 ? round(($scheduledFlights / $statusTotal) * 100) : 0;
                        @endphp
                        <div class="row text-center g-3">
                            <div class="col-md-4">
                                <div class="overview-tile bg-success-subtle">
                                    <h3 class="text-success">
                                        {{ $scheduledFlights }}
                                    </h3>
                                    <span>
                                        On Schedule
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="overview-tile bg-warning-subtle">
                                    <h3 class="text-warning">
                                        {{ $delayedFlights }}
                                    </h3>
                                    <span>
                                        Delayed
                                    </span>
                                </div>

                            </div>

                            <div class="col-md-4">
                                <div class="overview-tile bg-danger-subtle">
                                    <h3 class="text-danger">
                                        {{ $cancelledFlights }}
                                    </h3>
                                    <span>
                                        Cancelled
                                    </span>
                                </div>

                            </div>


                        </div>


                        <hr class="my-4" style="border-color: var(--card-border);">


                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                            <div>
                                <p class="card-title-text mb-1">
                                    On-time Performance
                                </p>
                                <h4 class="mb-0">
                                    {{ $onTimeRate }}%
                                </h4>
                            </div>

                            <div class="flex-grow-1" style="max-width: 320px; min-width: 200px;">
                                <div class="progress" style="height:10px">
                                    <div class="progress-bar bg-primary js-animate-bar"
                                        style="--target-width: {{ $onTimeRate }}%">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-1">
                                    <span class="text-muted" style="font-size:12px;">Target: 90%</span>
                                    <span
                                        class="{{ $onTimeRate >= 90 ? 'trend-chip trend-up' : 'trend-chip trend-down' }}">
                                        {{ $onTimeRate >= 90 ? 'On Target' : 'Below Target' }}
                                    </span>
                                </div>
                            </div>

                        </div>


                    </div>

                </div>

            </div>
        </div>
        <!-- Recent Flight Schedule -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card dashboard-card">
                    <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1">
                                Recently Added Flight Schedules
                            </h5>
                            <span class="text-muted" style="font-size:13px;">
                                Latest entries across all active routes
                            </span>
                        </div>
                        <a href="{{ route('admin.flight-schedules.index') }}" class="btn btn-primary btn-sm">
                            View All
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>

                                    <tr>
                                        <th> Flight No. </th>
                                        <th> Airline </th>
                                        <th> Route </th>
                                        <th> Departure </th>
                                        <th> Arrival </th>
                                        <th> Price </th>
                                        <th> Status </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentSchedules as $schedule)
                                        <tr>
                                            <td class="fw-semibold">
                                                {{ $schedule->flight_number }}
                                            </td>
                                            <td>
                                                {{ $schedule->route?->airline?->name }}
                                            </td>
                                            <td>
                                                {{ $schedule->route?->originAirport?->code }}
                                                <i class="fas fa-long-arrow-alt-right mx-1 text-muted"></i>
                                                {{ $schedule->route?->destinationAirport?->code }}
                                            </td>
                                            <td>
                                                {{ $schedule->departure_time }}
                                            </td>
                                            <td>
                                                {{ $schedule->arrival_time }}
                                            </td>
                                            <td>

                                                ৳ {{ number_format((float) $schedule->price, 2) }}
                                            </td>
                                            <td>
                                                @if ($schedule->status == 'scheduled')
                                                    <span class="badge bg-success">
                                                        Scheduled
                                                    </span>
                                                @elseif($schedule->status == 'delayed')
                                                    <span class="badge bg-warning">
                                                        Delayed
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger">
                                                        Cancelled
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-4">
                                                <i class="fas fa-plane-slash mb-2 d-block" style="font-size:22px;"></i>
                                                No flight schedule found
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Trigger progress bar animation after paint so the transition runs
            requestAnimationFrame(function() {
                setTimeout(function() {
                    document.querySelectorAll('.js-animate-bar').forEach(function(bar) {
                        bar.classList.add('animate');
                    });
                }, 150);
            });
        });
    </script>
@endpush
