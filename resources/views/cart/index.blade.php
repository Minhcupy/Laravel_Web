@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Giỏ hàng</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Form thanh toán --}}
    <form id="checkoutForm" action="{{ route('checkout.index') }}" method="GET"></form>

    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th><input type="checkbox" id="checkAll" form="checkoutForm"></th>
                    <th>Sản phẩm</th>
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
                // Nếu có giảm giá thì tính lại
                $discountPrice = $item['discounted_price'] ?? $item['price'];
                $line = $discountPrice * $item['quantity'];
                $total += $line;
                @endphp
                <tr>
                    <td>
                        <input type="checkbox" name="selected[]" value="{{ $id }}" class="checkItem" form="checkoutForm">
                    </td>
                    <td class="text-start">
                        {{ $item['name'] }}
                        @if(!empty($item['promotion_pct']))
                        <span class="badge bg-success ms-1">Đang giảm {{ $item['promotion_pct'] }}%</span>
                        @endif
                        @if(!empty($item['image']))
                        <br>
                        <img src="{{ asset('storage/' . $item['image']) }}"
                            alt="{{ $item['name'] }}"
                            style="width:60px;height:60px;object-fit:cover;">
                        @endif
                    </td>
                    <td>{{ number_format($item['price'], 0, ',', '.') }} VNĐ</td>
                    <td>
                        @if($discountPrice < $item['price'])
                            <strong class="text-danger">{{ number_format($discountPrice, 0, ',', '.') }} VNĐ</strong>
                            @else
                            <span class="text-muted">—</span>
                            @endif
                    </td>
                    <td>
                        <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex justify-content-center">
                            @csrf
                            @method('PUT')
                            <input type="number" name="quantity"
                                value="{{ $item['quantity'] }}"
                                class="form-control form-control-sm me-2"
                                style="max-width:80px" min="1" max="{{ $item['stock'] ?? 1 }}">
                            <button class="btn btn-sm btn-primary" type="submit">Cập nhật</button>
                        </form>
                    </td>
                    <td>{{ $item['stock'] ?? '—' }}</td>
                    <td>{{ number_format($line, 0, ',', '.') }} VNĐ</td>

                    {{-- Hành động --}}
                    <td>
                        <div class="d-flex flex-column gap-1">
                            {{-- Xóa --}}
                            <form action="{{ route('cart.remove', $id) }}" method="POST" onsubmit="return confirm('Xóa sản phẩm này?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger w-100">Xóa</button>
                            </form>

                            {{-- Đặt lại nếu cần --}}
                            @if(($item['status'] ?? '') === 'cancelled')
                            <form action="{{ route('cart.reorder', $id) }}" method="POST">
                                @csrf
                                <button class="btn btn-sm btn-info w-100">Đặt lại</button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-muted">Giỏ hàng của bạn đang trống.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(!empty($cart))
    <div class="d-flex justify-content-between mt-3">
        <h5>Tổng cộng: <span class="text-success">{{ number_format($total, 0, ',', '.') }} VNĐ</span></h5>

        <div class="d-flex gap-2">
            {{-- Áp dụng khuyến mãi cho toàn giỏ --}}
            <form action="{{ route('cart.applyPromotion') }}" method="POST">
                @csrf
                <button class="btn btn-warning">Áp dụng khuyến mãi</button>
            </form>

            {{-- Thanh toán --}}
            <button type="submit" class="btn btn-success" form="checkoutForm">Thanh toán sản phẩm đã chọn</button>
            {{-- Nút theo dõi đơn hàng --}}
            <a href="{{ route('orders.my') }}" class="btn btn-info">Theo dõi đơn hàng</a>
        </div>
    </div>
    @endif
</div>

<script>
    // Chọn tất cả
    document.getElementById('checkAll')?.addEventListener('click', function() {
        document.querySelectorAll('.checkItem').forEach(cb => cb.checked = this.checked);
    });
</script>
@endsection