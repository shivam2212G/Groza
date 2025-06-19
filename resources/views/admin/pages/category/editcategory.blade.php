@extends('admin.layout.master')
@section('content')

<div class="container-fluid px-4">
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Category</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('categories.update', $category->category_id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="category_name" class="form-label fw-bold">Category Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            <input type="text"
                                   class="form-control"
                                   id="category_name"
                                   name="category_name"
                                   value="{{ old('category_name', $category->category_name) }}"
                                   required>
                            <div class="invalid-feedback">
                                Please provide a category name.
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold">Current Image</label>
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <img src="{{ asset('storage/' . $category->category_image) }}"
                                     class="img-thumbnail"
                                     style="width: 80px; height: 80px; object-fit: cover;">
                            </div>
                            <div>
                                <small class="text-muted d-block">Current image preview</small>
                                <small class="text-muted">Dimensions: {{ $category->image_width }}px × {{ $category->image_height }}px</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="category_image" class="form-label fw-bold">Change Image (Optional)</label>
                        <input type="file"
                               class="form-control"
                               id="category_image"
                               name="category_image"
                               accept="image/*"
                               onchange="previewImage(event)">
                        <div class="mt-2">
                            <img id="imagePreview" src="#" alt="New Image Preview"
                                 class="img-thumbnail d-none"
                                 style="max-width: 150px; max-height: 150px;">
                        </div>
                        <small class="text-muted">Recommended size: 500px × 500px</small>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="category_description" class="form-label fw-bold">Description</label>
                        <textarea class="form-control"
                                  id="category_description"
                                  name="category_description"
                                  rows="3">{{ old('category_description', $category->category_description) }}</textarea>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.category') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Update Category
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
    .img-thumbnail {
        border-radius: 8px;
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
