@extends('layouts.app')

@section('content')
<div class="container py-4">
    {{-- Tiêu đề --}}
    <div class="mb-4 text-center">
        <h2 class="fw-bold text-primary">
            <i class="bi bi-box-seam me-2"></i> Đơn hàng của tôi
        </h2>
        <p class="text-muted">Danh sách các đơn hàng bạn đã đặt</p>
    </div>

    <div class="row g-4">
        @forelse($orders as $order)
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4">
                    
                    {{-- Header đơn hàng --}}
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                        <div>
                            <span class="fw-bold">#{{ $order->id }}</span>
                            <small class="text-muted ms-2"><i class="bi bi-calendar-event"></i> {{ $order->created_at->format('d/m/Y H:i') }}</small>
                        </div>
                        <div>
                            @switch($order->status)
                                @case('pending')
                                    <span class="badge rounded-pill bg-warning text-dark px-3 py-2">⏳ Chờ xử lý</span>
                                    @break
                                @case('processing')
                                    <span class="badge rounded-pill bg-info text-dark px-3 py-2">🔄 Đang xử lý</span>
                                    @break
                                @case('completed')
                                    <span class="badge rounded-pill bg-success px-3 py-2">✅ Hoàn thành</span>
                                    @break
                                @case('cancelled')
                                    <span class="badge rounded-pill bg-danger px-3 py-2">❌ Đã hủy</span>
                                    @break
                                @default
                                    <span class="badge rounded-pill bg-secondary px-3 py-2">{{ ucfirst($order->status) }}</span>
                            @endswitch
                        </div>
                    </div>

                    {{-- Sản phẩm trong đơn --}}
                    <div class="row g-3 mb-3">
                        @foreach($order->items as $item)
                        <div class="col-md-6 d-flex align-items-center border-bottom pb-2">
                            <div class="me-3">
                                @if($item->product && $item->product->image)
                                    <img src="{{ asset('storage/' . $item->product->image) }}" class="rounded shadow-sm" alt="{{ $item->product->name }}">
                                @else
                                    <img src="https://via.placeholder.com/60?text=No+Image" class="rounded shadow-sm" alt="No image">
                                @endif
                            </div>
                            <div class="flex-grow-1">
                                <div class="fw-semibold">{{ $item->product->name ?? 'Sản phẩm' }}</div>
                                <small class="text-muted">Số lượng: {{ $item->quantity }}</small>
                            </div>
                            <div class="fw-bold text-primary">
                                {{ number_format($item->price * $item->quantity, 0, ',', '.') }} ₫
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- Footer đơn hàng --}}
                    <div class="d-flex justify-content-between align-items-center flex-wrap mt-3 pt-2 border-top">
                        <div class="fw-bold fs-6">
                            Tổng tiền: <span class="text-danger">{{ number_format($order->total, 0, ',', '.') }} ₫</span>
                        </div>
                        <div class="d-flex flex-wrap gap-2 mt-2 mt-md-0">
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                👁️ Xem chi tiết
                            </a>

                            @if($order->status === 'pending')
                                <form action="{{ route('orders.cancel', $order->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                        onclick="return confirm('Bạn chắc chắn muốn hủy đơn này?')">
                                        ❌ Hủy đơn
                                    </button>
                                </form>
                            @elseif($order->status === 'completed')
                                @foreach($order->items as $item)
                                <a href="{{ route('products.show', $item->product_id) }}" class="btn btn-sm btn-outline-success rounded-pill px-3">
                                    ⭐ Đánh giá
                                </a>
                                @endforeach
                            @endif

                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.orders.invoice', $order->id) }}" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                    🖨️ In hóa đơn
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-light text-center border rounded-3 shadow-sm">
                Bạn chưa có đơn hàng nào.
            </div>
        </div>
        @endforelse
    </div>
</div>

<style>
    .card-body img {
        object-fit: cover;
        height: 60px;
        width: 60px;
    }

    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border-radius: 1rem;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }
</style>
@endsection
