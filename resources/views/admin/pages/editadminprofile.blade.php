@extends('admin.layout.master')

@section('content')
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0">
                        <i class="fas fa-edit me-2"></i>Edit Profilessss
                    </h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.profile.update', $admin->admin_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="shop_name" class="form-label fw-bold">Shop Name</label>
                                <input type="text" name="shop_name" class="form-control"
                                       value="{{ old('shop_name', $admin->shop_name) }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label fw-bold">Email</label>
                                <input type="email" name="email" class="form-control"
                                       value="{{ old('email', $admin->email) }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="owner_name" class="form-label fw-bold">Owner Name</label>
                                <input type="text" name="owner_name" class="form-control"
                                       value="{{ old('owner_name', $admin->owner_name) }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="location" class="form-label fw-bold">Location</label>
                                <input type="text" name="location" class="form-control"
                                       value="{{ old('location', $admin->location) }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="shop_image" class="form-label fw-bold">Shop Image</label>
                                <input type="file" name="shop_image" class="form-control" accept="image/*">
                                <small class="text-muted">Leave blank to keep current image</small>
                                @if($admin->shop_image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $admin->shop_image) }}"
                                             class="img-thumbnail"
                                             style="width: 150px; height: auto;">
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label fw-bold">New Password</label>
                                <input type="password" name="password" class="form-control">
                                <small class="text-muted">Leave blank to keep current password</small>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('admin.profile', $admin->admin_id) }}" class="btn btn-outline-secondary me-2">
                                <i class="fas fa-times me-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
