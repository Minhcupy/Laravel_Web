@extends('layouts.app')

@section('title', 'Thêm sản phẩm')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Thêm sản phẩm</h2>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">⬅ Trở về</a>
</div>

<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Tên sản phẩm</label>
        <input type="text" name="name" id="name" class="form-control" 
               value="{{ old('name') }}" required>
    </div>

    <div class="mb-3">
        <label for="category_id" class="form-label">Danh mục</label>
        <select name="category_id" id="category_id" class="form-select" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Mô tả</label>
        <textarea name="description" id="description" class="form-control" 
                  rows="3">{{ old('description') }}</textarea>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Giá</label>
        <input type="number" name="price" id="price" class="form-control" 
               value="{{ old('price') }}" min="0" required>
    </div>

    {{-- Thêm trường nhập tồn kho --}}
    <div class="mb-3">
        <label for="stock" class="form-label">Số lượng tồn kho</label>
        <input type="number" name="stock" id="stock" class="form-control" 
               value="{{ old('stock') }}" min="0" required>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Ảnh sản phẩm</label>
        <input type="file" name="image" id="image" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Lưu</button>
</form>
@endsection
