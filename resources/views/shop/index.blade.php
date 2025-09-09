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
        /* Cắt ảnh cho vừa khung mà không bị méo */
    }
</style>
{{-- Carousel banner toàn màn hình, sát nav --}}
<!-- <div class="position-relative" style="margin-top:-24px;">
    <div id="productCarousel" class="carousel slide w-100 rounded-0 shadow" data-bs-ride="carousel" data-bs-interval="3000" style="max-width:100vw;">
        {{-- Indicators --}}
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="2"></button>
        </div>
        {{-- Images --}}
        <div class="carousel-inner rounded-0">
            <div class="carousel-item active">
                <img src="{{ asset('img/banner4.jpg') }}"
                    class="d-block w-100"
                    alt="Banner 1"
                    style="object-fit: cover; height: 500px;">
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-2">
                    <h5>Chào mừng đến Laravel Shop</h5>
                    <p>Khám phá những sản phẩm hot nhất hôm nay!</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/banner2.jpg') }}"
                    class="d-block w-100"
                    alt="Banner 1"
                    style="object-fit: cover; height: 500px;">

                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-2">
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
    <h2 class="mb-4 text-center">✨ Sản phẩm nổi bật ✨</h2>
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4 col-lg-3 mb-4">
            <div class="card h-100 shadow-sm border-0 rounded-3 hover-shadow">

                {{-- Ảnh sản phẩm --}}
                <div class="d-flex align-items-center justify-content-center bg-light" style="height: 220px;">
                    @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}"
                        class="img-fluid rounded"
                        style="max-height: 100%; max-width: 100%; object-fit: contain;">
                    @else
                    <img src="https://via.placeholder.com/200"
                        alt="No image"
                        class="img-fluid rounded"
                        style="max-height: 100%; max-width: 100%; object-fit: contain;">
                    @endif
                </div>

                {{-- Nội dung sản phẩm --}}
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-truncate">{{ $product->name }}</h5>
                    <p class="card-text text-muted small">{{ Str::limit($product->description, 60) }}</p>

                    {{-- Giá + Khuyến mãi --}}
                    <p class="card-text fw-bold fs-5">
                        @if($product->promotion)
                        <span class="text-danger">
                            {{ number_format($product->discounted_price, 0, ',', '.') }} VNĐ
                        </span>
                        <small class="text-muted text-decoration-line-through ms-1">
                            {{ number_format($product->price, 0, ',', '.') }} VNĐ
                        </small>
                        <span class="badge bg-success ms-1">
                            -{{ $product->promotion->discount_percentage }}%
                        </span>
                        @else
                        <span class="text-primary">
                            {{ number_format($product->price, 0, ',', '.') }} VNĐ
                        </span>
                        @endif
                    </p>

                    {{-- Tồn kho --}}
                    <p class="mb-2">
                        <strong>Hàng còn:</strong>
                        @if($product->stock > 0)
                        <span class="badge bg-success">{{ $product->stock }}</span>
                        @else
                        <span class="badge bg-danger">Hết hàng</span>
                        @endif
                    </p>

                    {{-- Nút thao tác --}}
                    <div class="mt-auto">
                        <div class="d-flex gap-2">

                            {{-- Nút xem chi tiết --}}
                            <a href="{{ route('products.show', $product->id) }}"
                                class="btn btn-outline-info flex-fill">
                                <i class="bi bi-eye"></i> <span class="d-none d-md-inline">Chi tiết</span>
                            </a>

                            {{-- Nút thêm vào giỏ --}}
                            @auth
                            @if($product->stock > 0)
                            <button class="btn btn-outline-primary flex-fill d-flex align-items-center justify-content-center add-to-cart"
                                data-id="{{ $product->id }}">
                                <i class="bi bi-cart3"></i>
                                <span class="ms-1 d-none d-md-inline">Giỏ hàng</span>
                            </button>
                            @else
                            <button class="btn btn-secondary flex-fill" disabled>
                                <i class="bi bi-cart-x"></i> Hết hàng
                            </button>
                            @endif
                            @else
                            <a href="{{ route('login') }}" class="btn btn-outline-secondary flex-fill">
                                <i class="bi bi-cart3"></i> <span class="d-none d-md-inline">Giỏ hàng</span>
                            </a>
                            @endauth

                            {{-- Nút mua ngay --}}
                            @auth
                            @if($product->stock > 0)
                            <button class="btn btn-primary flex-fill buy-now"
                                data-id="{{ $product->id }}">
                                Mua ngay
                            </button>
                            @else
                            <button class="btn btn-secondary flex-fill" disabled>Mua ngay</button>
                            @endif
                            @else
                            <a href="{{ route('login') }}" class="btn btn-primary flex-fill">
                                Mua ngay
                            </a>
                            @endauth
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>

</div>
@endsection