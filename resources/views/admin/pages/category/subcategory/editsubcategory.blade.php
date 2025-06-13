@extends('admin.layout.master')

@section('content')

<h3>Edit Subcategory</h3>

<form action="{{ route('subcategories.update', $subcategory->subcategory_id) }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="subcategory_name" class="form-label">Subcategory Name</label>
        <input type="text" name="subcategory_name" class="form-control" value="{{ $subcategory->subcategory_name }}" required>
    </div>

    <div class="mb-3">
        <label for="subcategory_description" class="form-label">Subcategory Description</label>
        <textarea name="subcategory_description" class="form-control">{{ $subcategory->subcategory_description }}</textarea>
    </div>

    <div class="mb-3">
        <label for="category_id" class="form-label">Select Category</label>
        <select name="category_id" class="form-control" required>
            <option value="">-- Select Category --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->category_id }}"
                    {{ $subcategory->category_id == $category->category_id ? 'selected' : '' }}>
                    {{ $category->category_name }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('subcategories.index') }}" class="btn btn-secondary">Back</a>
</form>

@endsection
