<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grocery Admin | Login</title>
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
            margin: 0;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 450px;
            margin: 0 auto;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .login-header {
            background-color: var(--primary-color);
            color: white;
            padding: 20px;
            text-align: center;
        }

        .login-header h2 {
            margin: 0;
            font-weight: 600;
            font-size: 1.5rem;
        }

        .login-header i {
            font-size: 2rem;
            margin-bottom: 10px;
            color: var(--secondary-color);
        }

        .login-body {
            background-color: white;
            padding: 25px;
        }

        .form-control {
            height: 46px;
            padding: 10px 15px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            font-size: 0.95rem;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(76, 175, 80, 0.2);
        }

        .input-group {
            margin-bottom: 18px;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #e0e0e0;
            border-right: none;
            border-radius: 8px 0 0 8px !important;
            height: 46px;
            padding: 0 15px;
        }

        .input-with-icon {
            border-left: none;
            border-radius: 0 8px 8px 0 !important;
        }

        .btn-login {
            background-color: var(--primary-color);
            border: none;
            padding: 10px;
            font-weight: 600;
            width: 100%;
            border-radius: 8px;
            transition: all 0.3s;
            height: 46px;
            font-size: 0.95rem;
        }

        .btn-login:hover {
            background-color: var(--primary-dark);
        }

        .btn-register {
            background-color: white;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
            padding: 10px;
            font-weight: 600;
            width: 100%;
            border-radius: 8px;
            transition: all 0.3s;
            margin-top: 12px;
            height: 46px;
            font-size: 0.95rem;
        }

        .btn-register:hover {
            background-color: #f0f0f0;
        }

        .alert {
            border-radius: 8px;
            padding: 10px 15px;
            font-size: 0.9rem;
            margin-bottom: 18px;
        }

        label {
            font-weight: 500;
            margin-bottom: 6px;
            display: block;
            font-size: 0.95rem;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
        }

        .remember-me {
            display: flex;
            align-items: center;
        }

        .remember-me input {
            margin-right: 8px;
        }

        .forgot-password {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <i class="fas fa-shopping-basket"></i>
            <h2>Grocery Admin Portal</h2>
        </div>

        <div class="login-body">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('admins.login.submit') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="email">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control input-with-icon" id="email" placeholder="admin@example.com" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" class="form-control input-with-icon" id="password" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="remember-forgot">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember" style="margin-bottom: 0; font-weight: normal;">Remember me</label>
                    </div>
                    <a href="#" class="forgot-password">Forgot password?</a>
                </div>

                <button type="submit" class="btn btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i> Login
                </button>

                <a href="{{ route('showReisterForm') }}" class="btn btn-register">
                    <i class="fas fa-user-plus me-2"></i> Register New Admin
                </a>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
