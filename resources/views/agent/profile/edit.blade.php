@extends('agent.master')
@push('styles')
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                    <h4 class="page-title">Edit My Profile</h4>
                    <a href="{{ route('agent.profile') }}" class="btn btn-sm btn-secondary">← Back to Profile</a>
                </div>
            </div>
        </div><!--end row-->

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Update Profile</h4>
                    </div>
                    <div class="card-body">

                        @if ($errors->any() && !$errors->hasBag('updatePassword'))
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $e)
                                        <li>{{ $e }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('agent.profile.update') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $user->name) }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $user->email) }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control"
                                    value="{{ old('phone', $agent->phone ?? '') }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" name="address" class="form-control"
                                    value="{{ old('address', $agent->address ?? '') }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Profile Image</label>
                                @if ($agent && $agent->image && $agent->image !== 'default.png')
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $agent->image) }}" width="80"
                                            style="border-radius:4px;">
                                    </div>
                                @endif
                                <input type="file" name="image" class="form-control" accept="image/*">
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                        </form>

                    </div>
                </div><!--end card-->
            </div><!--end col-->

            <div class="col-lg-5">
                <div class="card" id="change-password">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Reset Password</h4>
                    </div>
                    <div class="card-body">

                        @if ($errors->updatePassword->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->updatePassword->all() as $e)
                                        <li>{{ $e }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('agent.password.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Current Password</label>
                                <input type="password" name="current_password" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Confirm New Password</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-warning w-100">Update Password</button>
                        </form>

                    </div>
                </div><!--end card-->
            </div><!--end col-->
        </div><!--end row-->
    </div>
@endsection



@push('scripts')
@endpush
