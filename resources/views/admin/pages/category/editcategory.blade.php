@extends('admin.layout.master')
@section('content')

<h2>Edit Category</h2>

<form action="{{ route('categories.update', $category->category_id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Category Name</label>
        <input type="text" name="category_name" class="form-control" value="{{ $category->category_name }}" required>
    </div>

    <div class="mb-3">
        <label>Current Image</label><br>
        <img src="{{ asset('storage/' . $category->category_image) }}" width="80">
    </div>

    <div class="mb-3">
        <label>Change Image (optional)</label>
        <input type="file" name="category_image" class="form-control">
    </div>

    <div class="mb-3">
        <label>Category Description</label>
        <textarea name="category_description" class="form-control">{{ $category->category_description }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Update Category</button>
</form>

@endsection
