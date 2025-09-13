@extends('layouts.admin')

@section('title', 'Products')

@section('content')
<div class="container-fluid mt-4">
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">📦 Quản lý sản phẩm</h2>
        <a href="{{ route('products.create') }}" class="btn btn-success shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Thêm sản phẩm
        </a>
    </div>

    {{-- Bảng sản phẩm --}}
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Ảnh</th>
                            <th>Tên</th>
                            <th>Mô tả</th>
                            <th>Giá</th>
                            <th>Tồn kho</th>
                            <th>Danh mục</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td class="fw-semibold">#{{ $product->id }}</td>
                            <td>
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}"
                                        width="60" height="60"
                                        class="rounded shadow-sm border">
                                @else
                                    <img src="https://via.placeholder.com/60"
                                        alt="No image"
                                        class="rounded shadow-sm border">
                                @endif
                            </td>
                            <td class="text-start">{{ $product->name }}</td>
                            <td class="text-muted small">{{ \Illuminate\Support\Str::limit($product->description, 50) }}</td>
                            <td class="fw-bold text-danger">{{ number_format($product->price, 0, ',', '.') }} ₫</td>
                            <td>
                                @if($product->stock > 0)
                                    <span class="badge bg-success">{{ $product->stock }}</span>
                                @else
                                    <span class="badge bg-danger">Hết hàng</span>
                                @endif
                            </td>
                            <td>{{ $product->category->name ?? 'N/A' }}</td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Xoá sản phẩm này?')" 
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-muted text-center">Không có sản phẩm nào.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- CSS riêng cho bảng --}}
<style>
    .table-hover tbody tr:hover {
        background: #f8f9fa;
        transition: 0.2s;
    }
</style>
@endsection
