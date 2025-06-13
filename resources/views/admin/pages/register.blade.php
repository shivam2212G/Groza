<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Admin</title>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Register Admin</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="shop_name" class="form-label">Shop Name</label>
            <input type="text" name="shop_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="owner_name" class="form-label">Owner Name</label>
            <input type="text" name="owner_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="shop_image" class="form-label">Shop Image</label>
            <input type="file" name="shop_image" class="form-control" accept="image/*" required>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" name="location" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
    <a href="{{ route('admins.login') }}">
        <button>Login</button>
    </a>
</div>

</body>
</html>
