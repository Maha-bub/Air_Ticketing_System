@extends('agent.master')
@push('styles')
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                    <h4 class="page-title">Welcome, {{ $user->name }}!</h4>
                    <div>
                        <a href="{{ route('agent.services.index') }}" class="btn btn-sm btn-primary">Check Available
                            Services</a>
                    </div>
                </div>
            </div>
        </div><!--end row-->

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="mb-0">{{ $stats['available_flights'] }}</h3>
                        <p class="text-muted mb-0">Available Flights</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="mb-0">{{ $stats['bookings_today'] }}</h3>
                        <p class="text-muted mb-0">Bookings Today</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="mb-0">{{ $stats['total_bookings'] }}</h3>
                        <p class="text-muted mb-0">Total Bookings Made</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="mb-0">৳{{ number_format((float) $stats['total_sales'], 2) }}</h3>
                        <p class="text-muted mb-0">Total Sales</p>
                    </div>
                </div>
            </div>
        </div><!--end row-->

        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="{{ $agent && $agent->image !== 'default.png' ? asset('storage/' . $agent->image) : asset('assets/images/users/avatar-1.jpg') }}"
                            class="rounded-circle mb-3" width="90" height="90" style="object-fit:cover;">
                        <h5 class="mb-0">{{ $user->name }}</h5>
                        <p class="text-muted mb-2">{{ $user->email }}</p>
                        @if ($agent)
                            @if ($agent->status === 'active')
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        @endif
                        <div class="mt-3">
                            <a href="{{ route('agent.profile') }}" class="btn btn-sm btn-primary">View Profile</a>
                            <a href="{{ route('agent.profile.edit') }}" class="btn btn-sm btn-outline-secondary">Edit
                                Profile</a>
                        </div>
                    </div>
                </div><!--end card-->
            </div><!--end col-->

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">My Recent Bookings</h4>
                        <a href="{{ route('agent.bookings.index') }}" class="btn btn-sm btn-outline-primary">View
                            All</a>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>PNR</th>
                                        <th>Customer</th>
                                        <th>Route</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($recentBookings as $booking)
                                        <tr>
                                            <td>{{ $booking->pnr }}</td>
                                            <td>{{ $booking->user->name ?? $booking->passenger_name }}</td>
                                            <td>
                                                {{ $booking->flightSchedule->route->originAirport->code ?? '—' }}
                                                &rarr;
                                                {{ $booking->flightSchedule->route->destinationAirport->code ?? '—' }}
                                            </td>
                                            <td>৳{{ number_format((float) $booking->total_amount, 2) }}</td>
                                            <td>
                                                <span class="badge text-bg-{{ $booking->status === 'confirmed' ? 'success' : 'secondary' }}">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">You haven't made any bookings yet.</td>
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
