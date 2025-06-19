@extends('admin.layout.master')
@section('content')

<div class="container-fluid px-4">
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0"><i class="fas fa-list-alt me-2"></i>Category Management</h3>
            <a href="{{ route('categories.create') }}" class="btn btn-light">
                <i class="fas fa-plus me-1"></i> Add Category
            </a>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-primary">
                        <tr>
                            <th width="5%">ID</th>
                            <th width="20%">Category Name</th>
                            <th width="15%">Image</th>
                            <th width="40%">Description</th>
                            <th width="20%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                        <tr>
                            <td class="fw-bold">{{ $category->category_id }}</td>
                            <td>{{ $category->category_name }}</td>
                            <td>
                                <div class="img-thumbnail" style="width: 80px; height: 80px; overflow: hidden; border-radius: 8px;">
                                    <img src="{{ asset('storage/' . $category->category_image) }}"
                                         alt="Category Image"
                                         style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                            </td>
                            <td class="text-muted">{{ Str::limit($category->category_description, 100) }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('categories.edit', $category->category_id) }}"
                                       class="btn btn-sm btn-outline-primary"
                                       data-bs-toggle="tooltip"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('categories.delete', $category->category_id) }}"
                                       class="btn btn-sm btn-outline-danger"
                                       data-bs-toggle="tooltip"
                                       title="Delete"
                                       onclick="return confirm('Are you sure you want to delete this category?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">No categories found</h5>
                                    <a href="{{ route('categories.create') }}" class="btn btn-primary mt-2">
                                        <i class="fas fa-plus me-1"></i> Create First Category
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($categories instanceof \Illuminate\Pagination\LengthAwarePaginator && $categories->hasPages())
            <div class="d-flex justify-content-end mt-3">
                {{ $categories->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .table {
        border-radius: 8px;
        overflow: hidden;
    }
    .table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }
    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }
    .card-header {
        border-radius: 12px 12px 0 0 !important;
    }
    .btn-outline-primary:hover {
        background-color: #0d6efd;
        color: white;
    }
    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: white;
    }
</style>
@endpush

@push('scripts')
<script>
    // Enable tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>
@endpush
