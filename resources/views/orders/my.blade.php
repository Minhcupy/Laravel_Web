@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">📦 Đơn hàng của tôi</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-primary">
                    <tr>
                        <th>Mã đơn</th>
                        <th>Ngày đặt</th>
                        <th>Trạng thái</th>
                        <th>Tổng tiền (VNĐ)</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                @switch($order->status)
                                    @case('pending')
                                        <span class="badge bg-warning text-dark">⏳ Chờ xử lý</span>
                                        @break
                                    @case('processing')
                                        <span class="badge bg-info text-dark">🔄 Đang xử lý</span>
                                        @break
                                    @case('completed')
                                        <span class="badge bg-success">✅ Hoàn thành</span>
                                        @break
                                    @case('cancelled')
                                        <span class="badge bg-danger">❌ Đã hủy</span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                                @endswitch
                            </td>
                            <td>{{ number_format($order->total, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-primary">
                                    👁️ Xem
                                </a>
                                @if($order->status === 'pending')
                                    <form action="{{ route('orders.cancel', $order->id) }}" method="POST" style="display:inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn chắc chắn muốn hủy đơn này?')">
                                            ❌ Hủy
                                        </button>
                                    </form>
                                @elseif($order->status === 'completed')
                                    @foreach($order->items as $item)
                                        <a href="{{ route('products.show', $item->product_id) }}" class="btn btn-sm btn-success ms-1 mb-1">
                                            ⭐ Đánh giá {{ $item->product->name ?? 'Sản phẩm' }}
                                        </a>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-muted">Bạn chưa có đơn hàng nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
