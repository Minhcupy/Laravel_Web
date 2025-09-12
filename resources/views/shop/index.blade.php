@extends('layouts.app')

@section('content')
<style>
    /* Carousel full-bleed an toàn trên responsive */
    .carousel.slide.full-bleed {
        width: 100vw;
        position: relative;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw;
        border-radius: 0;
        z-index: 1;
        overflow: hidden;
    }
    .carousel.slide.full-bleed .carousel-item img {
        width: 100%;
        height: clamp(280px, 40vh, 520px);
        object-fit: cover;
        filter: saturate(1.05) contrast(1.02);
    }
    .carousel-caption.custom-caption {
        bottom: 18%;
        transform: translateY(10%);
    }
    .carousel-caption.custom-caption h5 {
        font-weight: 700;
        letter-spacing: .3px;
    }

.pagination {
    gap: 4px;
}

.pagination .page-link {
    padding: 4px 10px;
    font-size: 14px;
    border-radius: 6px;
}

.pagination .page-item.active .page-link {
    background-color: #0d6efd;
    border-color: #0d6efd;
    color: #fff;
}


#featured-section {
    position: relative;
    z-index: 2;
    margin-top: 5rem;         /* cách xa carousel */
    padding-top: 3rem;
    padding-bottom: 4rem;
    background: #f8f9fb;       /* nền nhạt để phân khối */
    border-top: 1px solid rgba(0,0,0,.05);
}

/* Tiêu đề nổi bật */
#featured-section h2 {
    position: relative;
    font-weight: 700;
    margin-bottom: 3rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

#featured-section h2::after {
    content: "";
    display: block;
    width: 80px;
    height: 3px;
    background: linear-gradient(90deg, #0d6efd, #6610f2);
    margin: .75rem auto 0 auto;
    border-radius: 3px;
}

    
    /* Product grid */
    /* Tạo khoảng cách rõ ràng giữa carousel và main content */
#product-section {
    position: relative;
    z-index: 2;
    margin-top: 5rem;         /* cách xa carousel */
    padding-top: 3rem;
    padding-bottom: 4rem;
    background: #f8f9fb;       /* nền nhạt để phân khối */
    border-top: 1px solid rgba(0,0,0,.05);
}

/* Tiêu đề nổi bật */
#product-section h2 {
    position: relative;
    font-weight: 700;
    margin-bottom: 3rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

#product-section h2::after {
    content: "";
    display: block;
    width: 80px;
    height: 3px;
    background: linear-gradient(90deg, #0d6efd, #6610f2);
    margin: .75rem auto 0 auto;
    border-radius: 3px;
}

    .product-card {
        transition: transform .18s ease, box-shadow .18s ease;
        border: none;
        overflow: hidden;
        border-radius: 12px;
    }
/* Bỏ hover toàn bộ card */
.product-card:hover {
    transform: none;
    box-shadow: none;
}

/* Thêm hover cho ảnh */
.product-image-wrapper:hover img {
    transform: scale(1.1); /* phóng to 10% */
}

    .product-image-wrapper {
        height: 220px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(180deg, rgba(250,250,252,1), rgba(245,247,250,1));
        border-bottom: 1px solid rgba(0,0,0,.04);
    }
    .product-image-wrapper img {
        transition: transform 0.5s ease-in-out; /* thời gian 0.5s, mượt */
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
    }

    /* Card body spacing */
    .card-body .card-title {
        font-size: 1rem;
        margin-bottom: .35rem;
    }
    .price-row {
        display: flex;
        align-items: baseline;
        gap: .5rem;
        flex-wrap: wrap;
    }
    .discount-price {
        color: #d63384; /* magenta-ish to stand out */
        font-weight: 700;
        font-size: 1.05rem;
    }
    .original-price {
        color: #6c757d;
        text-decoration: line-through;
        font-size: .9rem;
    }
    .sale-badge {
        font-weight: 700;
        font-size: .8rem;
    }

    /* Stock badge */
    .stock-badge {
        font-size: .85rem;
        padding: .35rem .6rem;
        border-radius: 999px;
    }

    

    /* Buttons */
    .btn-action {
        transition: transform .12s ease, box-shadow .12s ease;
    }
    .btn-action:active { transform: translateY(1px); }
    .btn-outline-info {
        border-radius: 8px;
    }
    .btn-outline-primary {
        border-radius: 8px;
    }

    /* Responsive tweaks */
    @media (max-width: 768px) {
        .carousel-caption.custom-caption {
            bottom: 8%;
            background: rgba(0,0,0,.45);
            padding: .5rem .6rem;
        }
        .product-image-wrapper { height: 180px; }
    }
</style>

{{-- Carousel full-bleed --}}
{{-- Carousel (Bootstrap mặc định, KHÔNG full-bleed) --}}
<div class="position-relative" style="margin-top:-24px;">
    <div id="productCarousel" class="carousel slide w-100 rounded-0 shadow" data-bs-ride="carousel" data-bs-interval="3000" aria-label="Banner sản phẩm">
        {{-- Indicators --}}
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="0" class="active" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>

        {{-- Images --}}
        <div class="carousel-inner rounded-0">
            <div class="carousel-item active">
                <img src="{{ asset('img/banner-danLuoi.jpg') }}" class="d-block w-100" alt="Banner 1" style="height: 420px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-2">
                    <h5>Chào mừng đến Laravel Shop</h5>
                    <p>Khám phá những sản phẩm hot nhất hôm nay!</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/vot-cau-long.png') }}" class="d-block w-100" alt="Banner 2" style="height: 420px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-2">
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
{{-- Main content --}}
{{-- Sản phẩm nổi bật --}}
<div class="container mt-5" id="featured-section">
    <h2 class="mb-4 text-center">✨ Sản phẩm nổi bật ✨</h2>
    <div class="row g-3">
        @forelse($featuredProducts as $product)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card product-card h-100">
                    <div class="product-image-wrapper">
                        <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/200?text=No+Image' }}" alt="{{ $product->name }}">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-truncate" title="{{ $product->name }}">{{ $product->name }}</h5>
                        <div class="mb-2 price-row">
                            @if($product->promotion)
                                <div class="discount-price">{{ number_format($product->discounted_price,0,',','.') }} VNĐ</div>
                                <div class="original-price">{{ number_format($product->price,0,',','.') }} VNĐ</div>
                                <div class="badge bg-success sale-badge ms-auto">-{{ $product->promotion->discount_percentage }}%</div>
                            @else
                                <div class="text-primary fw-bold">{{ number_format($product->price,0,',','.') }} VNĐ</div>
                            @endif
                        </div>
                        <p class="mb-3"><strong>Hàng còn:</strong>
                            @if($product->stock>0)
                                <span class="badge bg-success stock-badge">{{ $product->stock }}</span>
                            @else
                                <span class="badge bg-danger stock-badge">Hết hàng</span>
                            @endif
                        </p>
                        <div class="mt-auto d-flex gap-2">
                            <a href="{{ route('products.show',$product->id) }}" class="btn btn-outline-info flex-fill"><i class="bi bi-eye"></i> Chi tiết</a>
                            @auth
                                @if($product->stock>0)
                                    <button class="btn btn-primary flex-fill add-to-cart" data-id="{{ $product->id }}"><i class="bi bi-cart3"></i> Giỏ</button>
                                @else
                                    <button class="btn btn-secondary flex-fill" disabled><i class="bi bi-cart-x"></i> Hết</button>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline-secondary flex-fill"><i class="bi bi-cart3"></i> Giỏ</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">Chưa có sản phẩm nổi bật.</p>
        @endforelse
    </div>
</div>

{{-- Danh sách tất cả sản phẩm --}}
<div class="container mt-5" id="product-section">
    <h2 class="mb-4 text-center">📦 Tất cả sản phẩm</h2>
    <div class="row g-3">
        @foreach($products as $product)
            <div class="col-6 col-md-4 col-lg-3">
                {{-- dùng lại card sản phẩm giống bên trên --}}
                <div class="card product-card h-100">
                    <div class="product-image-wrapper">
                        <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/200?text=No+Image' }}" alt="{{ $product->name }}">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-truncate" title="{{ $product->name }}">{{ $product->name }}</h5>
                        <div class="mb-2 price-row">
                            @if($product->promotion)
                                <div class="discount-price">{{ number_format($product->discounted_price,0,',','.') }} VNĐ</div>
                                <div class="original-price">{{ number_format($product->price,0,',','.') }} VNĐ</div>
                                <div class="badge bg-success sale-badge ms-auto">-{{ $product->promotion->discount_percentage }}%</div>
                            @else
                                <div class="text-primary fw-bold">{{ number_format($product->price,0,',','.') }} VNĐ</div>
                            @endif
                        </div>
                        <p class="mb-3"><strong>Hàng còn:</strong>
                            @if($product->stock>0)
                                <span class="badge bg-success stock-badge">{{ $product->stock }}</span>
                            @else
                                <span class="badge bg-danger stock-badge">Hết hàng</span>
                            @endif
                        </p>
                        <div class="mt-auto d-flex gap-2">
                            <a href="{{ route('products.show',$product->id) }}" class="btn btn-outline-info flex-fill"><i class="bi bi-eye"></i> Chi tiết</a>
                            @auth
                                @if($product->stock>0)
                                    <button class="btn btn-primary flex-fill add-to-cart" data-id="{{ $product->id }}"><i class="bi bi-cart3"></i> Giỏ</button>
                                @else
                                    <button class="btn btn-secondary flex-fill" disabled><i class="bi bi-cart-x"></i> Hết</button>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline-secondary flex-fill"><i class="bi bi-cart3"></i> Giỏ</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Pagination --}}
   {{-- Pagination --}}
@if ($products->hasPages())
    <div class="mt-5">
        {{-- Thông tin phân trang --}}
        <div class="text-center text-muted small mb-2">
            Hiển thị 
            <strong>{{ $products->firstItem() }}</strong> - 
            <strong>{{ $products->lastItem() }}</strong> 
            trong tổng 
            <strong>{{ $products->total() }}</strong> sản phẩm
        </div>

        {{-- Nút phân trang --}}
        <nav aria-label="Pagination" class="d-flex justify-content-center">
            <ul class="pagination pagination-sm mb-0">
                {{-- Trang trước --}}
                @if ($products->onFirstPage())
                    <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $products->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                @endif

                {{-- Số trang --}}
                @foreach ($products->links()->elements[0] ?? [] as $page => $url)
                    @if ($page == $products->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach

                {{-- Trang sau --}}
                @if ($products->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $products->nextPageUrl() }}" rel="next">&raquo;</a></li>
                @else
                    <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                @endif
            </ul>
        </nav>
    </div>
@endif


    </div>
</div>

{{-- Smooth scroll to section if hash present --}}
<script>

    
document.addEventListener("DOMContentLoaded", function() {
    // Cuộn tới section nếu có hash
    if (window.location.hash === "#product-section") {
        const el = document.querySelector("#product-section");
        if (el) el.scrollIntoView({ behavior: "smooth" });
    }

    // Add to cart thẳng, không thông báo
});
</script>
@endsection