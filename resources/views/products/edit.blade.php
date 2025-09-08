@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Product</h2>

    <a class="btn btn-secondary mb-3" href="{{ route('products.index') }}">
        ← Back to Products
    </a>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Name --}}
                <div class="mb-3">
                    <label class="form-label"><strong>Name</strong></label>
                    <input type="text" name="name"
                           value="{{ old('name', $product->name) }}"
                           class="form-control" placeholder="Enter product name">
                    @error('name')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label class="form-label"><strong>Description</strong></label>
                    <textarea name="description" rows="3" class="form-control"
                              placeholder="Enter product description">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Price --}}
                <div class="mb-3">
                    <label class="form-label"><strong>Price</strong></label>
                    <input type="number" name="price"
                           value="{{ old('price', $product->price) }}"
                           class="form-control" step="0.01" placeholder="Enter product price">
                    @error('price')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Stock --}}
                <div class="mb-3">
                    <label class="form-label"><strong>Stock</strong></label>
                    <input type="number" name="stock"
                           value="{{ old('stock', $product->stock) }}"
                           class="form-control" min="0" placeholder="Enter available stock">
                    @error('stock')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Category --}}
                <div class="mb-3">
                    <label class="form-label"><strong>Category</strong></label>
                    <select name="category_id" class="form-select">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Current Image --}}
                <div class="mb-3">
                    <label class="form-label"><strong>Current Image</strong></label><br>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="img-thumbnail mb-2" width="150" alt="Current Product Image">
                    @else
                        <span class="text-muted">No image available</span>
                    @endif
                </div>

                {{-- New Image Upload --}}
                <div class="mb-3">
                    <label class="form-label"><strong>Upload New Image</strong></label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    @error('image')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">
                    💾 Update Product
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
