@extends('admin.master')
@push('styles')
    <link href="{{ asset('') }}assets/libs/simple-datatables/style.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                    <h4 class="page-title">Flight Schedules</h4>
                    <div class="">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Flight Schedules</li>
                        </ol>
                    </div>
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->

        <div class="row justify-content-center col-12">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Flight Schedule List</h4>
                        <a class="btn btn-sm btn-primary" href="{{ route('admin.flight-schedules.create') }}">Add New
                            Flight Schedule <i class="fas fa-arrow-right"></i></a>
                    </div><!--end card-header-->
                    <div class="card-body pt-0">

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <div class="table-responsive">
                            <table class="table datatable" id="datatable_2">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Flight No.</th>
                                        <th>Airline</th>
                                        <th>Route</th>
                                        <th>Airplane</th>
                                        <th>Departure</th>
                                        <th>Arrival</th>
                                        <th>Days</th>
                                        <th>Price</th>
                                        <th>Seats Left</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($items as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->flight_number }}</td>
                                            <td>{{ $item->route->airline->name ?? '—' }}</td>
                                            <td>
                                                {{ $item->route->originAirport->code ?? '—' }} &rarr;
                                                {{ $item->route->destinationAirport->code ?? '—' }}
                                            </td>
                                            <td>{{ $item->airplane->name ?? '—' }}</td>
                                            <td>{{ $item->departure_time }}</td>
                                            <td>{{ $item->arrival_time }}</td>
                                            <td>{{ $item->days_of_operation }}</td>
                                            <td>{{ number_format((float) $item->price, 2) }}</td>
                                            <td>
                                                @if ($item->airplane)
                                                    {{ $item->availableSeatsCount() }} / {{ $item->airplane->total_seats }}
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span
                                                    class="badge text-bg-{{ $item->status === 'scheduled' ? 'success' : ($item->status === 'delayed' ? 'warning' : 'danger') }}">
                                                    {{ ucfirst($item->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.flight-schedules.edit', $item->id) }}"
                                                    class="btn btn-xs btn-warning">Edit</a>

                                                <form
                                                    action="{{ route('admin.flight-schedules.destroy', $item->id) }}"
                                                    method="POST" style="display:inline"
                                                    onsubmit="return confirm('Delete this flight schedule?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-xs btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="12" class="text-center">No flight schedules found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
        </div><!--end row-->
    </div><!-- container -->
@endsection

@push('scripts')
    <script src="{{ asset('') }}assets/libs/simple-datatables/umd/simple-datatables.js"></script>
    <script src="{{ asset('') }}assets/js/pages/datatable.init.js"></script>
@endpush
