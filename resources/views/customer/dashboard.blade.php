@extends('customer.master')
@push('styles')
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                    <h4 class="page-title">My Dashboard</h4>
                    <div class="">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="mb-0">{{ $user->name }}</h5>
                        <p class="text-muted mb-2">{{ $user->email }}</p>
                        <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-outline-secondary">Edit
                            Profile</a>
                        <a href="{{ url('/') }}" class="btn btn-sm btn-primary">Book a New Flight</a>
                    </div>
                </div><!--end card-->
            </div><!--end col-->

            <div class="col-lg-8">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h3 class="mb-0">{{ $stats['total_bookings'] }}</h3>
                                <p class="text-muted mb-0">Total Bookings</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h3 class="mb-0">{{ $stats['upcoming'] }}</h3>
                                <p class="text-muted mb-0">Confirmed</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h3 class="mb-0">৳{{ number_format((float) $stats['total_spent'], 2) }}</h3>
                                <p class="text-muted mb-0">Total Spent</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Recent Bookings</h4>
                        <a href="{{ route('customer.bookings.index') }}" class="btn btn-sm btn-outline-primary">View
                            All Previous Trips</a>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>PNR</th>
                                        <th>Flight</th>
                                        <th>Route</th>
                                        <th>Seats</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Booked On</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($bookings as $booking)
                                        <tr>
                                            <td><strong>{{ $booking->pnr }}</strong></td>
                                            <td>{{ $booking->flightSchedule->flight_number ?? '—' }}</td>
                                            <td>
                                                @if ($booking->flightSchedule && $booking->flightSchedule->route)
                                                    {{ $booking->flightSchedule->route->originAirport->code ?? '—' }}
                                                    &rarr;
                                                    {{ $booking->flightSchedule->route->destinationAirport->code ?? '—' }}
                                                @else
                                                    —
                                                @endif
                                            </td>
                                            <td>{{ implode(', ', $booking->seats ?? []) }}</td>
                                            <td>৳{{ number_format((float) $booking->total_amount, 2) }}</td>
                                            <td>
                                                <span class="badge text-bg-{{ $booking->status === 'confirmed' ? 'success' : ($booking->status === 'cancelled' ? 'danger' : 'secondary') }}">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            </td>
                                            <td>{{ $booking->created_at->format('d M Y, h:i A') }}</td>
                                            <td>
                                                <a href="{{ route('booking.ticket', $booking->id) }}"
                                                    class="btn btn-xs btn-primary">Download Ticket</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">
                                                You haven't booked any flights yet. <a href="{{ url('/') }}">Search for
                                                    a flight</a> to get started.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!--end card-->
            </div><!--end col-->
        </div><!--end row-->
    </div>
@endsection

@push('scripts')
@endpush
