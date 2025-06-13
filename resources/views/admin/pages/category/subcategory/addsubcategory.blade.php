@extends('admin.layout.master')
@section('content')

<h3>Add Subcategory</h3>

<form action="{{ route('subcategories.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Subcategory Name</label>
        <input type="text" name="subcategory_name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea name="subcategory_description" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label>Category</label>
        <select name="category_id" class="form-control" required>
            <option value="">-- Select Category --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">Add</button>
</form>

@endsection
