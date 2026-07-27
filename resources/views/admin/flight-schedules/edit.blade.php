@extends('admin.master')
@push('styles')
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                    <h4 class="page-title">Flight Schedules</h4>
                    <div class="">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.flight-schedules.index') }}">Flight
                                    Schedules</a></li>
                            <li class="breadcrumb-item active">Edit Flight Schedule</li>
                        </ol>
                    </div>
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->

        <div class="row justify-content-center col-12">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Edit Flight Schedule</h4>
                        <a class="btn btn-sm btn-info" href="{{ route('admin.flight-schedules.index') }}"><i
                                class="fas fa-arrow-left"></i> Back</a>
                    </div><!--end card-header-->

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card-body pt-0">
                        <form action="{{ route('admin.flight-schedules.update', $schedule->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Route</label>
                                    <select name="route_id" class="form-select" required>
                                        @foreach ($routes as $route)
                                            <option value="{{ $route->id }}"
                                                {{ old('route_id', $schedule->route_id) == $route->id ? 'selected' : '' }}>
                                                {{ $route->airline->name ?? '' }} :
                                                {{ $route->originAirport->code ?? '' }} &rarr;
                                                {{ $route->destinationAirport->code ?? '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Flight Number</label>
                                    <input type="text" name="flight_number" class="form-control"
                                        value="{{ old('flight_number', $schedule->flight_number) }}" required>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Departure Time</label>
                                    <input type="time" name="departure_time" class="form-control"
                                        value="{{ old('departure_time', substr($schedule->departure_time, 0, 5)) }}"
                                        required>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Arrival Time</label>
                                    <input type="time" name="arrival_time" class="form-control"
                                        value="{{ old('arrival_time', substr($schedule->arrival_time, 0, 5)) }}"
                                        required>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Days of Operation</label>
                                    <input type="text" name="days_of_operation" class="form-control"
                                        value="{{ old('days_of_operation', $schedule->days_of_operation) }}" required>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Price</label>
                                    <input type="number" step="0.01" name="price" class="form-control" min="0"
                                        value="{{ old('price', $schedule->price) }}" required>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select" required>
                                        <option value="scheduled"
                                            {{ old('status', $schedule->status) == 'scheduled' ? 'selected' : '' }}>
                                            Scheduled</option>
                                        <option value="delayed"
                                            {{ old('status', $schedule->status) == 'delayed' ? 'selected' : '' }}>
                                            Delayed</option>
                                        <option value="cancelled"
                                            {{ old('status', $schedule->status) == 'cancelled' ? 'selected' : '' }}>
                                            Cancelled</option>
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-warning w-100">Update Flight Schedule</button>
                        </form>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
        </div><!--end row-->
    </div><!-- container -->
@endsection

@push('scripts')
@endpush
