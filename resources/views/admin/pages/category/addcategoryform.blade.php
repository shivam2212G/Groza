@extends('admin.layout.master')
@section('content')

<div class="container-fluid px-4">
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Add New Category</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="category_name" class="form-label fw-bold">Category Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            <input type="text"
                                   class="form-control"
                                   id="category_name"
                                   name="category_name"
                                   placeholder="e.g. Fruits & Vegetables"
                                   required>
                            <div class="invalid-feedback">
                                Please provide a category name.
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="category_image" class="form-label fw-bold">Category Image</label>
                        <input type="file"
                               class="form-control"
                               id="category_image"
                               name="category_image"
                               accept="image/*"
                               required
                               onchange="previewImage(event)">
                        <div class="invalid-feedback">
                            Please select an image for the category.
                        </div>
                        <div class="mt-2 text-center">
                            <img id="imagePreview" src="#" alt="Image Preview"
                                 class="img-thumbnail d-none"
                                 style="max-width: 150px; max-height: 150px;">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="category_description" class="form-label fw-bold">Description</label>
                    <textarea class="form-control"
                              id="category_description"
                              name="category_description"
                              rows="3"
                              placeholder="Enter category description..."></textarea>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.category') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Back to Categories
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Save Category
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
    .form-control:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    .input-group-text {
        background-color: #f8f9fa;
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

    // Image preview functionality
    function previewImage(event) {
        const preview = document.getElementById('imagePreview');
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function() {
            preview.src = reader.result;
            preview.classList.remove('d-none');
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
@endpush
