@extends('admin.master')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Edit Donor</h4>
                        <a href="{{ route('admin.donorlist.index') }}" class="btn btn-sm btn-secondary">← Back</a>
                    </div>
                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $e)
                                        <li>{{ $e }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.donorlist.update', $donorlist->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $donorlist->name) }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $donorlist->email) }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control"
                                    value="{{ old('phone', $donorlist->phone) }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Total Donation</label>
                                <input type="text" name="total" class="form-control"
                                    value="{{ old('total', $donorlist->total) }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                @if ($donorlist->image && $donorlist->image !== 'default.png')
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $donorlist->image) }}" width="80"
                                            style="border-radius:4px;">
                                    </div>
                                @endif
                                <input type="file" name="image" class="form-control" accept="image/*">
                                
                            </div>

                            <button type="submit" class="btn btn-warning w-100">Update Donor</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
