@extends('admin.master')
@push('styles')
    <link href="{{ asset('') }}assets/libs/simple-datatables/style.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <!-- Page Content-->

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                    <h4 class="page-title">Volunteers</h4>
                    <div class="">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.volunteerlist.index') }}">Volunteer</a>
                            </li><!--end nav-item-->
                            <li class="breadcrumb-item"><a href="{{ route('admin.volunteerlist.index') }}">Tables</a>
                            </li><!--end nav-item-->

                        </ol>
                    </div>
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->


        <div class="row justify-content-center col-12">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Volunteer List</h4>
                        <a class="btn btn-sm btn-primary " href="{{ route('admin.volunteerlist.create') }}">Add New
                            Volunteer <i class="fas fa-arrow-right"></i></a>


                    </div><!--end card-header-->
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table datatable" id="datatable_3">
                                <thead class="">
                                    <tr>
                                        <th>Id</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Task</th>
                                        <th>Status</th>
                                        <th>Joined</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                {{-- success message --}}
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                <tbody>
                                    @forelse ($items as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>
                                                <img src="{{ asset('storage/' . $item->image) }}" width="50"
                                                    height="50" style="object-fit:cover; border-radius:4px;">
                                            </td>
                                            <td>{{ $item->user->name ?? 'N/A' }}</td>
                                            <td>{{ $item->user->email ?? 'N/A' }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->task ?? '-' }}</td>
                                            <td>
                                                @if ($item->status === 'active')
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->joining_date ? \Carbon\Carbon::parse($item->joining_date)->format('d M Y') : '-' }}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.volunteerlist.edit', $item->id) }}"
                                                    class="btn btn-xs btn-warning">Edit</a>

                                                <form action="{{ route('admin.volunteerlist.destroy', $item->id) }}"
                                                    method="POST" style="display:inline"
                                                    onsubmit="return confirm('Delete this volunteer?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-xs btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">No volunteers found.</td>
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



@push('scripts')
    <script src="{{ asset('') }}assets/libs/simple-datatables/umd/simple-datatables.js"></script>
    <script src="{{ asset('') }}assets/js/pages/datatable.init.js"></script>
@endpush
