@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Kết quả thanh toán</h2>

    @if($vnp_ResponseCode == "00")
        <div class="alert alert-success">
            Thanh toán thành công! Mã đơn hàng: {{ $orderId }}
        </div>
        <a href="{{ route('admin.products.index') }}" class="btn btn-success">Tiếp tục mua hàng</a>
    @else
        <div class="alert alert-danger">
            Thanh toán thất bại. Mã lỗi: {{ $vnp_ResponseCode }}
        </div>
        <a href="{{ route('checkout.index') }}" class="btn btn-warning">Thử lại</a>
    @endif
</div>
@endsection
