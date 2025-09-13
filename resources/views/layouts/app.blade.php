<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

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
        }

        main {
            flex: 1;
        }


        /* Enhanced Navbar */
        .navbar {
            background: linear-gradient(135deg, #1b70efff 0%, #6e1af6ff 100%) !important;
            box-shadow: 0 4px 20px rgba(11, 94, 215, 0.3);
            position: sticky;
            top: 0;
            z-index: 1050;
        }

        /* Logo hover effect */
        .navbar-brand {
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .navbar-brand img {
            transition: transform 0.3s ease;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
        }

        .navbar-brand:hover img {
            transform: rotate(5deg);
        }

        /* Enhanced Search */
        .navbar form .form-control {
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar form .form-control:focus {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
        }

        .navbar form .btn {
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .navbar form .btn:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        /* Enhanced Nav Links */
        .nav-link {
            transition: all 0.3s ease !important;
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.15);
            transition: left 0.3s ease;
            border-radius: 6px;
        }

        .nav-link:hover::before,
        .nav-link.active::before {
            left: 0;
        }

        .nav-link:hover,
        .nav-link.active {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 6px;
            transition: 0.2s;
            transform: translateY(-2px);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        /* Enhanced Dropdown */
        .custom-dropdown {
            min-width: 220px;
            padding: 8px 0;
            animation: fadeInDown 0.25s ease-in-out;
            background: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(10px);
            border: none !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2) !important;
            border-radius: 12px !important;
            z-index: 9999 !important;
        }

        .custom-dropdown .dropdown-item {
            transition: all 0.3s ease;
        }

        .custom-dropdown .dropdown-item:hover {
            background: linear-gradient(135deg, rgba(11, 94, 215, 0.1), rgba(102, 16, 242, 0.1)) !important;
            color: #0b5ed7 !important;
            border-radius: 6px;
            transition: all 0.2s;
            padding-left: 20px;
            transform: translateX(5px);
        }

        /* Dropdown Submenu */
        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu>.dropdown-menu {
            top: 0;
            left: 100%;
            margin-left: 0;
            border-radius: 0.375rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            background: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(10px);
            z-index: 10000 !important;
        }

        .dropdown-submenu>.dropdown-menu .dropdown-item::after {
            content: none !important;
        }

        .dropdown-submenu:hover>.dropdown-menu {
            display: block;
        }

        .dropdown-submenu>.dropdown-menu {
            animation: fadeInDown 0.25s ease-in-out;
        }

        /* Cart Badge Enhancement */
        .nav-link .bi-cart {
            transition: transform 0.3s ease;
        }

        .nav-link:hover .bi-cart {
            transform: scale(1.1);
        }

        #cart-count {
            animation: pulse 2s infinite;
        }

        .cart-badge {
            position: absolute;
            top: 0;
            right: 0;
            /* giữ badge sát góc phải */
            transform: translate(40%, -40%);
            /* căn chuẩn trên mọi trang */
            min-width: 20px;
            height: 20px;
            font-size: 12px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 6px;
            /* số 2–3 chữ số vẫn đẹp */
            border-radius: 12px;
            line-height: 1;
            background-color: #dc3545;
            /* đỏ bootstrap */
            color: #fff;
        }


        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
                /* ❌ bỏ translate(-50%, -50%) */
            }

            50% {
                transform: scale(1.1);
                /* chỉ scale thôi */
            }
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

        /* Mobile responsive */
        @media (max-width: 991px) {
            .navbar form {
                margin: 1rem 0;
                width: 100%;
            }

            .navbar-nav {
                text-align: center;
            }
        }

        /* Toast enhancement */
        .toast-container {
            z-index: 9999 !important;
        }

        #cart-toast {
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.3);
        }
    </style>
</head>

<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm mb-4">
        <div class="container">
            {{-- Logo không có link --}}
            <a class="navbar-brand d-flex align-items-center fw-bold text-white" href="{{ route('shop.index') }}">
                <img src="{{ asset('img/Logoweb.png') }}"
                    alt="Mimi Shop Logo"
                    class="me-2"
                    style="height:45px; width:auto;">
            </a>

            <div>
                <ul class="navbar-nav align-items-center">

                    {{-- Form tìm kiếm --}}
                    <form action="{{ route('shop.index') }}#product-section" method="GET" class="d-flex mx-auto"
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
                            Danh mục sản phẩm
                        </a>
                        <ul class="dropdown-menu custom-dropdown shadow-lg border-0 mt-2 rounded-3" aria-labelledby="navbarDropdown">
                            @php
                            $categories = App\Models\Category::whereNull('parent_id')->with('children')->get();
                            @endphp

                            @forelse($categories as $category)
                            <li class="dropdown-submenu">
                                <a class="dropdown-item py-2 px-3 fw-semibold {{ request()->query('category') == $category->id ? 'active bg-light text-primary' : '' }}"
                                    href="{{ route('shop.index', ['category' => $category->id]) }}#product-section">
                                    <i class="bi bi-chevron-right small me-2 text-primary"></i> {{ $category->name }}
                                </a>

                                @if($category->children->count())
                                <ul class="dropdown-menu">
                                    @foreach($category->children as $child)
                                    <li>
                                        <a class="dropdown-item py-2 px-3 {{ request()->query('category') == $child->id ? 'active bg-light text-primary' : '' }}"
                                            href="{{ route('shop.index', ['category' => $child->id]) }}#product-section">
                                            {{ $child->name }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
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
                            Dashboard
                        </a>
                    </li>
                    @endif
                    @endauth

                    <li class="nav-item">
                        <a href="{{ route('cart.index') }}" class="nav-link position-relative">
                            <i class="bi bi-cart" style="font-size: 1.3rem;"></i>
                            <span id="cart-count"
                                class="badge rounded-pill bg-danger cart-badge">
                                {{ session('cart') ? collect(session('cart'))->sum('quantity') : 0 }}
                            </span>
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

    {{-- Toast giỏ hàng --}}
    <div class="toast-container position-fixed top-0 end-0 p-3" style="margin-top:70px; z-index:2000;">
        <div id="cart-toast" class="toast align-items-center text-bg-success border-0 shadow" role="alert">
            <div class="d-flex">
                <div class="toast-body fw-bold">
                    Đã thêm vào giỏ hàng!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Giữ nguyên code cũ xử lý giỏ hàng...
            document.querySelectorAll('.add-to-cart').forEach(btn => {
                btn.addEventListener('click', function() {
                    // Tìm thẻ bao quanh sản phẩm
                    let productCard = this.closest('.card') || this.closest('.product-card');

                    // Nếu không tìm thấy, mặc định quantity = 1
                    let quantity = 1;

                    if (productCard) {
                        let quantityInput = productCard.querySelector('input[type="number"]');
                        if (quantityInput) {
                            quantity = parseInt(quantityInput.value) || 1;
                        }
                    }

                    fetch(`/cart/add/${this.dataset.id}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Content-Type': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: JSON.stringify({
                                quantity
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                document.getElementById('cart-count').innerText = data.cart_count;
                                let toast = new bootstrap.Toast(document.getElementById('cart-toast'));
                                toast.show();
                            } else {
                                alert(data.error ?? 'Có lỗi xảy ra!');
                            }
                        });
                });
            });

            // ✅ Scroll tới sản phẩm nếu có #product-section
            if (window.location.hash === "#product-section") {
                let el = document.querySelector("#product-section");
                if (el) {
                    el.scrollIntoView({
                        behavior: "smooth"
                    });
                }
            }
        });
    </script>

</body>

</html>