@extends('admin.layout.master')
@section('content')

<div class="container-fluid px-4">
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0"><i class="fas fa-layer-group me-2"></i>Add New Subcategory</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('subcategories.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="subcategory_name" class="form-label fw-bold">Subcategory Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            <input type="text"
                                   class="form-control"
                                   id="subcategory_name"
                                   name="subcategory_name"
                                   placeholder="e.g. Organic Fruits"
                                   required>
                            <div class="invalid-feedback">
                                Please provide a subcategory name.
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="category_id" class="form-label fw-bold">Parent Category</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-list"></i></span>
                            <select class="form-select"
                                    id="category_id"
                                    name="category_id"
                                    required>
                                <option value="" selected disabled>-- Select Category --</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->category_id }}" @if(old('category_id') == $category->category_id) selected @endif>
                                    {{ $category->category_name }}
                                </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select a parent category.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="subcategory_description" class="form-label fw-bold">Description</label>
                    <textarea class="form-control"
                              id="subcategory_description"
                              name="subcategory_description"
                              rows="3"
                              placeholder="Enter subcategory description...">{{ old('subcategory_description') }}</textarea>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('subcategories.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Save Subcategory
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }
    .card-header {
        border-radius: 12px 12px 0 0 !important;
    }
    .form-control:focus, .form-select:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    .input-group-text {
        background-color: #f8f9fa;
    }
    .btn-success {
        background-color: #198754;
        border-color: #198754;
    }
    .btn-success:hover {
        background-color: #157347;
        border-color: #146c43;
    }
</style>
@endpush

@push('scripts')
<script>
    // Form validation
    (function () {
        'use strict'

        var forms = document.querySelectorAll('.needs-validation')

        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
@endpush
