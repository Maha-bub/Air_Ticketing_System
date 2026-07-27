@extends('admin.master')
@push('styles')
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                    <h4 class="page-title">Routes</h4>
                    <div class="">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.routes.index') }}">Routes</a></li>
                            <li class="breadcrumb-item active">Edit Route</li>
                        </ol>
                    </div>
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->

        <div class="row justify-content-center col-12">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Edit Route</h4>
                        <a class="btn btn-sm btn-info" href="{{ route('admin.routes.index') }}"><i
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
                        <form action="{{ route('admin.routes.update', $route->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Airline</label>
                                    <select name="airline_id" class="form-select" required>
                                        @foreach ($airlines as $airline)
                                            <option value="{{ $airline->id }}"
                                                {{ old('airline_id', $route->airline_id) == $airline->id ? 'selected' : '' }}>
                                                {{ $airline->name }} ({{ $airline->code }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select" required>
                                        <option value="active"
                                            {{ old('status', $route->status) == 'active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="inactive"
                                            {{ old('status', $route->status) == 'inactive' ? 'selected' : '' }}>
                                            Inactive</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Origin Airport</label>
                                    <select name="origin_airport_id" class="form-select" required>
                                        @foreach ($airports as $airport)
                                            <option value="{{ $airport->id }}"
                                                {{ old('origin_airport_id', $route->origin_airport_id) == $airport->id ? 'selected' : '' }}>
                                                {{ $airport->code }} - {{ $airport->city }}, {{ $airport->country }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Destination Airport</label>
                                    <select name="destination_airport_id" class="form-select" required>
                                        @foreach ($airports as $airport)
                                            <option value="{{ $airport->id }}"
                                                {{ old('destination_airport_id', $route->destination_airport_id) == $airport->id ? 'selected' : '' }}>
                                                {{ $airport->code }} - {{ $airport->city }}, {{ $airport->country }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Distance (km)</label>
                                    <input type="number" name="distance_km" class="form-control" min="0"
                                        value="{{ old('distance_km', $route->distance_km) }}">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Duration (minutes)</label>
                                    <input type="number" name="duration_minutes" class="form-control" min="0"
                                        value="{{ old('duration_minutes', $route->duration_minutes) }}">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-warning w-100">Update Route</button>
                        </form>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
        </div><!--end row-->
    </div><!-- container -->
@endsection

@push('scripts')
@endpush
