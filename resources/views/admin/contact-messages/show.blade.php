@extends('admin.master')
@push('styles')
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                    <h4 class="page-title">Message from {{ $item->name }}</h4>
                    <div class="">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.contact-messages.index') }}">Contact Messages</a></li>
                            <li class="breadcrumb-item active">View</li>
                        </ol>
                    </div>
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <p class="mb-1"><strong>Name:</strong> {{ $item->name }}</p>
                        <p class="mb-1"><strong>Email:</strong> <a href="mailto:{{ $item->email }}">{{ $item->email }}</a></p>
                        <p class="mb-1"><strong>Phone:</strong> {{ $item->phone ?: '—' }}</p>
                        <p class="mb-1"><strong>Subject:</strong> {{ $item->subject ?: '—' }}</p>
                        <p class="mb-3"><strong>Received:</strong> {{ $item->created_at->format('d M Y, h:i A') }}</p>
                        <hr>
                        <p style="white-space: pre-wrap;">{{ $item->message }}</p>
                        <hr>
                        <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-outline-secondary">Back
                            to inbox</a>
                    </div>
                </div><!--end card-->
            </div><!--end col-->
        </div><!--end row-->
    </div>
@endsection

@push('scripts')
@endpush
