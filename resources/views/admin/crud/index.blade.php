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
                    <h4 class="page-title">Datatable</h4>
                    <div class="">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Approx</a>
                            </li><!--end nav-item-->
                            <li class="breadcrumb-item"><a href="#">Tables</a>
                            </li><!--end nav-item-->
                            <li class="breadcrumb-item active">Datatable</li>
                        </ol>
                    </div>
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->


        <div class="row justify-content-center col-12">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Donor List</h4>
                        <a class="btn btn-sm btn-primary " href="{{ route('admin.donorlist.create') }}">Add New Donor <i
                                class="fas fa-arrow-right"></i></a>


                    </div><!--end card-header-->
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table datatable" id="datatable_2">
                                <thead class="">
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Total</th>
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
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                <img src="{{ asset('storage/' . $item->image) }}" width="50"
                                                    height="50" style="object-fit:cover; border-radius:4px;">
                                            </td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->total }}</td>
                                            <td>
                                                <a href="#" class="btn btn-xs btn-info text-white"
                                                    data-bs-toggle="modal" data-bs-target="#viewDonorModal{{ $item->id }}">View</a>

                                                <a href="{{ route('admin.donorlist.edit', $item->id) }}"
                                                    class="btn btn-xs btn-warning">Edit</a>

                                                <form action="{{ route('admin.donorlist.destroy', $item->id) }}" method="POST"
                                                    style="display:inline" onsubmit="return confirm('Delete this donor?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-xs btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No donors found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-sm btn-primary csv">Export CSV</button>
                            <button type="button" class="btn btn-sm btn-primary sql">Export SQL</button>
                            <button type="button" class="btn btn-sm btn-primary txt">Export TXT</button>
                            <button type="button" class="btn btn-sm btn-primary json">Export JSON</button>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
        </div><!--end row-->
    </div><!-- container -->

    <!--Start Donor View Modals-->
    @foreach ($items as $item)
        <div class="modal fade" id="viewDonorModal{{ $item->id }}" tabindex="-1"
            aria-labelledby="viewDonorModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewDonorModalLabel{{ $item->id }}">Donor Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ asset('storage/' . $item->image) }}" width="60" height="60"
                                style="object-fit:cover; border-radius:50%;" class="me-3">
                            <div>
                                <h5 class="mb-0">{{ $item->name }}</h5>
                                <small class="text-muted">{{ $item->email }} • {{ $item->phone }}</small>
                            </div>
                        </div>

                        <div class="row text-center mb-3">
                            <div class="col-4">
                                <div class="p-2 border-dashed border-theme-color rounded">
                                    <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Total Donation</p>
                                    <h5 class="mt-1 mb-0 fw-medium">{{ $item->total }}</h5>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-2 border-dashed border-theme-color rounded">
                                    <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Last Donation</p>
                                    <h5 class="mt-1 mb-0 fw-medium">
                                        {{ $item->donations->first() ? \Carbon\Carbon::parse($item->donations->first()->donation_date)->format('d M Y') : '-' }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-2 border-dashed border-theme-color rounded">
                                    <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Last Amount</p>
                                    <h5 class="mt-1 mb-0 fw-medium">
                                        {{ $item->donations->first() ? $item->donations->first()->amount : '-' }}
                                    </h5>
                                </div>
                            </div>
                        </div>

                        <h6 class="mb-2">Donation History</h6>
                        <div class="table-responsive mb-3" style="max-height:220px; overflow-y:auto;">
                            <table class="table table-sm mb-0">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($item->donations as $donation)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($donation->donation_date)->format('d M Y') }}</td>
                                            <td>{{ $donation->amount }}</td>
                                            <td>{{ $donation->note ?? '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">No donation entries yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <h6 class="mb-2">Record a New Donation</h6>
                        <form action="{{ route('admin.donorlist.donations.store', $item->id) }}" method="POST"
                            class="row g-2 align-items-end">
                            @csrf
                            <div class="col-md-4">
                                <label class="form-label mb-1">Amount</label>
                                <input type="number" step="0.01" min="0" name="amount" class="form-control"
                                    required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label mb-1">Date</label>
                                <input type="date" name="donation_date" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label mb-1">Note</label>
                                <input type="text" name="note" class="form-control" placeholder="Optional">
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary w-100">Add</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!--end Donor View Modals-->
    <!--Start Rightbar-->
    <!--Start Rightbar/offcanvas-->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="Appearance" aria-labelledby="AppearanceLabel">
        <div class="offcanvas-header border-bottom justify-content-between">
            <h5 class="m-0 font-14" id="AppearanceLabel">Appearance</h5>
            <button type="button" class="btn-close text-reset p-0 m-0 align-self-center" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <h6>Account Settings</h6>
            <div class="p-2 text-start mt-3">
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="settings-switch1">
                    <label class="form-check-label" for="settings-switch1">Auto updates</label>
                </div><!--end form-switch-->
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="settings-switch2" checked>
                    <label class="form-check-label" for="settings-switch2">Location Permission</label>
                </div><!--end form-switch-->
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="settings-switch3">
                    <label class="form-check-label" for="settings-switch3">Show offline Contacts</label>
                </div><!--end form-switch-->
            </div><!--end /div-->
            <h6>General Settings</h6>
            <div class="p-2 text-start mt-3">
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="settings-switch4">
                    <label class="form-check-label" for="settings-switch4">Show me Online</label>
                </div><!--end form-switch-->
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="settings-switch5" checked>
                    <label class="form-check-label" for="settings-switch5">Status visible to all</label>
                </div><!--end form-switch-->
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="settings-switch6">
                    <label class="form-check-label" for="settings-switch6">Notifications Popup</label>
                </div><!--end form-switch-->
            </div><!--end /div-->
        </div><!--end offcanvas-body-->
    </div>
    <!--end Rightbar/offcanvas-->
@endsection



@push('scripts')
    <script src="{{ asset('') }}assets/libs/simple-datatables/umd/simple-datatables.js"></script>
    <script src="{{ asset('') }}assets/js/pages/datatable.init.js"></script>
@endpush
