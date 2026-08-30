@extends('customer.master')
@push('styles')
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                    <h4 class="page-title">Previous Trips</h4>
                    <div class="">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Previous Trips</li>
                        </ol>
                    </div>
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">All Bookings ({{ $bookings->count() }})</h4>
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
