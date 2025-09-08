@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Thanh toán</h2>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Họ và tên</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Số điện thoại</label>
            <input type="text" name="phone" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Địa chỉ</label>
            <textarea name="address" class="form-control" required></textarea>
        </div>

        <h4>Thông tin đơn hàng</h4>
        <ul>
            @foreach($cart as $item)
                <li>{{ $item['name'] }} - SL: {{ $item['quantity'] }} - {{ number_format($item['price'], 0) }} VNĐ</li>
            @endforeach
        </ul>
        <p>
            <strong>Tổng cộng:</strong> 
            {{ number_format(array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)), 0) }} VNĐ
        </p>

        <div class="mb-3">
            <label>Chọn phương thức thanh toán</label>
            <select name="payment_method" class="form-control" required>
                <option value="cod">Thanh toán khi nhận hàng (COD)</option>
                <option value="vnpay">Thanh toán qua VNPAY</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Xác nhận đặt hàng</button>
    </form>
</div>
@endsection
