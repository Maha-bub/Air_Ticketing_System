@extends('admin.master')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Edit Volunteer</h4>
                        <a href="{{ route('admin.volunteerlist.index') }}" class="btn btn-sm btn-secondary">← Back</a>
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

                        <form action="{{ route('admin.volunteerlist.update', $volunteerlist->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $volunteerlist->user->name ?? '') }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $volunteerlist->user->email ?? '') }}" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control"
                                        placeholder="Leave blank to keep current password">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control"
                                    value="{{ old('phone', $volunteerlist->phone) }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" name="address" class="form-control"
                                    value="{{ old('address', $volunteerlist->address) }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Assigned Task / Responsibility</label>
                                <input type="text" name="task" class="form-control"
                                    value="{{ old('task', $volunteerlist->task) }}"
                                    placeholder="e.g. Event Coordination, Fundraising, Logistics">
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="active"
                                            {{ old('status', $volunteerlist->status) == 'active' ? 'selected' : '' }}>
                                            Active</option>
                                        <option value="inactive"
                                            {{ old('status', $volunteerlist->status) == 'inactive' ? 'selected' : '' }}>
                                            Inactive</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Joining Date</label>
                                    <input type="date" name="joining_date" class="form-control"
                                        value="{{ old('joining_date', $volunteerlist->joining_date ? \Carbon\Carbon::parse($volunteerlist->joining_date)->format('Y-m-d') : '') }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                @if ($volunteerlist->image && $volunteerlist->image !== 'default.png')
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $volunteerlist->image) }}" width="80"
                                            style="border-radius:4px;">
                                    </div>
                                @endif
                                <input type="file" name="image" class="form-control" accept="image/*">

                            </div>

                            <button type="submit" class="btn btn-warning w-100">Update Volunteer</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
