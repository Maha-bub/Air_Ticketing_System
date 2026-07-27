@extends('admin.master')
@push('styles')
    <link href="{{ asset('') }}assets/libs/simple-datatables/style.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                    <h4 class="page-title">Routes</h4>
                    <div class="">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Routes</li>
                        </ol>
                    </div>
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->

        <div class="row justify-content-center col-12">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Route List</h4>
                        <a class="btn btn-sm btn-primary" href="{{ route('admin.routes.create') }}">Add New Route
                            <i class="fas fa-arrow-right"></i></a>
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
                                        <th>Airline</th>
                                        <th>Origin</th>
                                        <th>Destination</th>
                                        <th>Distance (km)</th>
                                        <th>Duration (min)</th>
                                        <th>Schedules</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($items as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->airline->name ?? '—' }}</td>
                                            <td>{{ $item->originAirport->code ?? '—' }} -
                                                {{ $item->originAirport->city ?? '' }}</td>
                                            <td>{{ $item->destinationAirport->code ?? '—' }} -
                                                {{ $item->destinationAirport->city ?? '' }}</td>
                                            <td>{{ $item->distance_km ?? '—' }}</td>
                                            <td>{{ $item->duration_minutes ?? '—' }}</td>
                                            <td>{{ $item->schedules_count }}</td>
                                            <td>
                                                <span class="badge text-bg-{{ $item->status === 'active' ? 'success' : 'secondary' }}">
                                                    {{ ucfirst($item->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.routes.edit', $item->id) }}"
                                                    class="btn btn-xs btn-warning">Edit</a>

                                                <form action="{{ route('admin.routes.destroy', $item->id) }}"
                                                    method="POST" style="display:inline"
                                                    onsubmit="return confirm('Delete this route?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-xs btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">No routes found.</td>
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
