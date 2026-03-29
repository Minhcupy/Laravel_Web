<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }

        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: #ffffff;
            border-right: 1px solid #dee2e6;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.05);
        }

        .sidebar .nav-link {
            color: #333;
            font-weight: 500;
            padding: 12px 20px;
            border-radius: 8px;
            margin: 5px 10px;
            transition: 0.2s;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: #0d6efd;
            color: #fff;
        }

        .sidebar h4 {
            padding: 15px;
            text-align: center;
            font-weight: bold;
            border-bottom: 1px solid #dee2e6;
        }

        .content {
            padding: 30px;
            flex: 1;
        }
    </style>
</head>

<body class="d-flex">

    {{-- Sidebar --}}
    <div class="sidebar d-flex flex-column p-2">
        <h4>⚙️ Admin</h4>
        <nav class="nav flex-column">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->is('admin/products*') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i> Quản lý sản phẩm
            </a>
            <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->is('admin/categories*') ? 'active' : '' }}">
                <i class="bi bi-tags"></i> Quản lý danh mục
            </a>
            <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->is('admin/orders*') ? 'active' : '' }}">
                <i class="bi bi-cart-check"></i> Quản lý đơn hàng
            </a>
            <a href="{{ route('admin.reports.index') }}" class="nav-link {{ request()->is('admin/reports*') ? 'active' : '' }}">
                <i class="bi bi-bar-chart-line"></i> Quản lý báo cáo
            </a>
            <a href="{{ route('promotions.index') }}" class="nav-link {{ request()->is('promotions*') ? 'active' : '' }}">
                <i class="bi bi-gift"></i> Quản lý khuyến mại
            </a>
            <a href="{{ route('reviews.index') }}" class="nav-link">
                <i class="bi bi-chat-dots"></i> Quản lý đánh giá
            </a>
        </nav>
        <form action="{{ route('logout') }}" method="POST" class="mt-auto p-3">
            @csrf
            <button class="btn btn-danger w-100"><i class="bi bi-box-arrow-right"></i> Đăng xuất</button>
        </form>
    </div>

    {{-- Nội dung --}}
    <div class="content">
        @yield('content')
    </div>

</body>

</html>