@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center fw-bold">📦 Đơn hàng của tôi</h2>

    <div class="row g-3">
        @forelse($orders as $order)
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    {{-- Header đơn hàng --}}
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                        <div>
                            <strong>#{{ $order->id }}</strong> •
                            <small class="text-muted">{{ $order->created_at->format('d/m/Y H:i') }}</small>
                        </div>
                        <div>
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
                        </div>
                    </div>

                    {{-- Sản phẩm trong đơn --}}
                    <div class="row g-2 align-items-center mb-2">
                        @foreach($order->items as $item)
                        <div class="col-2 col-md-1">
                            @if($item->product && $item->product->image)
                            <img src="{{ asset('storage/' . $item->product->image) }}" class="img-fluid rounded" alt="{{ $item->product->name }}">
                            @else
                            <img src="https://via.placeholder.com/50?text=No+Image" class="img-fluid rounded" alt="No image">
                            @endif
                        </div>
                        <div class="col-6 col-md-7">
                            <div class="fw-semibold">{{ $item->product->name ?? 'Sản phẩm' }}</div>
                            <small class="text-muted">Số lượng: {{ $item->quantity }}</small>
                        </div>
                        <div class="col-4 col-md-4 text-end fw-bold text-primary">
                            {{ number_format($item->price * $item->quantity, 0, ',', '.') }} ₫
                        </div>
                        @endforeach
                    </div>

                    <hr class="my-2">

                    {{-- Footer đơn hàng: tổng tiền + hành động --}}
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div class="fw-bold">Tổng tiền: {{ number_format($order->total, 0, ',', '.') }} ₫</div>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                👁️ Xem chi tiết
                            </a>

                            @if($order->status === 'pending')
                            <form action="{{ route('orders.cancel', $order->id) }}" method="POST" style="display:inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Bạn chắc chắn muốn hủy đơn này?')">
                                    ❌ Hủy đơn
                                </button>
                            </form>
                            @elseif($order->status === 'completed')
                            @foreach($order->items as $item)
                            <a href="{{ route('products.show', $item->product_id) }}" class="btn btn-sm btn-outline-success">
                                ⭐ Đánh giá
                            </a>
                            @endforeach
                            @endif
                            {{-- Nút in hóa đơn chỉ admin --}}
                            @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.orders.invoice', $order->id) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
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
            <div class="alert alert-light text-center mb-0">Bạn chưa có đơn hàng nào.</div>
        </div>
        @endforelse
    </div>
</div>

<style>
    .card-body img {
        object-fit: cover;
        height: 50px;
        width: 50px;
    }

    .card {
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
    }
</style>
@endsection