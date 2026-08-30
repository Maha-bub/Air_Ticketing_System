@extends('agent.master')
@push('styles')
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                    <h4 class="page-title">Booking Confirmed</h4>
                    <div class="">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('agent.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('agent.bookings.index') }}">My Bookings</a></li>
                            <li class="breadcrumb-item active">{{ $booking->pnr }}</li>
                        </ol>
                    </div>
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($generatedPassword)
            <div class="alert alert-warning">
                A new customer account was created for <strong>{{ $booking->passenger_email }}</strong>.
                Temporary password: <strong>{{ $generatedPassword }}</strong> — please share this with the
                passenger so they can log in and view their booking. This password will not be shown again.
            </div>
        @endif

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-3">PNR: {{ $booking->pnr }}</h4>

                        <p class="mb-1"><strong>Passenger:</strong> {{ $booking->passenger_name }}</p>
                        <p class="mb-1"><strong>Email:</strong> {{ $booking->passenger_email }}</p>
                        <p class="mb-3"><strong>Phone:</strong> {{ $booking->passenger_phone }}</p>

                        <hr>

                        <p class="mb-1">
                            <strong>{{ $booking->flightSchedule->flight_number }}</strong> &middot;
                            {{ $booking->flightSchedule->route->airline->name ?? '—' }}
                        </p>
                        <p class="mb-1">
                            {{ $booking->flightSchedule->route->originAirport->city ?? '—' }}
                            ({{ $booking->flightSchedule->route->originAirport->code ?? '—' }}) &rarr;
                            {{ $booking->flightSchedule->route->destinationAirport->city ?? '—' }}
                            ({{ $booking->flightSchedule->route->destinationAirport->code ?? '—' }})
                        </p>
                        <p class="mb-3">
                            Departure {{ $booking->flightSchedule->departure_time }} &middot; Arrival
                            {{ $booking->flightSchedule->arrival_time }} &middot; Aircraft:
                            {{ $booking->flightSchedule->airplane->name ?? '—' }}
                        </p>

                        <hr>

                        <p class="mb-1"><strong>Seats:</strong> {{ implode(', ', $booking->seats ?? []) }}</p>
                        <p class="mb-1"><strong>Payment method:</strong> {{ ucfirst(str_replace('_', ' ', $booking->payment_method)) }}</p>
                        <p class="mb-3"><strong>Total:</strong> ৳{{ number_format((float) $booking->total_amount, 2) }}</p>

                        <a href="{{ route('booking.ticket', $booking->id) }}" class="btn btn-primary">Download
                            E-Ticket (PDF)</a>
                        <a href="{{ route('agent.services.index') }}" class="btn btn-outline-secondary">Book Another
                            Flight</a>
                    </div>
                </div><!--end card-->
            </div><!--end col-->
        </div><!--end row-->
    </div>
@endsection

@push('scripts')
@endpush
