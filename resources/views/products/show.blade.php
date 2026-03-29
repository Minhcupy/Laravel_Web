@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- Nút quay lại --}}
    <div class="mb-4">
        <a class="btn btn-outline-secondary" href="{{ route('admin.products.index') }}">
            <i class="bi bi-arrow-left"></i> Quay lại danh sách
        </a>
    </div>

    {{-- Thông tin sản phẩm --}}
    <div class="card shadow-lg border-0 mb-5 rounded-4 overflow-hidden">
        <div class="row g-0">
            {{-- Ảnh --}}
            <div class="col-md-5 p-4 bg-light d-flex justify-content-center align-items-center">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                         alt="{{ $product->name }}"
                         class="img-fluid rounded-3 shadow-sm"
                         style="max-height: 420px; object-fit: cover;">
                @else
                    <img src="{{ asset('images/no-image.png') }}"
                         alt="No image"
                         class="img-fluid rounded-3 shadow-sm"
                         style="max-height: 420px; object-fit: cover;">
                @endif
            </div>

            {{-- Thông tin --}}
            <div class="col-md-7 p-5">
                <h2 class="fw-bold mb-2">{{ $product->name }}</h2>
                <p class="text-muted fs-6 mb-3">{{ $product->description ?: 'Không có mô tả' }}</p>

                {{-- Giá --}}
                <h3 class="text-danger fw-bold mb-3">
                    {{ number_format($product->price, 0, ',', '.') }} VNĐ
                </h3>

                {{-- Thương hiệu --}}
                @php
                    $brands = ['Yonex', 'Lining', 'Victor', 'Adidas', 'Apacs', 'Kawasaki'];
                    $brandName = 'Đang cập nhật';
                    foreach ($brands as $b) {
                        if (stripos($product->name, $b) !== false) {
                            $brandName = $b;
                            break;
                        }
                    }
                @endphp

                <ul class="list-unstyled mb-4">
                    <li><i class="bi bi-check-circle text-success me-2"></i><strong>Danh mục:</strong> {{ $product->category->name ?? 'N/A' }}</li>
                    <li><i class="bi bi-box text-primary me-2"></i><strong>Tồn kho:</strong> {{ $product->stock }} sản phẩm</li>
                    <li><i class="bi bi-award me-2 text-warning"></i><strong>Thương hiệu:</strong> {{ $brandName }}</li>
                    <li><i class="bi bi-geo-alt me-2 text-danger"></i><strong>Xuất xứ:</strong> {{ $product->origin ?? 'Việt Nam' }}</li>
                    <li><i class="bi bi-shield-check me-2 text-success"></i><strong>Bảo hành:</strong> {{ $product->warranty ?? 'Bảo hành 6 tháng' }}</li>
                </ul>

                {{-- Form thêm giỏ hàng --}}
                <div class="mt-4">
                    <div class="d-flex align-items-end gap-3 flex-wrap">
                        <div>
                            <label for="quantity-{{ $product->id }}" class="fw-semibold d-block mb-2">Số lượng</label>
                            <input type="number" id="quantity-{{ $product->id }}"
                                   class="form-control shadow-sm text-center quantity-input"
                                   value="1" min="1" max="{{ $product->stock }}">
                        </div>

                        <button type="button"
                                class="btn btn-success shadow-sm rounded-3 add-to-cart px-4"
                                data-id="{{ $product->id }}">
                            <i class="bi bi-cart-plus me-1"></i> Thêm vào giỏ
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Đánh giá sản phẩm --}}
    <div class="card shadow-sm border-0 p-4 rounded-4">
        <h4 class="mb-4"><i class="bi bi-star-fill text-warning"></i> Đánh giá sản phẩm</h4>

        @php
            $average = $product->reviews->avg('rating');
            $total = $product->reviews->count();
            $ratingStats = $product->reviews->groupBy('rating')->map->count();
        @endphp

        {{-- Tổng quan --}}
        @if($total > 0)
            <div class="row mb-4">
                <div class="col-md-3 text-center">
                    <h1 class="text-warning fw-bold">{{ number_format($average, 1) }}</h1>
                    <div class="mb-2">
                        @for($i=1; $i<=5; $i++)
                            <i class="bi {{ $i <= round($average) ? 'bi-star-fill text-warning' : 'bi-star text-muted' }}"></i>
                        @endfor
                    </div>
                    <small class="text-muted">{{ $total }} đánh giá</small>
                </div>
                <div class="col-md-9">
                    @for($i = 5; $i >= 1; $i--)
                        @php
                            $count = $ratingStats[$i] ?? 0;
                            $percent = $total > 0 ? round(($count / $total) * 100) : 0;
                        @endphp
                        <div class="d-flex align-items-center mb-2">
                            <span class="me-2">{{ $i }} <i class="bi bi-star-fill text-warning"></i></span>
                            <div class="progress flex-grow-1" style="height: 10px;">
                                <div class="progress-bar bg-warning" role="progressbar"
                                     style="width: {{ $percent }}%;"
                                     aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                            <span class="ms-2 text-muted small">{{ $count }} ({{ $percent }}%)</span>
                        </div>
                    @endfor
                </div>
            </div>
        @else
            <p class="text-muted">Chưa có đánh giá nào.</p>
        @endif

        {{-- Form thêm đánh giá --}}
        @auth
            <form action="{{ route('reviews.store', $product->id) }}" method="POST" class="mb-4">
                @csrf
                <div class="row g-2">
                    <div class="col-md-2">
                        <select name="rating" class="form-select">
                            @for($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}">⭐ {{ $i }} Sao</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-8">
                        <textarea name="comment" class="form-control" rows="1" placeholder="Viết đánh giá của bạn..."></textarea>
                    </div>
                    <div class="col-md-2 d-grid">
                        <button class="btn btn-primary"><i class="bi bi-send"></i> Gửi</button>
                    </div>
                </div>
            </form>
        @else
            <p><a href="{{ route('login') }}">Đăng nhập</a> để viết đánh giá.</p>
        @endauth

        {{-- Danh sách đánh giá --}}
        <div>
            @foreach($product->reviews as $review)
                <div class="border rounded-3 p-3 mb-3 bg-light">
                    <div class="d-flex align-items-center mb-2">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($review->user->name) }}&background=random"
                             class="rounded-circle me-2" width="40" height="40" alt="avatar">
                        <div>
                            <strong>{{ $review->user->name }}</strong>
                            <div>
                                @for($i=1; $i<=5; $i++)
                                    <i class="bi {{ $i <= $review->rating ? 'bi-star-fill text-warning' : 'bi-star text-muted' }}"></i>
                                @endfor
                            </div>
                        </div>
                        <span class="ms-auto text-muted small">{{ $review->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="mb-2">{{ $review->comment }}</p>

                    @auth
                        @if(Auth::id() === $review->user_id || Auth::user()->role === 'admin')
                            <div class="mt-2">
                                <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-sm btn-outline-primary me-1">
                                    <i class="bi bi-pencil"></i> Sửa
                                </a>
                                <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Bạn chắc chắn muốn xóa đánh giá này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i> Xóa
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
            @endforeach
        </div>
    </div>
</div>

{{-- CSS --}}
<style>
.quantity-input {
    max-width: 100px;
    border: 2px solid #28a745;
    border-radius: 8px;
    font-weight: 600;
}
.quantity-input:focus {
    border-color: #218838;
    box-shadow: 0 0 6px rgba(40, 167, 69, 0.3);
    outline: none;
}
.add-to-cart {
    transition: all 0.2s ease;
}
.add-to-cart:hover {
    transform: translateY(-2px);
    background: #218838;
}
</style>
@endsection
