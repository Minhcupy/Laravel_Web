@extends('layouts.app')

@section('content')
<style>
    .carousel.slide {
        width: 100vw !important;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw;
        position: relative;
        border-radius: 0;
        z-index: 1;
    }

    .carousel-item img {
        width: 100%;
        height: 500px;
        object-fit: cover;
    }

    .product-card {
        border-radius: 15px;
        border: none;
        transition: all 0.3s ease;
        background: white;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(30,136,229,0.15);
    }

    .btn-buy-now {
        background: linear-gradient(135deg, #f44336, #e53935);
        border: none;
        border-radius: 25px;
        transition: all 0.3s ease;
    }

    .btn-buy-now:hover {
        background: linear-gradient(135deg, #d32f2f, #c62828);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(244, 67, 54, 0.3);
    }

    .btn-cart {
        background: linear-gradient(135deg, #1e88e5, #42a5f5);
        border: none;
        border-radius: 25px;
        transition: all 0.3s ease;
    }

    .btn-cart:hover {
        background: linear-gradient(135deg, #1565c0, #1976d2);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(30, 136, 229, 0.3);
    }
</style>

{{-- Carousel banner toàn màn hình --}}
<div class="position-relative" style="margin-top:-24px;">
    <div id="productCarousel" class="carousel slide w-100 rounded-0 shadow" data-bs-ride="carousel" data-bs-interval="4000" style="max-width:100vw;">
        {{-- Indicators --}}
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="2"></button>
        </div>
        {{-- Images --}}
        <div class="carousel-inner rounded-0">
            <div class="carousel-item active">
                <img src="{{ asset('img/badminton1.jpg') }}"
                    class="d-block w-100"
                    alt="Vợt cầu lông chuyên nghiệp"
                    style="object-fit: cover; height: 500px;">
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                    <h2>🏸 VỢT CẦU LÔNG CHUYÊN NGHIỆP</h2>
                    <p class="fs-5">Khám phá bộ sưu tập vợt cầu lông từ các thương hiệu hàng đầu thế giới!</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/badminton2.jpg') }}"
                    class="d-block w-100"
                    alt="Khuyến mãi đặc biệt"
                    style="object-fit: cover; height: 500px;">
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                    <h2>🎯 KHUYẾN MÃI ĐẶC BIỆT</h2>
                    <p class="fs-5">Giảm giá lên tới 50% cho các sản phẩm vợt cao cấp!</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/badminton3.jpg') }}"
                    class="d-block w-100"
                    alt="Sản phẩm mới về"
                    style="object-fit: cover; height: 500px;">
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                    <h2>⭐ SẢN PHẨM MỚI VỀ</h2>
                    <p class="fs-5">Cập nhật ngay những mẫu vợt mới nhất từ Yonex, Victor, Mizuno.</p>
                </div>
            </div>
        </div>
        {{-- Controls --}}
        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
</div>

{{-- Nội dung chính --}}
<div class="container mt-5">
    {{-- Tiêu đề --}}
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold text-primary">🏸 VỢT CẦU LÔNG CHUYÊN NGHIỆP 🏸</h1>
        <p class="lead text-muted">Chọn ngay vợt cầu lông phù hợp với phong cách chơi của bạn</p>
    </div>
                    <h5>Khuyến mãi đặc biệt</h5>
                    <p>Giảm giá lên tới 50% cho nhiều sản phẩm!</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/banner3.jpg') }}"
                    class="d-block w-100"
                    alt="Banner 1"
                    style="object-fit: cover; height: 500px;">
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-2">
                    <h5>Sản phẩm mới về</h5>
                    <p>Đặt hàng ngay hôm nay để nhận ưu đãi sớm nhất.</p>
                </div>
            </div>
        </div>
        {{-- Controls --}}
        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
</div> -->

{{-- Nội dung chính --}}
<div class="container mt-5">
    {{-- Danh sách sản phẩm --}}
    <div class="row g-4">
        @foreach($products as $product)
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card product-card h-100">

                {{-- Ảnh sản phẩm --}}
                <div class="d-flex align-items-center justify-content-center bg-light position-relative" style="height: 250px;">
                    @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}"
                        class="img-fluid rounded"
                        style="max-height: 100%; max-width: 100%; object-fit: contain;">
                    @else
                    <img src="https://via.placeholder.com/200x200/1e88e5/ffffff?text=🏸"
                        alt="Vợt cầu lông"
                        class="img-fluid rounded"
                        style="max-height: 100%; max-width: 100%; object-fit: contain;">
                    @endif
                    
                    {{-- Badge khuyến mãi --}}
                    @if($product->promotion)
                    <span class="position-absolute top-0 start-0 badge bg-danger m-2 fs-6">
                        -{{ $product->promotion->discount_percentage }}%
                    </span>
                    @endif
                </div>

                {{-- Nội dung sản phẩm --}}
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-truncate fw-bold">{{ $product->name }}</h5>
                    <p class="card-text text-muted small">{{ Str::limit($product->description, 50) }}</p>

                    {{-- Giá + Khuyến mãi --}}
                    <div class="mb-3">
                        @if($product->promotion)
                        <div class="d-flex align-items-center gap-2">
                            <span class="fs-4 fw-bold text-danger">
                                {{ number_format($product->discounted_price, 0, ',', '.') }}đ
                            </span>
                            <small class="text-muted text-decoration-line-through">
                                {{ number_format($product->price, 0, ',', '.') }}đ
                            </small>
                        </div>
                        @else
                        <span class="fs-4 fw-bold text-primary">
                            {{ number_format($product->price, 0, ',', '.') }}đ
                        </span>
                        @endif
                    </div>

                    {{-- Tồn kho --}}
                    <p class="mb-3">
                        <strong>Còn lại:</strong>
                        @if($product->stock > 0)
                        <span class="badge bg-success">{{ $product->stock }} cái</span>
                        @else
                        <span class="badge bg-danger">Hết hàng</span>
                        @endif
                    </p>

                    {{-- Nút thao tác --}}
                    <div class="mt-auto">
                        <a href="{{ route('products.show', $product->id) }}"
                            class="btn btn-outline-primary w-100 mb-2">
                            📋 Chi tiết
                        </a>

                        @auth
                        @if($product->stock > 0)
                        <div class="row g-2">
                            <div class="col-6">
                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-cart w-100 text-white">
                                        🛒
                                    </button>
                                </form>
                            </div>
                            <div class="col-6">
                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-buy-now w-100 text-white">
                                        ⚡ Mua luôn
                                    </button>
                                </form>
                            </div>
                        </div>
                        @else
                        <button class="btn btn-secondary w-100" disabled>Hết hàng</button>
                        @endif
                        @else
                        <a href="{{ route('login') }}" class="btn btn-secondary w-100">
                            Đăng nhập để mua
                        </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Phân trang --}}
    <div class="d-flex justify-content-center mt-5">
        {{ $products->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection