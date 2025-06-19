@extends('admin.layout.master')
@section('content')

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                <i class="fas fa-edit me-2"></i>Edit Product
                <span class="float-end">
                    <a href="{{ route('products.index') }}" class="btn btn-sm btn-light">
                        <i class="fas fa-arrow-left me-1"></i> Back to Products
                    </a>
                </span>
            </h4>
        </div>

        <div class="card-body">
            <form action="{{ route('products.update', $product->product_id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="product_name" class="form-label fw-bold">Product Name</label>
                            <input type="text" name="product_name" value="{{ old('product_name', $product->product_name) }}"
                                   class="form-control border-primary" id="product_name" required>
                            <div class="invalid-feedback">
                                Please provide a product name.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="product_description" class="form-label fw-bold">Description</label>
                            <textarea name="product_description" class="form-control border-primary"
                                      id="product_description" rows="3">{{ old('product_description', $product->product_description) }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="product_price" class="form-label fw-bold">Price (₹)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white">₹</span>
                                <input type="number" step="0.01" name="product_price"
                                       value="{{ old('product_price', $product->product_price) }}"
                                       class="form-control border-primary" id="product_price" required>
                                <div class="invalid-feedback">
                                    Please provide a valid price.
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Current Image</label>
                            <div class="border p-2 text-center rounded">
                                @if ($product->product_image)
                                    <img src="{{ asset('storage/' . $product->product_image) }}"
                                         class="img-thumbnail mb-2" style="max-height: 150px">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remove_image" id="remove_image">
                                        <label class="form-check-label text-danger" for="remove_image">
                                            Remove current image
                                        </label>
                                    </div>
                                @else
                                    <p class="text-muted mb-0">No image available</p>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="product_image" class="form-label fw-bold">Change Image</label>
                            <input type="file" name="product_image" class="form-control border-primary"
                                   id="product_image" accept="image/*">
                            <small class="text-muted">Leave blank to keep current image</small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="subcategory_id" class="form-label fw-bold">Category → Subcategory</label>
                            <select name="subcategory_id" class="form-select border-primary" id="subcategory_id" required>
                                <option value="" disabled>-- Select Category --</option>
                                @foreach($categories as $category)
                                    <optgroup label="{{ $category->category_name }}">
                                        @foreach($category->subcategories as $subcategory)
                                            <option value="{{ $subcategory->subcategory_id }}"
                                                {{ old('subcategory_id', $product->subcategory_id) == $subcategory->subcategory_id ? 'selected' : '' }}>
                                                {{ $subcategory->subcategory_name }}
                                            </option>
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

                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4 border-top pt-3">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary me-md-2">
                        <i class="fas fa-times me-1"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Update Product
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

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
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
