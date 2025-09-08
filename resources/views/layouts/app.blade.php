<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            background-color: #f8fbff;
        }

        main {
            flex: 1;
        }

        .navbar {
            background: linear-gradient(90deg, #1e88e5, #42a5f5) !important;
        }

        .nav-link:hover,
        .nav-link.active {
            background: rgba(244, 67, 54, 0.8) !important;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .custom-dropdown {
            min-width: 220px;
            padding: 8px 0;
            animation: fadeInDown 0.25s ease-in-out;
        }

        .custom-dropdown .dropdown-item:hover {
            background-color: rgba(244, 67, 54, 0.1);
            color: #f44336;
            border-radius: 6px;
            transition: all 0.2s;
            padding-left: 20px;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Button styles */
        .btn-primary {
            background: linear-gradient(135deg, #1e88e5, #42a5f5);
            border: none;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #f44336, #e53935);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(244, 67, 54, 0.3);
        }

        .btn-outline-primary {
            color: #1e88e5;
            border-color: #1e88e5;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background-color: #f44336;
            border-color: #f44336;
            color: white;
            transform: translateY(-2px);
        }

        .btn-danger {
            background: linear-gradient(135deg, #f44336, #e53935);
            border: none;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #d32f2f, #c62828);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(244, 67, 54, 0.3);
        }

        .card {
            border-radius: 15px;
            border: none;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm mb-4">
        <div class="container">
            {{-- Logo không có link --}}
            <span class="navbar-brand d-flex align-items-center fw-bold text-white">
                <i class="bi bi-trophy me-2 text-white"></i> VợtPro - Vợt Cầu Lông Chuyên Nghiệp
            </span>

            <div>
                <ul class="navbar-nav align-items-center">

                    {{-- Form tìm kiếm --}}
                    <form action="{{ route('shop.index') }}" method="GET" class="d-flex mx-auto"
                        style="max-width: 500px; flex:1;">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control rounded-pill ps-3"
                                placeholder="Tìm kiếm sản phẩm..." value="{{ request('search') }}"
                                style="border-right: none;">
                            <button type="submit"
                                class="btn bg-white rounded-circle ms-n5 d-flex align-items-center justify-content-center"
                                style="width: 40px; height: 40px;">
                                <i class="bi bi-search text-primary"></i>
                            </button>
                        </div>
                    </form>

                    {{-- Trang chủ --}}
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('shop.index') }}">
                            <i class="bi bi-house-door-fill me-1"></i> Trang chủ
                        </a>
                    </li>

                    {{-- Danh mục sản phẩm --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-tags me-1"></i> Danh mục sản phẩm
                        </a>
                        <ul class="dropdown-menu custom-dropdown shadow-lg border-0 mt-2 rounded-3"
                            aria-labelledby="navbarDropdown">
                            @php
                                $categories = App\Models\Category::all();
                            @endphp
                            @forelse($categories as $category)
                                <li>
                                    <a class="dropdown-item py-2 px-3 fw-semibold hover-item
                                        {{ request('category') == $category->id ? 'active bg-light text-primary' : '' }}"
                                        href="{{ route('shop.index', ['category' => $category->id]) }}">
                                        <i class="bi bi-chevron-right small me-2 text-primary"></i>
                                        {{ $category->TenDM ?? $category->name }}
                                    </a>
                                </li>
                            @empty
                                <li><span class="dropdown-item text-muted">Chưa có danh mục</span></li>
                            @endforelse
                        </ul>
                    </li>

                    {{-- Admin Dashboard --}}
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('dashboard') }}">
                                    <i class="bi bi-speedometer2 me-1"></i> Dashboard
                                </a>
                            </li>
                        @endif
                    @endauth

                    {{-- Giỏ hàng --}}
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('cart.index') }}">
                            <i class="bi bi-cart3 me-1"></i> Cart
                        </a>
                    </li>

                    {{-- Profile Dropdown --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center text-white" href="#"
                            id="navbarProfileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i>
                            @auth
                                {{ Auth::user()->name }}
                            @else
                                Tài khoản
                            @endauth
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end custom-dropdown"
                            aria-labelledby="navbarProfileDropdown">
                            @guest
                                <li>
                                    <a class="dropdown-item" href="{{ route('login') }}">
                                        <i class="bi bi-box-arrow-in-right me-1"></i> Đăng nhập
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('register') }}">
                                        <i class="bi bi-person-plus me-1"></i> Đăng ký
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        <i class="bi bi-person-lines-fill me-1"></i> Hồ sơ cá nhân
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="bi bi-box-arrow-right me-1"></i> Đăng xuất
                                        </button>
                                    </form>
                                </li>
                            @endguest
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Nội dung chính --}}
    <main class="container mb-4">
        @isset($slot)
            {{ $slot }}
        @else
            @yield('content')
        @endisset
    </main>

    {{-- Footer --}}
    @include('layouts.footer')
</body>
</html>
