@extends('agent.master')
@push('styles')
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                    <h4 class="page-title">Available Services</h4>
                    <div class="">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('agent.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Available Services</li>
                        </ol>
                    </div>
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <form method="GET" class="d-flex gap-2">
                            <input type="text" name="q" value="{{ $search }}" class="form-control"
                                placeholder="Search by city or airport code...">
                            <button class="btn btn-primary">Search</button>
                            @if ($search)
                                <a href="{{ route('agent.services.index') }}" class="btn btn-outline-secondary">Clear</a>
                            @endif
                        </form>
                    </div>
                    <div class="card-body pt-3">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Flight</th>
                                        <th>Route</th>
                                        <th>Departure</th>
                                        <th>Arrival</th>
                                        <th>Aircraft</th>
                                        <th>Price</th>
                                        <th>Seats Left</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($flights as $flight)
                                        <tr>
                                            <td>
                                                <strong>{{ $flight->flight_number }}</strong>
                                                <div class="text-muted" style="font-size:12px;">
                                                    {{ $flight->route->airline->name ?? '—' }}
                                                </div>
                                            </td>
                                            <td>
                                                {{ $flight->route->originAirport->city ?? '—' }}
                                                ({{ $flight->route->originAirport->code ?? '—' }}) &rarr;
                                                {{ $flight->route->destinationAirport->city ?? '—' }}
                                                ({{ $flight->route->destinationAirport->code ?? '—' }})
                                            </td>
                                            <td>{{ $flight->departure_time }}</td>
                                            <td>{{ $flight->arrival_time }}</td>
                                            <td>{{ $flight->airplane->name ?? '—' }}</td>
                                            <td>৳{{ number_format((float) $flight->price, 2) }}</td>
                                            <td>
                                                @if (!$flight->airplane)
                                                    <span class="text-muted">—</span>
                                                @elseif ($flight->availableSeatsCount() > 0)
                                                    {{ $flight->availableSeatsCount() }} / {{ $flight->airplane->total_seats }}
                                                @else
                                                    <span class="text-danger">Sold out</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($flight->airplane && $flight->availableSeatsCount() > 0)
                                                    <a href="{{ route('agent.services.create', $flight->id) }}"
                                                        class="btn btn-xs btn-primary">Book for Customer</a>
                                                @else
                                                    <button class="btn btn-xs btn-secondary" disabled>Unavailable</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No matching flights found.</td>
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
