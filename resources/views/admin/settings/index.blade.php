@extends('admin.master')
@push('styles')
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                    <h4 class="page-title">Site Settings</h4>
                    <div class="">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li><!--end nav-item-->
                            <li class="breadcrumb-item active">Settings</li>
                        </ol>
                    </div>
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Site Settings</h4>
                        @if ($items->isEmpty())
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.settings.create') }}">
                                Add Site Settings <i class="fas fa-arrow-right"></i>
                            </a>
                        @endif
                    </div><!--end card-header-->
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table datatable" id="datatable_2">
                                <thead>
                                    <tr>
                                        <th>Logo</th>
                                        <th>Favicon</th>
                                        <th>Site Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Social Links</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($items as $item)
                                        <tr>
                                            <td>
                                                @if ($item->logo)
                                                    <img src="{{ asset('storage/' . $item->logo) }}" width="50"
                                                        height="50" style="object-fit:cover; border-radius:4px;">
                                                @else
                                                    <img src="{{ asset('assets/images/logo_dark.png') }}" width="50"
                                                        height="50" style="object-fit:cover; border-radius:4px;">
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->favicon)
                                                    <img src="{{ asset('storage/' . $item->favicon) }}" width="32"
                                                        height="32" style="object-fit:cover; border-radius:4px;">
                                                @else
                                                    <span class="text-muted">Default</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->site_name }}</td>
                                            <td>{{ $item->site_email }}</td>
                                            <td>{{ $item->site_phone }}</td>
                                            <td>{{ $item->address }}</td>
                                            <td>
                                                @if ($item->facebook_url)
                                                    <a href="{{ $item->facebook_url }}" target="_blank"><i
                                                            class="fab fa-facebook-f me-2"></i></a>
                                                @endif
                                                @if ($item->twitter_url)
                                                    <a href="{{ $item->twitter_url }}" target="_blank"><i
                                                            class="fab fa-twitter me-2"></i></a>
                                                @endif
                                                @if ($item->instagram_url)
                                                    <a href="{{ $item->instagram_url }}" target="_blank"><i
                                                            class="fab fa-instagram me-2"></i></a>
                                                @endif
                                                @if ($item->youtube_url)
                                                    <a href="{{ $item->youtube_url }}" target="_blank"><i
                                                            class="fab fa-youtube"></i></a>
                                                @endif
                                            </td>
                                            <td class="text-nowrap">
                                                <a href="{{ route('admin.settings.edit', $item->id) }}"
                                                    class="btn btn-xs btn-warning">Edit</a>

                                                <form action="{{ route('admin.settings.destroy', $item->id) }}"
                                                    method="POST" style="display:inline"
                                                    onsubmit="return confirm('Delete site settings? The site will fall back to defaults.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-xs btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">
                                                No settings configured yet. Click "Add Site Settings" to create one.
                                            </td>
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
