@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h2 class="fw-bold text-primary mb-4">
        <i class="bi bi-credit-card-fill me-2"></i> Thanh toán
    </h2>

    <form action="{{ route('checkout.store') }}" method="POST" class="card shadow-lg border-0 rounded-4 p-4">
        @csrf

        {{-- Thông tin khách hàng --}}
        <h4 class="mb-3 text-secondary">
            <i class="bi bi-person-lines-fill me-2"></i> Thông tin khách hàng
        </h4>
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Họ và tên</label>
                <input type="text" name="name" class="form-control rounded-3 shadow-sm" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Số điện thoại</label>
                <input type="text" name="phone" class="form-control rounded-3 shadow-sm" required>
            </div>
            <div class="col-12">
                <label class="form-label fw-semibold">Địa chỉ</label>
                <textarea name="address" class="form-control rounded-3 shadow-sm" rows="2" required></textarea>
            </div>
        </div>

        {{-- Thông tin đơn hàng --}}
        <h4 class="mb-3 text-secondary">
            <i class="bi bi-bag-check-fill me-2"></i> Thông tin đơn hàng
        </h4>
        <div class="table-responsive mb-4">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Tạm tính</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($cart as $item)
                    @php
                    $unitPrice = $item['discounted_price'] ?? $item['price']; // Ưu tiên giá sau giảm
                    $line = $unitPrice * $item['quantity'];
                    $total += $line;
                    @endphp
                    <tr>
                        <td class="text-start">
                            <div class="d-flex align-items-center">
                                @if(!empty($item['image']))
                                <img src="{{ asset('storage/' . $item['image']) }}"
                                    alt="{{ $item['name'] }}"
                                    class="rounded shadow-sm me-2"
                                    style="width:50px;height:50px;object-fit:cover;">
                                @endif
                                <span class="fw-semibold">{{ $item['name'] }}</span>
                            </div>
                        </td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>
                            @if(isset($item['discounted_price']) && $item['discounted_price'] < $item['price'])
                                <span class="text-danger fw-bold">{{ number_format($item['discounted_price'], 0, ',', '.') }} VNĐ</span>
                                <br>
                                <small class="text-muted text-decoration-line-through">
                                    {{ number_format($item['price'], 0, ',', '.') }} VNĐ
                                </small>
                                @else
                                {{ number_format($item['price'], 0, ',', '.') }} VNĐ
                                @endif
                        </td>
                        <td class="fw-bold text-success">{{ number_format($line, 0, ',', '.') }} VNĐ</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-end">Tổng cộng:</th>
                        <th class="text-danger fs-5">{{ number_format($total, 0, ',', '.') }} VNĐ</th>
                    </tr>
                </tfoot>
            </table>
        </div>

        {{-- Phương thức thanh toán --}}
        <h4 class="mb-3 text-secondary">
            <i class="bi bi-wallet2 me-2"></i> Phương thức thanh toán
        </h4>
        <div class="mb-4">
            <select name="payment_method" class="form-select rounded-3 shadow-sm" required>
                <option value="cod">Thanh toán khi nhận hàng (COD)</option>
                <option value="vnpay">Thanh toán qua VNPAY</option>
            </select>
        </div>

        {{-- Nút xác nhận --}}
        <div class="text-end">
            <button type="submit" class="btn btn-success btn-lg rounded-pill px-5 shadow">
                <i class="bi bi-check-circle-fill me-2"></i> Xác nhận đặt hàng
            </button>
        </div>
    </form>
</div>
@endsection