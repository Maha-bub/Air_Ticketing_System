@extends('admin.master')
@push('styles')
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                    <h4 class="page-title">Airlines</h4>
                    <div class="">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.airlines.index') }}">Airlines</a></li>
                            <li class="breadcrumb-item active">Edit Airline</li>
                        </ol>
                    </div>
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->

        <div class="row justify-content-center col-12">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Edit Airline</h4>
                        <a class="btn btn-sm btn-info" href="{{ route('admin.airlines.index') }}"><i
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
                        @if ($airline->logo)
                            <img src="{{ asset('storage/' . $airline->logo) }}" alt="logo" width="64" height="64"
                                class="rounded mb-3">
                        @endif

                        <form action="{{ route('admin.airlines.update', $airline->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Airline Name</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name', $airline->name) }}" required>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">IATA Code</label>
                                    <input type="text" name="code" class="form-control text-uppercase"
                                        value="{{ old('code', $airline->code) }}" maxlength="10" required>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Country</label>
                                    <input type="text" name="country" class="form-control"
                                        value="{{ old('country', $airline->country) }}">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select" required>
                                        <option value="active"
                                            {{ old('status', $airline->status) == 'active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="inactive"
                                            {{ old('status', $airline->status) == 'inactive' ? 'selected' : '' }}>
                                            Inactive</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Logo</label>
                                    <input type="file" name="logo" class="form-control" accept="image/png,image/jpeg">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-warning w-100">Update Airline</button>
                        </form>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
        </div><!--end row-->
    </div><!-- container -->
@endsection

@push('scripts')
@endpush
