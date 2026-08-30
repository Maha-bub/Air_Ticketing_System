@extends('admin.master')
@push('styles')
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                    <h4 class="page-title">Airplanes</h4>
                    <div class="">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.airplanes.index') }}">Airplanes</a></li>
                            <li class="breadcrumb-item active">Add New Airplane</li>
                        </ol>
                    </div>
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->

        <div class="row justify-content-center col-12">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Add New Airplane</h4>
                        <a class="btn btn-sm btn-info" href="{{ route('admin.airplanes.index') }}"><i
                                class="fas fa-arrow-left"></i> Back</a>
                    </div><!--end card-header-->
                    <div class="card-body pt-0">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $e)
                                        <li>{{ $e }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.airplanes.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Airplane Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                        placeholder="Boeing 777-300ER" required>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Model</label>
                                    <input type="text" name="model" class="form-control" value="{{ old('model') }}"
                                        placeholder="777-300ER">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Registration / Code</label>
                                    <input type="text" name="code" class="form-control text-uppercase"
                                        value="{{ old('code') }}" placeholder="S2-AGB" maxlength="20" required>
                                </div>

                                <div class="mb-3 col-md-3">
                                    <label class="form-label">Seat Rows</label>
                                    <input type="number" name="seat_rows" class="form-control" min="1" max="100"
                                        value="{{ old('seat_rows', 30) }}" required>
                                </div>

                                <div class="mb-3 col-md-3">
                                    <label class="form-label">Seats Per Row</label>
                                    <input type="number" name="seat_columns" class="form-control" min="1" max="10"
                                        value="{{ old('seat_columns', 6) }}" required>
                                    <small class="text-muted">e.g. 6 = columns A-F, with an aisle in the
                                        middle</small>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select" required>
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                            Inactive</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Airplane Image</label>
                                    <input type="file" name="image" class="form-control" accept="image/png,image/jpeg">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Save Airplane</button>
                        </form>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
        </div><!--end row-->
    </div><!-- container -->
@endsection

@push('scripts')
@endpush
