@extends('admin.layout.master')

@section('content')
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white py-3 d-flex justify-content-between align-items-center" style="border-radius: 0.75rem 0.75rem 0 0;">
                    <h4 class="mb-0 fw-semibold">
                        <i class="fas fa-user-circle me-2"></i>Admin Profile
                    </h4>
                    <a href="{{ route('admin.profile.edit', $admin->admin_id) }}" class="btn btn-light btn-sm rounded-pill">
                        <i class="fas fa-edit me-1"></i> Edit Profile
                    </a>
                </div>
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-3 text-center">
                            <img src="{{ asset('storage/' .$admin->shop_image) }}" alt="Shop Image"
                                 class="img-thumbnail rounded-circle mb-3 shadow-sm"
                                 style="width: 160px; height: 160px; object-fit: cover;">
                            <span class="badge bg-{{ $admin->status == 'active' ? 'success' : 'danger' }} p-2">
                                <i class="fas fa-{{ $admin->status == 'active' ? 'check-circle' : 'times-circle' }} me-1"></i>
                                {{ ucfirst($admin->status) }}
                            </span>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="detail-item mb-3">
                                        <h6 class="text-muted mb-1">Shop Name</h6>
                                        <p class="h5">{{ $admin->shop_name }}</p>
                                    </div>
                                    <div class="detail-item mb-3">
                                        <h6 class="text-muted mb-1">Email</h6>
                                        <p class="h5">{{ $admin->email }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="detail-item mb-3">
                                        <h6 class="text-muted mb-1">Owner Name</h6>
                                        <p class="h5">{{ $admin->owner_name }}</p>
                                    </div>
                                    <div class="detail-item mb-3">
                                        <h6 class="text-muted mb-1">Location</h6>
                                        <p class="h5">{{ $admin->location }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="detail-item mb-3">
                                        <h6 class="text-muted mb-1">Created At</h6>
                                        <p class="h5">{{ $admin->created_at->format('d M Y') }}</p>
                                    </div>
                                    <div class="detail-item mb-3">
                                        <h6 class="text-muted mb-1">Updated At</h6>
                                        <p class="h5">{{ $admin->updated_at->format('d M Y') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-8 offset-md-4">
                                    <form action="{{ route('admin.updateStatus', $admin->admin_id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="input-group">
                                            <select name="status" class="form-select" required>
                                                <option value="active" {{ $admin->status == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="inactive" {{ $admin->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save me-1"></i> Update Status
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }

    .card-header {
        border-radius: 10px 10px 0 0 !important;
    }

    .img-thumbnail {
        border: 2px solid #dee2e6;
        padding: 0.25rem;
    }

    .badge {
        font-size: 0.9rem;
        font-weight: 500;
        padding: 0.5rem 1rem;
        border-radius: 20px;
    }

    .detail-item {
        padding: 0.5rem;
    }

    .h5 {
        font-weight: 500;
    }

    .input-group {
        max-width: 500px;
    }

    .btn-primary {
        padding: 0.5rem 1.5rem;
    }
</style>
@endpush
