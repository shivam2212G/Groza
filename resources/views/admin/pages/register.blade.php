<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grocery Admin | Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4CAF50;
            --primary-dark: #388E3C;
            --secondary-color: #FFC107;
            --light-bg: #F9F9F9;
            --dark-text: #333333;
        }

        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
            min-height: 100vh;
            padding: 20px 0;
        }

        .register-container {
            width: 900px;
            margin: 0 auto;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .register-header {
            background-color: var(--primary-color);
            color: white;
            padding: 20px;
            text-align: center;
        }

        .register-header h2 {
            margin: 0;
            font-weight: 600;
            font-size: 1.5rem;
        }

        .register-header i {
            font-size: 2rem;
            margin-bottom: 10px;
            color: var(--secondary-color);
        }

        .register-body {
            background-color: white;
            padding: 25px;
        }

        .form-control, .form-select {
            height: 45px;
            padding: 10px 15px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            font-size: 0.9rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(76, 175, 80, 0.25);
        }

        .file-label {
            display: block;
            padding: 10px;
            border: 1px dashed #e0e0e0;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            height: 45px;
            font-size: 0.9rem;
        }

        .file-label:hover {
            border-color: var(--primary-color);
            background-color: rgba(76, 175, 80, 0.05);
        }

        .btn-register {
            background-color: var(--primary-color);
            border: none;
            padding: 10px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s;
            height: 45px;
            color: white;
            font-size: 0.9rem;
            width: 48%;
        }

        .btn-register:hover {
            background-color: var(--primary-dark);
        }

        .btn-login {
            background-color: white;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
            padding: 10px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s;
            height: 45px;
            font-size: 0.9rem;
            width: 48%;
        }

        .btn-login:hover {
            background-color: var(--light-bg);
            color: var(--primary-dark);
        }

        label {
            font-weight: 500;
            margin-bottom: 5px;
            display: block;
            font-size: 0.9rem;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 15px;
        }

        .form-group {
            flex: 1;
            min-width: 200px;
        }

        .buttons-row {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .file-upload {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <i class="fas fa-store-alt"></i>
            <h2>Register New Admin</h2>
        </div>

        <div class="register-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-3" role="alert" style="font-size: 0.9rem;">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label for="shop_name">Shop Name</label>
                        <input type="text" name="shop_name" class="form-control" id="shop_name" placeholder="Shop name" required>
                    </div>
                    <div class="form-group">
                        <label for="owner_name">Owner Name</label>
                        <input type="text" name="owner_name" class="form-control" id="owner_name" placeholder="Owner name" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="admin@example.com" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" name="location" class="form-control" id="location" placeholder="Shop location" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-select" id="status" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="file-upload">
                    <label for="shop_image">Shop Image</label>
                    <div class="position-relative">
                        <label for="shop_image" class="file-label">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Choose shop image
                        </label>
                        <input type="file" name="shop_image" id="shop_image" class="form-control position-absolute top-0 start-0 w-100 h-100 opacity-0" accept="image/*" required>
                    </div>
                </div>

                <div class="buttons-row">
                    <button type="submit" class="btn btn-register">
                        <i class="fas fa-user-plus me-2"></i> Register
                    </button>
                    <a href="{{ route('admins.login') }}" class="btn btn-login">
                        <i class="fas fa-sign-in-alt me-2"></i> Login
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
