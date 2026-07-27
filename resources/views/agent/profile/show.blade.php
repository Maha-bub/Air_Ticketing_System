@extends('agent.master')
@push('styles')
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                    <h4 class="page-title">My Profile</h4>
                    <a href="{{ route('agent.profile.edit') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-pen"></i> Edit Profile
                    </a>
                </div>
            </div>
        </div><!--end row-->

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="{{ $agent && $agent->image !== 'default.png' ? asset('storage/' . $agent->image) : asset('assets/images/users/avatar-1.jpg') }}"
                            class="rounded-circle mb-3" width="110" height="110" style="object-fit:cover;">
                        <h5 class="mb-0">{{ $user->name }}</h5>
                        <p class="text-muted mb-2">{{ $user->email }}</p>
                        @if ($agent)
                            @if ($agent->status === 'active')
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        @endif
                    </div>
                </div><!--end card-->
            </div><!--end col-->

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Profile Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4"><strong>Full Name</strong></div>
                            <div class="col-sm-8">{{ $user->name }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4"><strong>Email</strong></div>
                            <div class="col-sm-8">{{ $user->email }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4"><strong>Phone</strong></div>
                            <div class="col-sm-8">{{ $agent->phone ?? '-' }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4"><strong>Address</strong></div>
                            <div class="col-sm-8">{{ $agent->address ?? '-' }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4"><strong>Assigned Task</strong></div>
                            <div class="col-sm-8">{{ $agent->task ?? '-' }}</div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-sm-4"><strong>Joined On</strong></div>
                            <div class="col-sm-8">
                                {{ $agent && $agent->joining_date ? \Carbon\Carbon::parse($agent->joining_date)->format('d M Y') : '-' }}
                            </div>
                        </div>
                    </div>
                </div><!--end card-->

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Security</h4>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-2">Want to change your password?</p>
                        <a href="{{ route('agent.profile.edit') }}#change-password" class="btn btn-sm btn-warning">
                            Reset Password
                        </a>
                    </div>
                </div><!--end card-->
            </div><!--end col-->
        </div><!--end row-->
    </div>
@endsection



@push('scripts')
@endpush
