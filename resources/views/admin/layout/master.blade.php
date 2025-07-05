<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Admin Panel') - Grocery App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/img/kaiadmin/favicon.ico') }}" type="image/x-icon">

    <!-- Fonts and icons -->
    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["{{ asset('assets/css/fonts.min.css') }}"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">

    @stack('styles')
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <div class="logo-header" data-background-color="dark">
                    {{-- <a href="{{ route('admins.dashboard') }}" class="logo">
                        <img src="{{ asset('assets/img/kaiadmin/logo_light.svg') }}" alt="Grocery App" class="navbar-brand" height="30">
                    </a> --}}
                    <h1  style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;font-weight: bold;color: rgb(0, 174, 255)">
                        Groza
                    </h1>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
            </div>

            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-secondary">
                        <li class="nav-item {{ request()->routeIs('admins.dashboard') ? 'active' : '' }}">
                            <a href="{{ route('admins.dashboard') }}">
                                <i class="fas fa-home me-2"></i>
                                <span class="sub-item">Dashboard</span>
                            </a>
                        </li>

                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Inventory</h4>
                        </li>

                        <li class="nav-item {{ request()->routeIs('admin.category*') ? 'active' : '' }}">
                            <a href="{{ route('admin.category') }}">
                                <i class="fas fa-layer-group me-2"></i>
                                <span class="sub-item">Categories</span>
                            </a>
                        </li>

                        <li class="nav-item {{ request()->routeIs('subcategories*') ? 'active' : '' }}">
                            <a href="{{ route('subcategories.index') }}">
                                <i class="fas fa-tags me-2"></i>
                                <span class="sub-item">Subcategories</span>
                            </a>
                        </li>

                        <li class="nav-item {{ request()->routeIs('products*') ? 'active' : '' }}">
                            <a href="{{ route('products.index') }}">
                                <i class="fas fa-shopping-basket me-2"></i>
                                <span class="sub-item">Products</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <!-- Header -->
            <div class="main-header">
                <div class="main-header-logo">
                    <div class="logo-header" data-background-color="dark">
                        <a href="{{ route('admins.dashboard') }}" class="logo">
                            <img src="{{ asset('assets/img/kaiadmin/logo_light.svg') }}" alt="Grocery App" class="navbar-brand" height="30">
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                </div>

                <!-- Navbar -->
                <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                    <div class="container-fluid">
                        <!-- Search Form -->
                        <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="submit" class="btn btn-search pe-1">
                                        <i class="fa fa-search search-icon"></i>
                                    </button>
                                </div>
                                <input type="text" placeholder="Search products..." class="form-control">
                            </div>
                        </nav>

                        <!-- Top Navigation -->
                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                            <!-- Mobile Search -->
                            <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button">
                                    <i class="fa fa-search"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-search animated fadeIn">
                                    <form class="navbar-left navbar-form nav-search">
                                        <div class="input-group">
                                            <input type="text" placeholder="Search..." class="form-control">
                                        </div>
                                    </form>
                                </ul>
                            </li>

                            <!-- User Profile -->
                            @php
                            $admin = App\Models\Admin::find(session('admin_id'));
                            @endphp
                            <li class="nav-item topbar-user dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#">
                                    <div class="avatar-sm">
                                        <img src="{{ asset('assets/img/profile.jpg') }}" alt="Admin" class="avatar-img rounded-circle">
                                    </div>
                                    <span class="profile-username">
                                        <span class="op-7">Hi,</span>
                                        <span class="fw-bold">{{ $admin->owner_name ?? 'Admin' }}</span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">
                                        <li>
                                            <div class="user-box">
                                                <div class="avatar-lg">
                                                    <img src="{{ asset('assets/img/profile.jpg') }}" alt="Admin" class="avatar-img rounded">
                                                </div>
                                                <div class="u-text">
                                                    <h4>{{ $admin->shop_name ?? 'Admin' }}</h4>
                                                    <p class="text-muted">{{ $admin->email ?? 'admin@example.com' }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        
                                        <li>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="{{ route('admin.profile',['id'=>$admin->admin_id]) }}">
                                                <i class="fas fa-user me-2"></i> My Profile
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="fas fa-cog me-2"></i> Settings
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <form action="{{ route('admins.logout') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger">Logout</button>
                                            </form>
                                        </li>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>
            <!-- End Header -->

            <!-- Main Content -->
            <div class="main-content">
                <div class="container-fluid">
                    <div class="page-inner">
                        <!-- Page Header -->
                        <div class="page-header">
                            <h4 class="page-title">@yield('page_title')</h4>
                            <ul class="breadcrumbs">
                                <li class="nav-home">
                                    <a href="{{ route('admins.dashboard') }}">
                                        <i class="flaticon-home"></i>
                                    </a>
                                </li>
                                @yield('breadcrumbs')
                            </ul>
                        </div>

                        <!-- Content -->
                        <div class="row">
                            <div class="col-md-12">
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="footer">
                <div class="container-fluid d-flex justify-content-between">
                    <div class="copyright">
                        &copy; {{ date('Y') }} <strong>Grocery App</strong>. All rights reserved.
                    </div>
                    <div class="version">
                        v1.0.0
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Core JS Files -->
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

    <!-- Plugins -->
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>

    @stack('scripts')
</body>
</html>
