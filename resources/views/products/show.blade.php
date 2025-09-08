@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- Nút quay lại --}}
    <div class="mb-4">
        <a class="btn btn-outline-primary" href="{{ route('shop.index') }}">
            <i class="bi bi-arrow-left"></i> Quay lại cửa hàng
        </a>
    </div>

    {{-- Thông tin sản phẩm --}}
    <div class="card shadow-lg border-0 mb-4 rounded-4 overflow-hidden">
        <div class="row g-0">
            {{-- Ảnh --}}
            <div class="col-md-5 p-4 bg-light d-flex justify-content-center align-items-center">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}"
                        class="img-fluid rounded-3 shadow-sm"
                        style="max-height: 400px; object-fit: contain;">
                @else
                    <img src="https://via.placeholder.com/400x400/1e88e5/ffffff?text=🏸"
                        alt="Vợt cầu lông"
                        class="img-fluid rounded-3 shadow-sm"
                        style="max-height: 400px; object-fit: contain;">
                @endif
            </div>

            {{-- Thông tin --}}
            <div class="col-md-7 p-4">
                <h1 class="fw-bold text-primary mb-3">🏸 {{ $product->name }}</h1>
                <p class="text-muted fs-6 mb-4">{{ $product->description ?: 'Vợt cầu lông chuyên nghiệp, chất lượng cao' }}</p>

                {{-- Giá --}}
                <div class="mb-4">
                    @if($product->promotion)
                    <div class="d-flex align-items-center gap-3">
                        <h2 class="text-danger fw-bold mb-0">
                            {{ number_format($product->discounted_price, 0, ',', '.') }}đ
                        </h2>
                        <span class="text-muted text-decoration-line-through fs-5">
                            {{ number_format($product->price, 0, ',', '.') }}đ
                        </span>
                        <span class="badge bg-danger fs-6">
                            -{{ $product->promotion->discount_percentage }}%
                        </span>
                    </div>
                    @else
                    <h2 class="text-primary fw-bold">
                        {{ number_format($product->price, 0, ',', '.') }}đ
                    </h2>
                    @endif
                </div>

                {{-- Thông tin chi tiết --}}
                <div class="row mb-4">
                    <div class="col-6">
                        <p class="mb-2"><strong>Tồn kho:</strong> 
                            @if($product->stock > 0)
                            <span class="badge bg-success">{{ $product->stock }} cái</span>
                            @else
                            <span class="badge bg-danger">Hết hàng</span>
                            @endif
                        </p>
                    </div>
                    <div class="col-6">
                        <p class="mb-2"><strong>Danh mục:</strong> 
                            <span class="badge bg-primary">{{ $product->category->name ?? 'N/A' }}</span>
                        </p>
                    </div>
                </div>

                {{-- Nút mua hàng --}}
                @auth
                @if($product->stock > 0)
                <div class="row g-2">
                    <div class="col-6">
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-primary w-100 btn-lg">
                                🛒 Thêm vào giỏ
                            </button>
                        </form>
                    </div>
                    <div class="col-6">
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-danger w-100 btn-lg">
                                ⚡ Mua ngay
                            </button>
                        </form>
                    </div>
                </div>
                @else
                <button class="btn btn-secondary w-100 btn-lg" disabled>Hết hàng</button>
                @endif
                @else
                <a href="{{ route('login') }}" class="btn btn-primary w-100 btn-lg">
                    Đăng nhập để mua hàng
                </a>
                @endauth
            </div>
        </div>
    </div>

    {{-- Đánh giá sản phẩm (Gọn) --}}
    <div class="card shadow-sm border-0 p-4 rounded-4">
        <h4 class="mb-3"><i class="bi bi-star-fill text-warning"></i> Đánh giá ({{ $total ?? 0 }})</h4>

        @if(($total ?? 0) > 0)
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="d-flex align-items-center">
                <span class="fs-3 fw-bold text-warning me-2">{{ number_format($average ?? 0, 1) }}</span>
                @for($i=1; $i<=5; $i++)
                    <i class="bi {{ $i <= round($average ?? 0) ? 'bi-star-fill text-warning' : 'bi-star text-muted' }}"></i>
                @endfor
            </div>
            <span class="text-muted">({{ $total }} đánh giá)</span>
        </div>
        @endif

        {{-- Form đánh giá nhanh --}}
        @auth
        <form action="{{ route('reviews.store', $product->id) }}" method="POST" class="row g-2 mb-4">
            @csrf
            <div class="col-md-2">
                <select name="rating" class="form-select" required>
                    <option value="">Chọn sao</option>
                    @for($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}">{{ $i }} ⭐</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-8">
                <input type="text" name="comment" class="form-control" placeholder="Viết đánh giá ngắn gọn..." required>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Gửi</button>
            </div>
        </form>
        @else
        <p class="text-muted mb-4">
            <a href="{{ route('login') }}" class="text-decoration-none">Đăng nhập</a> để đánh giá sản phẩm
        </p>
        @endauth

        {{-- Danh sách đánh giá ngắn gọn --}}
        @if(isset($product->reviews) && $product->reviews->count() > 0)
        <div class="review-list" style="max-height: 300px; overflow-y: auto;">
            @foreach($product->reviews->take(5) as $review)
            <div class="border-bottom pb-2 mb-2">
                <div class="d-flex justify-content-between align-items-center">
                    <strong>{{ $review->user->name ?? 'Khách hàng' }}</strong>
                    <div class="d-flex align-items-center gap-2">
                        @for($i=1; $i<=5; $i++)
                            <i class="bi {{ $i <= $review->rating ? 'bi-star-fill text-warning' : 'bi-star text-muted' }}" style="font-size: 12px;"></i>
                        @endfor
                        <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                    </div>
                </div>
                <p class="text-muted small mb-0">{{ $review->comment }}</p>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-muted">Chưa có đánh giá nào. Hãy là người đầu tiên đánh giá!</p>
        @endif
    </div>
</div>
@endsection
