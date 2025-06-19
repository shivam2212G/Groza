@extends('admin.layout.master')
@section('content')

<div class="container-fluid px-4">
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0"><i class="fas fa-shopping-basket me-2"></i>Product Management</h3>
            <a href="{{ route('products.create') }}" class="btn btn-light">
                <i class="fas fa-plus me-1"></i> Add Product
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
                            <th width="5%">ID</th>
                            <th width="20%">Name</th>
                            <th width="12%">Image</th>
                            <th width="23%">Description</th>
                            <th width="10%">Price</th>
                            <th width="15%">Category</th>
                            <th width="15%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $p)
                        <tr>
                            <td class="fw-bold">{{ $p->product_id }}</td>
                            <td>{{ $p->product_name }}</td>
                            <td>
                                @if ($p->product_image)
                                <div class="img-thumbnail" style="width: 80px; height: 80px; overflow: hidden; border-radius: 8px;">
                                    <img src="{{ asset('storage/' . $p->product_image) }}"
                                         alt="Product Image"
                                         style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                @else
                                <span class="badge bg-secondary">No Image</span>
                                @endif
                            </td>
                            <td class="text-muted">
                                {{ Str::limit($p->product_description, 60) }}
                                @if(strlen($p->product_description) > 60)
                                    <span class="text-primary" data-bs-toggle="tooltip"
                                          title="{{ $p->product_description }}">
                                        <i class="fas fa-info-circle"></i>
                                    </span>
                                @endif
                            </td>
                            <td class="text-success fw-bold">${{ number_format($p->product_price, 2) }}</td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="badge bg-info text-dark mb-1">{{ $p->category_name }}</span>
                                    @if($p->subcategory_name)
                                    <span class="badge bg-secondary">{{ $p->subcategory_name }}</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('products.edit', $p->product_id) }}"
                                       class="btn btn-sm btn-outline-primary"
                                       data-bs-toggle="tooltip" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('products.delete', $p->product_id) }}"
                                       class="btn btn-sm btn-outline-danger"
                                       data-bs-toggle="tooltip" title="Delete"
                                       onclick="return confirm('Are you sure you want to delete this product?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                    <a href="#"
                                       class="btn btn-sm btn-outline-info"
                                       data-bs-toggle="tooltip" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">No products found</h5>
                                    <a href="{{ route('products.create') }}" class="btn btn-primary mt-2">
                                        <i class="fas fa-plus me-1"></i> Add First Product
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="d-flex justify-content-center mt-3">
                {{ $products->links() }}
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
    .img-thumbnail {
        transition: transform 0.3s;
    }
    .img-thumbnail:hover {
        transform: scale(1.05);
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
