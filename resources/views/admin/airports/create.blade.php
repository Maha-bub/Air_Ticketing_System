@extends('admin.master')
@push('styles')
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                    <h4 class="page-title">Airports</h4>
                    <div class="">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.airports.index') }}">Airports</a></li>
                            <li class="breadcrumb-item active">Add New Airport</li>
                        </ol>
                    </div>
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->

        <div class="row justify-content-center col-12">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Add New Airport</h4>
                        <a class="btn btn-sm btn-info" href="{{ route('admin.airports.index') }}"><i
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

                        <form action="{{ route('admin.airports.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Airport Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                        placeholder="Hazrat Shahjalal International Airport" required>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">IATA Code</label>
                                    <input type="text" name="code" class="form-control text-uppercase"
                                        value="{{ old('code') }}" placeholder="DAC" maxlength="10" required>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">City</label>
                                    <input type="text" name="city" class="form-control" value="{{ old('city') }}"
                                        placeholder="Dhaka" required>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Country</label>
                                    <input type="text" name="country" class="form-control"
                                        value="{{ old('country') }}" placeholder="Bangladesh" required>
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
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Save Airport</button>
                        </form>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
        </div><!--end row-->
    </div><!-- container -->
@endsection

@push('scripts')
@endpush
