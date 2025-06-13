@extends('admin.layout.master')
@section('content')

<h2>Add New Category</h2>

<form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Category Name</label>
        <input type="text" name="category_name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Category Image</label>
        <input type="file" name="category_image" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Category Description</label>
        <textarea name="category_description" class="form-control" rows="3"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Add Category</button>
    <a href="{{ route('admin.category') }}" class="btn btn-secondary">Back</a>
</form>

@endsection
