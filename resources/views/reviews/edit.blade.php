@extends('layouts.app')

@section('content')
<div class="container py-5 d-flex justify-content-center align-items-center" style="min-height:70vh;">
    <div class="card shadow-lg border-0 p-4" style="max-width: 480px; width:100%;">
        <div class="mb-4 text-center">
            <i class="bi bi-pencil-square fs-1 text-primary"></i>
            <h3 class="fw-bold mt-2">Sửa đánh giá</h3>
        </div>
        <form action="{{ route('reviews.update', $review->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="rating" class="form-label fw-semibold">Số sao</label>
                <select name="rating" id="rating" class="form-select" required>
                    @for($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" {{ $review->rating == $i ? 'selected' : '' }}>
                            {{ $i }} {{ $i == 1 ? 'Sao' : 'Sao' }}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="mb-3">
                <label for="comment" class="form-label fw-semibold">Bình luận</label>
                <textarea name="comment" id="comment" class="form-control" rows="3" maxlength="1000" placeholder="Nhập bình luận...">{{ old('comment', $review->comment) }}</textarea>
            </div>
            <div class="d-flex gap-2 justify-content-end">
                <button class="btn btn-primary px-4" type="submit">
                    <i class="bi bi-save"></i> Cập nhật
                </button>
                <a href="{{ route('products.show', $review->product_id) }}" class="btn btn-outline-secondary px-4">
                    <i class="bi bi-arrow-left"></i> Quay lại
                </a>
            </div>
        </form>
    </div>
</div>
{{-- Bootstrap Icons --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endsection