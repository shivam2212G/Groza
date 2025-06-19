@extends('admin.layout.master')
@section('content')

<div class="container-fluid px-4">
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0"><i class="fas fa-list-ol me-2"></i>Subcategory Management</h3>
            <a href="{{ route('subcategories.create') }}" class="btn btn-light">
                <i class="fas fa-plus me-1"></i> Add Subcategory
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
                <table class="table table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th width="8%">ID</th>
                            <th width="20%">Subcategory</th>
                            <th width="32%">Description</th>
                            <th width="20%">Category</th>
                            <th width="20%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($subcategories as $subcategory)
                        <tr>
                            <td class="fw-bold">{{ $subcategory->subcategory_id }}</td>
                            <td>{{ $subcategory->subcategory_name }}</td>
                            <td class="text-muted">
                                {{ Str::limit($subcategory->subcategory_description, 60) }}
                                @if(strlen($subcategory->subcategory_description) > 60)
                                    <span class="text-primary" data-bs-toggle="tooltip"
                                          title="{{ $subcategory->subcategory_description }}">
                                        <i class="fas fa-info-circle"></i>
                                    </span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-info text-dark">
                                    {{ $subcategory->category_name }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('subcategories.edit', $subcategory->subcategory_id) }}"
                                       class="btn btn-sm btn-outline-primary"
                                       data-bs-toggle="tooltip" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('subcategories.delete', $subcategory->subcategory_id) }}"
                                       class="btn btn-sm btn-outline-danger"
                                       data-bs-toggle="tooltip" title="Delete"
                                       onclick="return confirm('Are you sure you want to delete this subcategory?')">
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
                                    <h5 class="text-muted">No subcategories found</h5>
                                    <a href="{{ route('subcategories.create') }}" class="btn btn-primary mt-2">
                                        <i class="fas fa-plus me-1"></i> Create First Subcategory
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($subcategories instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="d-flex justify-content-center mt-3">
                {{ $subcategories->links() }}
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
    .badge {
        font-size: 0.85em;
        padding: 0.35em 0.65em;
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
