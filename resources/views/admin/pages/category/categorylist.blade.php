@extends('admin.layout.master')
@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Category Name</th>
            <th>Image</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($categories as $category)
        <tr>
            <td>{{ $category->category_id }}</td>
            <td>{{ $category->category_name }}</td>
            <td>
                <img src="{{ asset('storage/' . $category->category_image) }}" width="60" alt="Image">
            </td>
            <td>{{ $category->category_description }}</td>
            <td>
                <a href="{{ route('categories.edit', $category->category_id) }}" class="btn btn-sm btn-warning">Edit</a>
                <a href="{{ route('categories.delete', $category->category_id) }}" class="btn btn-sm btn-warning">Delete</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">No categories found.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<a href="{{ route('categories.create') }}"><button class="btn btn-primary">Add Category</button></a>

@endsection
