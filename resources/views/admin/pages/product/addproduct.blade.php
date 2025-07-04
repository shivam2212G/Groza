@extends('admin.layout.master')
@section('content')

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                <i class="fas fa-plus-circle me-2"></i>Add New Product
            </h4>
        </div>

        <div class="card-body">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf

                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="product_name" class="form-label fw-bold">Product Name <span class="text-danger">*</span></label>
                            <input type="text" name="product_name" class="form-control border-primary" id="product_name" placeholder="Enter product name" required>
                            <div class="invalid-feedback">
                                Please provide a product name.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="product_description" class="form-label fw-bold">Description <span class="text-danger">*</span></label>
                            <textarea name="product_description" class="form-control border-primary" id="product_description" rows="3" placeholder="Enter product description" required></textarea>
                            <div class="invalid-feedback">
                                Please provide a product description.
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="product_price" class="form-label fw-bold">Price (₹) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white">₹</span>
                                <input type="number" step="0.01" name="product_price" class="form-control border-primary" id="product_price" placeholder="0.00" required>
                                <div class="invalid-feedback">
                                    Please provide a valid price.
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="product_image" class="form-label fw-bold">Product Image <span class="text-danger">*</span></label>
                            <input type="file" name="product_image" class="form-control border-primary" id="product_image" accept="image/*" required>
                            <div class="invalid-feedback">
                                Please upload a product image.
                            </div>
                            <small class="text-muted">Recommended size: 500x500px</small>
                            <div class="mt-2">
                                <img id="imagePreview" src="#" alt="Image Preview" class="img-thumbnail d-none" style="max-width: 150px; max-height: 150px;">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="subcategory_id" class="form-label fw-bold">Category <span class="text-danger">*</span></label>
                            <select name="subcategory_id" class="form-select border-primary" id="subcategory_id" required>
                                <option value="" selected disabled>-- Select Category --</option>
                                @foreach ($category_subs->groupBy('category_name') as $categoryName => $grouped)
                                    <optgroup label="{{ $categoryName }}">
                                        @foreach ($grouped as $sub)
                                            @if ($sub->subcategory_id)
                                                <option value="{{ $sub->subcategory_id }}">{{ $sub->subcategory_name }}</option>
                                            @else
                                                <option disabled>No Subcategories</option>
                                            @endif
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select a category.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                    <button type="reset" class="btn btn-outline-secondary me-md-2">
                        <i class="fas fa-undo me-1"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Add Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// Bootstrap validation
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

document.getElementById('product_image').addEventListener('change', previewImage);
</script>
@endpush
