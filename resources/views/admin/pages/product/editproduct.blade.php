@extends('admin.layout.master')
@section('content')

<h3>Edit Product</h3>

<form action="{{ route('products.update', $product->product_id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Product Name</label>
        <input type="text" name="product_name" value="{{ $product->product_name }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Product Price</label>
        <input type="text" name="product_price" value="{{ $product->product_price }}" class="form-control" required>
    </div>


    <div class="mb-3">
        <label>Current Image</label><br>
        @if ($product->product_image)
            <img src="{{ asset('storage/' . $product->product_image) }}" width="100">
        @else
            <p>No image</p>
        @endif
    </div>

    <div class="mb-3">
        <label>Change Image</label>
        <input type="file" name="product_image" class="form-control">
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea name="product_description" class="form-control">{{ $product->product_description }}</textarea>
    </div>

    <div class="mb-3">
        <label>Category → Subcategory</label>
        <select name="subcategory_id" class="form-control" required>
            <option value="">-- Select --</option>
            @foreach($categories as $category)
                <optgroup label="{{ $category->category_name }}">
                    @foreach($category->subcategories as $subcategory)
                        <option value="{{ $subcategory->subcategory_id }}"
                            {{ $product->subcategory_id == $subcategory->subcategory_id ? 'selected' : '' }}>
                            {{ $subcategory->subcategory_name }}
                        </option>
                    @endforeach
                </optgroup>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
</form>

@endsection
