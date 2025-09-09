@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center fw-bold">📦 Đơn hàng của tôi</h2>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle text-center mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Mã đơn</th>
                            <th scope="col">Ngày đặt</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Tổng tiền</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr class="align-middle table-hover">
                                <td class="fw-semibold">#{{ $order->id }}</td>
                                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    @switch($order->status)
                                        @case('pending')
                                            <span class="badge rounded-pill bg-warning text-dark">⏳ Chờ xử lý</span>
                                            @break
                                        @case('processing')
                                            <span class="badge rounded-pill bg-info text-dark">🔄 Đang xử lý</span>
                                            @break
                                        @case('completed')
                                            <span class="badge rounded-pill bg-success">✅ Hoàn thành</span>
                                            @break
                                        @case('cancelled')
                                            <span class="badge rounded-pill bg-danger">❌ Đã hủy</span>
                                            @break
                                        @default
                                            <span class="badge rounded-pill bg-secondary">{{ ucfirst($order->status) }}</span>
                                    @endswitch
                                </td>
                                <td class="fw-bold text-primary">{{ number_format($order->total, 0, ',', '.') }} ₫</td>
                                <td>
                                    <div class="d-flex justify-content-center flex-wrap gap-1">
                                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                            👁️ Xem
                                        </a>
                                        @if($order->status === 'pending')
                                            <form action="{{ route('orders.cancel', $order->id) }}" method="POST" style="display:inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Bạn chắc chắn muốn hủy đơn này?')">
                                                    ❌ Hủy
                                                </button>
                                            </form>
                                        @elseif($order->status === 'completed')
                                            @foreach($order->items as $item)
                                                <a href="{{ route('products.show', $item->product_id) }}" class="btn btn-sm btn-outline-success">
                                                    ⭐ Đánh giá {{ $item->product->name ?? 'Sản phẩm' }}
                                                </a>
                                            @endforeach
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-muted py-3">Bạn chưa có đơn hàng nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
