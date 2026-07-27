@extends('agent.master')
@push('styles')
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                    <h4 class="page-title">Welcome, {{ $user->name }}!</h4>
                </div>
            </div>
        </div><!--end row-->

        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="{{ $agent && $agent->image !== 'default.png' ? asset('storage/' . $agent->image) : asset('assets/images/users/avatar-1.jpg') }}"
                            class="rounded-circle mb-3" width="90" height="90" style="object-fit:cover;">
                        <h5 class="mb-0">{{ $user->name }}</h5>
                        <p class="text-muted mb-2">{{ $user->email }}</p>
                        @if ($agent)
                            @if ($agent->status === 'active')
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        @endif
                        <div class="mt-3">
                            <a href="{{ route('agent.profile') }}" class="btn btn-sm btn-primary">View Profile</a>
                            <a href="{{ route('agent.profile.edit') }}" class="btn btn-sm btn-outline-secondary">Edit
                                Profile</a>
                        </div>
                    </div>
                </div><!--end card-->
            </div><!--end col-->

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">My Agent Info</h4>
                    </div>
                    <div class="card-body">
                        @if ($agent)
                            <p><strong>Phone:</strong> {{ $agent->phone ?? '-' }}</p>
                            <p><strong>Address:</strong> {{ $agent->address ?? '-' }}</p>
                            <p><strong>Assigned Task:</strong> {{ $agent->task ?? '-' }}</p>
                            <p class="mb-0"><strong>Joined:</strong>
                                {{ $agent->joining_date ? \Carbon\Carbon::parse($agent->joining_date)->format('d M Y') : '-' }}
                            </p>
                        @else
                            <p class="mb-0 text-muted">Your agent profile details haven't been set up yet. Please
                                contact the admin.</p>
                        @endif
                    </div>
                </div><!--end card-->
            </div><!--end col-->
        </div><!--end row-->
    </div>
@endsection



@push('scripts')
@endpush
