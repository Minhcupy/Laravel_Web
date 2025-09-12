@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Hóa đơn thanh toán</h2>
    <p><strong>Tên khách hàng:</strong> {{ $order->name }}</p>
    <p><strong>SĐT:</strong> {{ $order->phone }}</p>
    <p><strong>Địa chỉ:</strong> {{ $order->address }}</p>
    <p><strong>Tổng tiền:</strong> {{ number_format($order->total, 0, ',', '.') }} VNĐ</p>
    <p><strong>Trạng thái:</strong> {{ ucfirst($order->status) }}</p>

    <h4>Chi tiết sản phẩm:</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Size</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->product->name ?? 'Sản phẩm đã xóa' }}</td>
                    <td>{{ $item->size ?? '—' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price, 0, ',', '.') }} VNĐ</td>
                    <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }} VNĐ</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('shop.index') }}" class="btn btn-primary">Tiếp tục mua hàng</a>
</div>
@endsection
