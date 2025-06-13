@extends('admin.layout.master')
@section('content')

<h3>Add Product</h3>

<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Product Name</label>
        <input type="text" name="product_name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Product Image</label>
        <input type="file" name="product_image" class="form-control">
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea name="product_description" class="form-control"></textarea>
    </div>

    <select name="subcategory_id" class="form-control" required>
    <option value="">-- Select --</option>
    @foreach ($category_subs->groupBy('category_name') as $categoryName => $grouped)
        <optgroup label="{{ $categoryName }}">
            @foreach ($grouped as $sub)
                <option value="{{ $sub->subcategory_id }}">{{ $sub->subcategory_name }}</option>
            @endforeach
        </optgroup>
    @endforeach
    </select>

    <button type="submit" class="btn btn-success">Add Product</button>
</form>

@endsection
