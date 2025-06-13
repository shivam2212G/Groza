@extends('admin.layout.master')
@section('content')

<h3>Subcategory List</h3>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Subcategory</th>
            <th>Description</th>
            <th>Category</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($subcategories as $subcategory)
        <tr>
            <td>{{ $subcategory->subcategory_id }}</td>
            <td>{{ $subcategory->subcategory_name }}</td>
            <td>{{ $subcategory->subcategory_description }}</td>
            <td>{{ $subcategory->category_name }}</td>
            <td>
                <a href="{{ route('subcategories.edit', $subcategory->subcategory_id) }}" class="btn btn-sm btn-warning">Edit</a>
                <a href="{{ route('subcategories.delete', $subcategory->subcategory_id) }}" onclick="return confirm('Delete this?')" class="btn btn-sm btn-danger">Delete</a>
            </td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center">No subcategories found.</td></tr>
        @endforelse
    </tbody>
</table>

<a href="{{ route('subcategories.create') }}" class="btn btn-primary">Add Subcategory</a>

@endsection
