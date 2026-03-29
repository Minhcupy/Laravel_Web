@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h2 class="mb-4 fw-bold text-primary">
        <i class="bi bi-cart-check-fill me-2"></i> Giỏ hàng
    </h2>

    {{-- Hiển thị thông báo --}}
    @if(session('success'))
    <div class="alert alert-success shadow-sm rounded-pill px-4">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger shadow-sm rounded-pill px-4">
        <i class="bi bi-x-circle-fill me-2"></i> {{ session('error') }}
    </div>
    @endif

    {{-- Form thanh toán --}}
    <form id="checkoutForm" action="{{ route('checkout.index') }}" method="GET"></form>

    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-primary">
                    <tr>
                        <th>
                            <input type="checkbox" id="checkAll" form="checkoutForm">
                        </th>
                        <th class="text-start">Sản phẩm</th>
                        <th>Giá gốc</th>
                        <th>Giá sau giảm</th>
                        <th>Số lượng</th>
                        <th>Tồn kho</th>
                        <th>Tổng</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $cart = session('cart', []);
                        $total = 0;
                    @endphp

                    @forelse($cart as $id => $item)
                        @php
                            $discountPrice = $item['discounted_price'] ?? $item['price'];
                            $line = $discountPrice * $item['quantity'];
                            $total += $line;
                        @endphp
                        <tr>
                            {{-- Checkbox chọn --}}
                            <td>
                                <input type="checkbox" name="selected[]" value="{{ $id }}" class="checkItem" form="checkoutForm">
                            </td>

                            {{-- Sản phẩm --}}
                            <td class="text-start">
                                <div class="d-flex align-items-center">
                                    @if(!empty($item['image']))
                                    <img src="{{ asset('storage/' . $item['image']) }}"
                                        alt="{{ $item['name'] }}"
                                        class="rounded shadow-sm me-3"
                                        style="width:60px;height:60px;object-fit:cover;">
                                    @endif
                                    <div>
                                        <span class="fw-semibold">{{ $item['name'] }}</span>
                                        @if(!empty($item['promotion_pct']))
                                        <span class="badge bg-success ms-2">
                                            -{{ $item['promotion_pct'] }}%
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            {{-- Giá gốc --}}
                            <td class="text-muted">
                                {{ number_format($item['price'], 0, ',', '.') }} VNĐ
                            </td>

                            {{-- Giá sau giảm --}}
                            <td>
                                @if($discountPrice < $item['price'])
                                    <span class="fw-bold text-danger">
                                        {{ number_format($discountPrice, 0, ',', '.') }} VNĐ
                                    </span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>

                            {{-- Số lượng --}}
                            <td>
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex align-items-center justify-content-center gap-2">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantity"
                                        value="{{ $item['quantity'] }}"
                                        class="form-control form-control-sm text-center rounded-pill"
                                        style="max-width:70px"
                                        min="1" max="{{ $item['stock'] ?? 1 }}">
                                    <button class="btn btn-sm btn-outline-primary rounded-pill" type="submit">
                                        <i class="bi bi-arrow-repeat"></i>
                                    </button>
                                </form>
                            </td>

                            {{-- Tồn kho --}}
                            <td>{{ $item['stock'] ?? '—' }}</td>

                            {{-- Tổng tiền --}}
                            <td class="fw-bold text-success">
                                {{ number_format($line, 0, ',', '.') }} VNĐ
                            </td>

                            {{-- Hành động --}}
                            <td>
                                <form action="{{ route('cart.remove', $id) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa sản phẩm này?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger rounded-pill">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                @if(($item['status'] ?? '') === 'cancelled')
                                <form action="{{ route('cart.reorder', $id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-info rounded-pill">
                                        <i class="bi bi-arrow-counterclockwise"></i>
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                <i class="bi bi-emoji-frown me-2"></i> Giỏ hàng của bạn đang trống.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Tổng cộng + nút hành động --}}
    @if(!empty($cart))
    <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap gap-3">
        <h5 class="mb-0">
            Tổng cộng: <span class="fw-bold text-success">{{ number_format($total, 0, ',', '.') }} VNĐ</span>
        </h5>

        <div class="d-flex flex-wrap gap-2">
            {{-- Áp dụng khuyến mãi --}}
            <form action="{{ route('cart.applyPromotion') }}" method="POST">
                @csrf
                <button class="btn btn-warning rounded-pill px-4">
                    <i class="bi bi-percent me-1"></i> Áp dụng khuyến mãi
                </button>
            </form>

            {{-- Thanh toán --}}
            <button type="submit" class="btn btn-success rounded-pill px-4" form="checkoutForm">
                <i class="bi bi-credit-card me-1"></i> Thanh toán
            </button>

            {{-- Theo dõi đơn hàng --}}
            <a href="{{ route('orders.my') }}" class="btn btn-info rounded-pill px-4">
                <i class="bi bi-box-seam me-1"></i> Theo dõi đơn hàng
            </a>
        </div>
    </div>
    @endif
</div>

<script>
    // Chọn tất cả checkbox
    document.getElementById('checkAll')?.addEventListener('click', function() {
        document.querySelectorAll('.checkItem').forEach(cb => cb.checked = this.checked);
    });
</script>
@endsection
