@extends('layouts.app')

@section('content')
<style>
    /* Enhanced Carousel */
    .carousel.slide {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.18);
    }

    .carousel-item img {
        width: 100%;
        height: auto;
        /* để giữ nguyên tỉ lệ ảnh */
        object-fit: contain;
        /* hiển thị toàn ảnh */
        background-color: #000;
        /* thêm nền đen cho cân đối khi ảnh không full */
        transition: all 0.5s ease;
    }


    .carousel-item.active img {
        filter: brightness(0.9) saturate(1.2) contrast(1.15);
        transform: scale(1.02);
    }

    /* Enhanced Carousel Caption */
    .carousel-caption {
        background: rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(15px);
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 1.5rem 2rem;
        bottom: 10%;
        left: 5%;
        right: 5%;
        transform: none;
        animation: slideUpFade 0.8s ease-out;
    }

    @keyframes slideUpFade {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .carousel-caption h5 {
        font-weight: 700;
        letter-spacing: 0.5px;
        color: white;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        margin-bottom: 0.5rem;
    }

    .carousel-caption p {
        color: rgba(255, 255, 255, 0.95);
        font-weight: 500;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
    }

    /* Bỏ enhanced carousel controls - dùng mặc định */

    /* Enhanced Indicators */
    .carousel-indicators {
        bottom: 20px;
    }

    .carousel-indicators button {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        border: 2px solid rgba(255, 255, 255, 0.8);
        transition: all 0.3s ease;
    }

    .carousel-indicators button.active {
        background: white;
        transform: scale(1.2);
    }

    /* Enhanced Section Styling */
    #featured-section,
    #product-section {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        margin: 3rem 0;
        padding: 3rem 2rem;
        box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
        position: relative;
        overflow: hidden;
    }

    /* Animated Background for Sections */
    #featured-section::before,
    #product-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background:
            radial-gradient(circle at 80% 20%, rgba(120, 119, 198, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
        z-index: -1;
        animation: float 15s ease-in-out infinite alternate;
    }

    /* Enhanced Section Headers */
    #featured-section h2,
    #product-section h2 {
        position: relative;
        font-weight: 800;
        margin-bottom: 3rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-align: center;
        font-size: 2.5rem;
    }

    #featured-section h2::after,
    #product-section h2::after {
        content: "";
        display: block;
        width: 120px;
        height: 4px;
        background: linear-gradient(90deg, #667eea, #764ba2);
        margin: 1rem auto 0 auto;
        border-radius: 2px;
        animation: pulse 2s ease-in-out infinite alternate;
    }

    @keyframes pulse {
        from {
            transform: scaleX(1);
        }

        to {
            transform: scaleX(1.2);
        }
    }

    /* Enhanced Product Cards */
    .product-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 16px;
        transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
        overflow: hidden;
        position: relative;
        box-shadow: 0 4px 20px rgba(31, 38, 135, 0.2);
    }

    .product-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        transition: left 0.5s;
        z-index: 1;
    }

    .product-card:hover::before {
        left: 100%;
    }

    .product-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 15px 40px rgba(31, 38, 135, 0.4);
        border-color: rgba(255, 255, 255, 0.5);
    }

    /* Enhanced Product Image */
    .product-image-wrapper {
        height: 240px;
        background: linear-gradient(135deg, rgba(250, 250, 252, 1), rgba(245, 247, 250, 1));
        border-bottom: 1px solid rgba(0, 0, 0, .06);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        border-radius: 16px 16px 0 0;
    }

    .product-image-wrapper img {
        transition: transform 0.6s cubic-bezier(0.23, 1, 0.320, 1);
        max-height: 90%;
        max-width: 90%;
        object-fit: contain;
        filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.1));
    }

    .product-card:hover .product-image-wrapper img {
        transform: scale(1.15) rotate(2deg);
    }

    /* Enhanced Card Body */
    .card-body {
        padding: 1.5rem;
        position: relative;
        z-index: 2;
    }

    .card-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
        color: #2d3748;
        transition: color 0.3s ease;
    }

    .product-card:hover .card-title {
        color: #667eea;
    }

    /* Enhanced Price Display */
    .price-row {
        display: flex;
        align-items: baseline;
        gap: 0.75rem;
        flex-wrap: wrap;
        margin-bottom: 1rem;
    }

    .discount-price {
        color: #e53e3e;
        font-weight: 700;
        font-size: 1.2rem;
    }

    .original-price {
        color: #a0aec0;
        text-decoration: line-through;
        font-size: 0.95rem;
    }

    .sale-badge {
        background: linear-gradient(135deg, #48bb78, #38a169);
        color: white;
        font-weight: 700;
        font-size: 0.8rem;
        padding: 0.25rem 0.5rem;
        border-radius: 8px;
        animation: bounce 2s infinite;
    }

    @keyframes bounce {

        0%,
        20%,
        50%,
        80%,
        100% {
            transform: translateY(0);
        }

        40% {
            transform: translateY(-4px);
        }

        60% {
            transform: translateY(-2px);
        }
    }

    /* Enhanced Stock Badge */
    .stock-badge {
        font-size: 0.85rem;
        padding: 0.4rem 0.8rem;
        border-radius: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }

    .stock-badge.bg-success {
        background: linear-gradient(135deg, #48bb78, #38a169) !important;
    }

    .stock-badge.bg-danger {
        background: linear-gradient(135deg, #f56565, #e53e3e) !important;
    }

    /* Enhanced Buttons */
    .btn {
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
        position: relative;
        overflow: hidden;
    }

    .btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: width 0.4s, height 0.4s;
    }

    .btn:active::before {
        width: 200px;
        height: 200px;
    }

    .btn-outline-info {
        border: 2px solid #3182ce;
        color: #3182ce;
        background: rgba(49, 130, 206, 0.1);
    }

    .btn-outline-info:hover {
        background: linear-gradient(135deg, #3182ce, #2c5282);
        border-color: #2c5282;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(49, 130, 206, 0.4);
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea, #764ba2);
        border: none;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #5a6fd8, #6a4190);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    /* Enhanced Pagination */
    .pagination {
        gap: 6px;
        justify-content: center;
        margin-top: 3rem;
    }

    .pagination .page-link {
        padding: 8px 16px;
        font-size: 14px;
        font-weight: 500;
        border-radius: 10px;
        border: 2px solid rgba(102, 126, 234, 0.2);
        color: #667eea;
        background: rgba(255, 255, 255, 0.8);
        transition: all 0.3s ease;
    }

    .pagination .page-link:hover {
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-color: #667eea;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-color: #667eea;
        color: white;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }

    /* Enhanced Text Styling */
    .text-primary {
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 700 !important;
    }

    /* Responsive Enhancements */
    @media (max-width: 768px) {
        .carousel-caption {
            padding: 1rem;
            bottom: 5%;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 40px;
            height: 40px;
        }

        .product-image-wrapper {
            height: 200px;
        }

        #featured-section,
        #product-section {
            margin: 2rem 0;
            padding: 2rem 1rem;
        }

        #featured-section h2,
        #product-section h2 {
            font-size: 2rem;
        }
    }

    /* Loading Animation */
    .btn-loading {
        color: transparent;
    }

    .btn-loading::after {
        content: '';
        position: absolute;
        width: 16px;
        height: 16px;
        top: 50%;
        left: 50%;
        margin-left: -8px;
        margin-top: -8px;
        border: 2px solid transparent;
        border-top: 2px solid currentColor;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* Smooth transitions */
    * {
        transition: color 0.3s ease, background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
    }
</style>

{{-- Enhanced Carousel --}}
<div class="position-relative" style="margin-top:-24px;">
    <div id="productCarousel" class="carousel slide w-100 shadow-lg" data-bs-ride="carousel" data-bs-interval="4000" aria-label="Banner sản phẩm">
        {{-- Indicators --}}
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="0" class="active" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>

        {{-- Images --}}
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('img/banner-danLuoi.jpg') }}" class="d-block w-100" alt="Banner 1">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Chào mừng đến Mimi Shop</h5>
                    <p>Khám phá những sản phẩm hot nhất hôm nay!</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/vot-cau-long.png') }}" class="d-block w-100" alt="Banner 2">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Khuyến mãi đặc biệt</h5>
                    <p>Giảm giá lên tới 50% cho nhiều sản phẩm!</p>
                </div>
            </div>
        </div>

        {{-- Controls --}}
        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev" aria-label="Quay lại">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next" aria-label="Tiếp theo">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>
</div>

{{-- Enhanced Featured Products Section --}}
<div class="container mt-5" id="featured-section">
    <h2 class="mb-4 text-center">Sản phẩm nổi bật</h2>
    <div class="row g-4">
        @forelse($featuredProducts as $product)
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card product-card h-100">
                <div class="product-image-wrapper">
                    <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/200?text=No+Image' }}" alt="{{ $product->name }}">
                </div>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-truncate" title="{{ $product->name }}">{{ $product->name }}</h5>
                    <div class="price-row">
                        @if($product->promotion)
                        <div class="discount-price">{{ number_format($product->discounted_price,0,',','.') }} VNĐ</div>
                        <div class="original-price">{{ number_format($product->price,0,',','.') }} VNĐ</div>
                        <div class="sale-badge ms-auto">-{{ $product->promotion->discount_percentage }}%</div>
                        @else
                        <div class="text-primary fw-bold">{{ number_format($product->price,0,',','.') }} VNĐ</div>
                        @endif
                    </div>
                    <p class="mb-3"><strong>Hàng còn:</strong>
                        @if($product->stock>0)
                        <span class="stock-badge bg-success">
                            <i class="bi bi-check-circle"></i> {{ $product->stock }}
                        </span>
                        @else
                        <span class="stock-badge bg-danger">
                            <i class="bi bi-x-circle"></i> Hết hàng
                        </span>
                        @endif
                    </p>
                    <div class="mt-auto d-flex gap-2">
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-info flex-fill">
                            <i class="bi bi-eye me-1"></i> Chi tiết
                        </a>
                        @auth
                        @if($product->stock>0)
                        <button class="btn btn-primary flex-fill add-to-cart" data-id="{{ $product->id }}">
                            <i class="bi bi-cart-plus me-1"></i> Giỏ
                        </button>
                        @else
                        <button class="btn btn-secondary flex-fill" disabled>
                            <i class="bi bi-cart-x me-1"></i> Hết
                        </button>
                        @endif
                        @else
                        <a href="{{ route('login') }}" class="btn btn-outline-secondary flex-fill">
                            <i class="bi bi-cart-plus me-1"></i> Giỏ
                        </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="text-center py-5">
                <i class="bi bi-inbox display-1 text-muted"></i>
                <p class="text-muted mt-3">Chưa có sản phẩm nổi bật.</p>
            </div>
        </div>
        @endforelse
    </div>
</div>

{{-- Enhanced All Products Section --}}
<div class="container mt-5" id="product-section">
    <h2 class="mb-4 text-center">Tất cả sản phẩm</h2>
    <div class="row g-4">
        @foreach($products as $product)
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card product-card h-100">
                <div class="product-image-wrapper">
                    <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/200?text=No+Image' }}" alt="{{ $product->name }}">
                </div>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-truncate" title="{{ $product->name }}">{{ $product->name }}</h5>
                    <div class="price-row">
                        @if($product->promotion)
                        <div class="discount-price">{{ number_format($product->discounted_price,0,',','.') }} VNĐ</div>
                        <div class="original-price">{{ number_format($product->price,0,',','.') }} VNĐ</div>
                        <div class="sale-badge ms-auto">-{{ $product->promotion->discount_percentage }}%</div>
                        @else
                        <div class="text-primary">{{ number_format($product->price,0,',','.') }} VNĐ</div>
                        @endif
                    </div>
                    <p class="mb-3"><strong>Hàng còn:</strong>
                        @if($product->stock>0)
                        <span class="stock-badge bg-success">
                            <i class="bi bi-check-circle"></i> {{ $product->stock }}
                        </span>
                        @else
                        <span class="stock-badge bg-danger">
                            <i class="bi bi-x-circle"></i> Hết hàng
                        </span>
                        @endif
                    </p>
                    <div class="mt-auto d-flex gap-2">
                        <a href="{{ route('products.show',$product->id) }}" class="btn btn-outline-info flex-fill">
                            <i class="bi bi-eye me-1"></i> Chi tiết
                        </a>
                        @auth
                        @if($product->stock>0)
                        <button class="btn btn-primary flex-fill add-to-cart" data-id="{{ $product->id }}">
                            <i class="bi bi-cart-plus me-1"></i> Giỏ
                        </button>
                        @else
                        <button class="btn btn-secondary flex-fill" disabled>
                            <i class="bi bi-cart-x me-1"></i> Hết
                        </button>
                        @endif
                        @else
                        <a href="{{ route('login') }}" class="btn btn-outline-secondary flex-fill">
                            <i class="bi bi-cart-plus me-1"></i> Giỏ
                        </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Enhanced Pagination --}}
    @if ($products->hasPages())
    <div class="mt-5">
        <div class="text-center text-muted mb-3">
            <small>
                Hiển thị
                <strong>{{ $products->firstItem() }}</strong> -
                <strong>{{ $products->lastItem() }}</strong>
                trong tổng
                <strong>{{ $products->total() }}</strong> sản phẩm
            </small>
        </div>

        <nav aria-label="Pagination" class="d-flex justify-content-center">
            <ul class="pagination pagination-sm mb-0">
                @if ($products->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">
                        <i class="bi bi-chevron-left"></i>
                    </span>
                </li>
                @else
                <li class="page-item">
                    <a class="page-link" href="{{ $products->previousPageUrl() }}" rel="prev">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                </li>
                @endif

                @foreach ($products->links()->elements[0] ?? [] as $page => $url)
                @if ($page == $products->currentPage())
                <li class="page-item active">
                    <span class="page-link">{{ $page }}</span>
                </li>
                @else
                <li class="page-item">
                    <a class="page-link" href="{{ $url }}#product-section">{{ $page }}</a>
                </li>
                @endif
                @endforeach

                @if ($products->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $products->nextPageUrl() }}#product-section" rel="next">
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </li>
                @else
                <li class="page-item disabled">
                    <span class="page-link">
                        <i class="bi bi-chevron-right"></i>
                    </span>
                </li>
                @endif
            </ul>
        </nav>
    </div>
    @endif
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Smooth scroll to section
        if (window.location.hash === "#product-section") {
            const el = document.querySelector("#product-section");
            if (el) {
                setTimeout(() => {
                    el.scrollIntoView({
                        behavior: "smooth"
                    });
                }, 100);
            }
        }

        // Enhanced add to cart with loading states
        document.querySelectorAll('.add-to-cart').forEach(btn => {
            btn.addEventListener('click', function() {
                const originalContent = this.innerHTML;
                this.classList.add('btn-loading');
                this.disabled = true;

                // Reset after animation completes
                setTimeout(() => {
                    this.classList.remove('btn-loading');
                    this.disabled = false;
                    this.innerHTML = originalContent;
                }, 1500);
            });
        });
    });
</script>
@endsection