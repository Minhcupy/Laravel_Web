@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- ✅ Thông báo đặt hàng thành công --}}
    <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3 mb-4" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        <strong>Đặt hàng thành công!</strong> Cảm ơn bạn đã mua sắm tại <span class="fw-bold text-primary">Shop.vn</span>.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    {{-- Tiêu đề --}}
    <div class="mb-4 text-center">
        <h2 class="fw-bold text-primary">
            <i class="bi bi-receipt-cutoff me-2"></i> Hóa đơn thanh toán
        </h2>
        <p class="text-muted">Chi tiết đơn hàng của bạn</p>
    </div>

    {{-- Thông tin khách hàng --}}
    <div class="card shadow-lg border-0 rounded-4 mb-4 p-4">
        <h5 class="fw-bold text-secondary mb-3">
            <i class="bi bi-person-lines-fill me-2"></i> Thông tin khách hàng
        </h5>
        <ul class="list-unstyled mb-0">
            <li class="mb-2"><strong>Tên khách hàng:</strong> {{ $order->name }}</li>
            <li class="mb-2"><strong>SĐT:</strong> {{ $order->phone }}</li>
            <li class="mb-2"><strong>Địa chỉ:</strong> {{ $order->address }}</li>
            <li class="mb-2">
                <strong>Tổng tiền:</strong>
                <span class="fw-bold text-danger">{{ number_format($order->total, 0, ',', '.') }} VNĐ</span>
            </li>
            <li class="mb-2">
                <strong>Trạng thái:</strong>
                <span class="badge 
                    @if($order->status === 'pending') bg-warning text-dark
                    @elseif($order->status === 'completed') bg-success
                    @elseif($order->status === 'cancelled') bg-danger
                    @else bg-secondary @endif
                ">
                    {{ ucfirst($order->status) }}
                </span>
            </li>
        </ul>
    </div>

    {{-- Chi tiết sản phẩm --}}
    <div class="card shadow-lg border-0 rounded-4 p-4 mb-4">
        <h5 class="fw-bold text-secondary mb-3">
            <i class="bi bi-bag-check-fill me-2"></i> Chi tiết sản phẩm
        </h5>
        <div class="table-responsive">
            <table class="table table-hover align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Size</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr>
                            <td class="text-start">
                                <div class="d-flex align-items-center">
                                    @if($item->product && $item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}"
                                            alt="{{ $item->product->name }}"
                                            class="rounded shadow-sm me-2"
                                            style="width:50px;height:50px;object-fit:cover;">
                                    @endif
                                    <span>{{ $item->product->name ?? 'Sản phẩm đã xóa' }}</span>
                                </div>
                            </td>
                            <td>{{ $item->size ?? '—' }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->price, 0, ',', '.') }} VNĐ</td>
                            <td class="fw-bold text-success">
                                {{ number_format($item->price * $item->quantity, 0, ',', '.') }} VNĐ
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <th colspan="4" class="text-end">Tổng cộng:</th>
                        <th class="text-danger fs-5">{{ number_format($order->total, 0, ',', '.') }} VNĐ</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    {{-- Nút tiếp tục --}}
    <div class="text-center">
        <a href="{{ route('shop.index') }}" class="btn btn-lg btn-primary rounded-pill px-5 shadow">
            <i class="bi bi-cart-plus me-2"></i> Tiếp tục mua hàng
        </a>
    </div>
</div>
@endsection
