@extends('agent.master')
@push('styles')
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                    <h4 class="page-title">My Bookings</h4>
                    <div class="">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('agent.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">My Bookings</li>
                        </ol>
                    </div>
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body pt-3">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>PNR</th>
                                        <th>Customer</th>
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
                                            <td>
                                                {{ $booking->user->name ?? $booking->passenger_name }}
                                                <div class="text-muted" style="font-size:12px;">{{ $booking->passenger_email }}</div>
                                            </td>
                                            <td>
                                                {{ $booking->flightSchedule->route->originAirport->code ?? '—' }}
                                                &rarr;
                                                {{ $booking->flightSchedule->route->destinationAirport->code ?? '—' }}
                                            </td>
                                            <td>{{ implode(', ', $booking->seats ?? []) }}</td>
                                            <td>৳{{ number_format((float) $booking->total_amount, 2) }}</td>
                                            <td>
                                                <span class="badge text-bg-{{ $booking->status === 'confirmed' ? 'success' : 'secondary' }}">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            </td>
                                            <td>{{ $booking->created_at->format('d M Y, h:i A') }}</td>
                                            <td>
                                                <a href="{{ route('agent.bookings.show', $booking->id) }}"
                                                    class="btn btn-xs btn-info">View</a>
                                                <a href="{{ route('booking.ticket', $booking->id) }}"
                                                    class="btn btn-xs btn-primary">Ticket</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">
                                                You haven't made any bookings yet.
                                                <a href="{{ route('agent.services.index') }}">Check available services</a>
                                                to book one.
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
