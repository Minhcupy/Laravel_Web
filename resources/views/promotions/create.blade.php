@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-3">Tạo khuyến mãi</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Lỗi!</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('promotions.store') }}" class="row g-3">
        @csrf

        <div class="col-md-6">
            <label class="form-label">Sản phẩm</label>
            <select name="product_id" class="form-select" required>
                <option value="">-- Chọn --</option>
                @foreach($products as $pr)
                    <option value="{{ $pr->id }}" @selected(old('product_id')==$pr->id)>
                        {{ $pr->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Phần trăm giảm (%)</label>
            <input type="number" name="discount_percentage" class="form-control" required
                   min="0" max="100" step="0.01" value="{{ old('discount_percentage') }}">
        </div>

        <div class="col-md-6">
            <label class="form-label">Ngày bắt đầu</label>
            <input type="datetime-local" name="start_date" class="form-control" required
                   value="{{ old('start_date') }}">
        </div>

        <div class="col-md-6">
            <label class="form-label">Ngày kết thúc</label>
            <input type="datetime-local" name="end_date" class="form-control" required
                   value="{{ old('end_date') }}">
        </div>

        <div class="col-12 d-flex gap-2">
            <button class="btn btn-primary">Lưu</button>
            <a href="{{ route('promotions.index') }}" class="btn btn-secondary">Quay lại</a>
        </div>
    </form>
</div>
@endsection
