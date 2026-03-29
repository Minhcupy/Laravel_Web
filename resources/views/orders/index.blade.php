@extends('layouts.admin')

@section('title', 'Orders')

@section('content')
<div class="container-fluid py-4">

    {{-- Tiêu đề --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">📦 Quản lý đơn hàng</h2>
    </div>

    {{-- Thông báo --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Bảng đơn hàng --}}
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-primary text-white fw-semibold">
            Danh sách đơn hàng
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Mã đơn</th>
                            <th>Khách hàng</th>
                            <th>SĐT</th>
                            <th>Địa chỉ</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Ngày đặt</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td class="fw-semibold">#{{ $order->id }}</td>
                            <td class="text-start">{{ $order->name }}</td>
                            <td>{{ $order->phone }}</td>
                            <td class="text-start">{{ $order->address }}</td>
                            <td class="text-end fw-bold text-danger">{{ number_format($order->total, 0, ',', '.') }} ₫</td>
                            <td>
                                <form action="{{ route('orders.update', $order) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="form-select form-select-sm shadow-sm" onchange="this.form.submit()">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>⏳ Chờ xử lý</option>
                                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>🔄 Đang xử lý</option>
                                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>✅ Hoàn thành</option>
                                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>❌ Hủy</option>
                                    </select>
                                </form>
                            </td>
                            <td>{{ $order->created_at->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i') }}</td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('orders.show', $order) }}" class="btn btn-outline-info" title="Xem chi tiết">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <form action="{{ route('orders.destroy', $order) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xoá đơn này?')" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Xoá đơn">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-muted text-center py-3">Không có đơn hàng nào.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Phân trang --}}
    <div class="mt-3 d-flex justify-content-center">
        {{ $orders->links('pagination::bootstrap-5') }}
    </div>
</div>

{{-- CSS riêng --}}
<style>
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
        transition: 0.2s;
    }
    .card-header {
        font-size: 16px;
    }
</style>
@endsection
