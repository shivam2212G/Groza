@extends('admin.layout.master')
@section('content')

<h3>Product List</h3>
<a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add Product</a>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Image</th>
            <th>Description</th>
            <th>Category</th>
            <th>Subcategory</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $p)
        <tr>
            <td>{{ $p->product_id }}</td>
            <td>{{ $p->product_name }}</td>
            <td>
                @if ($p->product_image)
                    <img src="{{ asset('storage/' . $p->product_image) }}" width="60">
                @endif
            </td>
            <td>{{ $p->product_description }}</td>
            <td>{{ $p->category_name }}</td>
            <td>{{ $p->subcategory_name }}</td>
            <td>
                <a href="{{ route('products.edit', $p->product_id) }}" class="btn btn-warning btn-sm">Edit</a>
                <a href="{{ route('products.delete', $p->product_id) }}" class="btn btn-danger btn-sm">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
