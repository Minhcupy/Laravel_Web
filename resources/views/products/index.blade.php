@extends('layouts.admin')


@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>📦 Products</h1>
        <a href="{{ route('products.create') }}" class="btn btn-success">
            + Add Product
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered shadow-sm align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock</th> {{-- Cột tồn kho --}}
                    <th>Category</th>
                    <th style="width: 160px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     alt="{{ $product->name }}" 
                                     width="60" height="60" 
                                     class="rounded">
                            @else
                                <img src="https://via.placeholder.com/60" 
                                     alt="No image" 
                                     class="rounded">
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($product->description, 50) }}</td>
                        <td>{{ number_format($product->price, 0, ',', '.') }} VNĐ</td>
                        <td>{{ $product->stock ?? 0 }}</td> {{-- Hiển thị số lượng tồn kho --}}
                        <td>{{ $product->category->name ?? 'N/A' }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('products.show', $product->id) }}" 
                                   class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('products.edit', $product->id) }}" 
                                   class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('products.destroy', $product->id) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Xoá sản phẩm này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Không có sản phẩm nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
