@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Chi tiết đơn hàng #{{ $order->id }}</h2>

    <div class="card mb-4">
        <div class="card-body">
            <h5>Thông tin khách hàng</h5>
            <p><strong>Họ tên:</strong> {{ $order->name }}</p>
            <p><strong>Số điện thoại:</strong> {{ $order->phone }}</p>
            <p><strong>Địa chỉ:</strong> {{ $order->address }}</p>

            {{-- Hiển thị giờ theo VN --}}
            <p><strong>Ngày đặt:</strong> {{ $order->created_at->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i') }}</p>

            <p><strong>Phương thức thanh toán:</strong> {{ strtoupper($order->payment_method ?? 'COD') }}</p>
            <p><strong>Trạng thái:</strong>
                <span class="badge 
                    @if($order->status == 'pending') bg-warning 
                    @elseif($order->status == 'processing') bg-info 
                    @elseif($order->status == 'completed') bg-success 
                    @else bg-danger @endif">
                    {{ ucfirst($order->status) }}
                </span>
            </p>
        </div>
    </div>

    <h4>Sản phẩm trong đơn hàng</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product->name ?? 'Đã xóa' }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->price, 0) }} VNĐ</td>
                <td>{{ number_format($item->price * $item->quantity, 0) }} VNĐ</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-end">
        <h4><strong>Tổng cộng: {{ number_format($order->total, 0) }} VNĐ</strong></h4>
    </div>

    {{-- Quay lại danh sách đơn hàng --}}
    @if(Auth::user()->role === 'admin')
    <a href="{{ route('admin.orders.index') }}" class="btn btn-primary mt-3">← Quay lại danh sách (Admin)</a>
    @else
    <a href="{{ route('orders.index') }}" class="btn btn-primary mt-3">← Quay lại đơn hàng của tôi</a>
    @endif
</div>
@endsection