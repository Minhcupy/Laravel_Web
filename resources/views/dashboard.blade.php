@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">📊 Admin Dashboard</h2>
        <a href="{{ route('shop.index') }}" class="btn btn-outline-secondary">
            ⬅ Quay về trang chủ
        </a>
    </div>

    {{-- Các thống kê nhanh --}}
    <div class="row g-4">
        {{-- Sản phẩm --}}
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <div class="text-primary mb-2">
                        <i class="bi bi-box-seam fs-1"></i>
                    </div>
                    <h6 class="text-muted">Tổng sản phẩm</h6>
                    <h3 class="fw-bold">{{ $products }}</h3>
                </div>
            </div>
        </div>

        {{-- Danh mục --}}
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <div class="text-success mb-2">
                        <i class="bi bi-tags fs-1"></i>
                    </div>
                    <h6 class="text-muted">Tổng danh mục</h6>
                    <h3 class="fw-bold">{{ $categories }}</h3>
                </div>
            </div>
        </div>

        {{-- Người dùng --}}
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <div class="text-warning mb-2">
                        <i class="bi bi-people fs-1"></i>
                    </div>
                    <h6 class="text-muted">Tài khoản</h6>
                    <h3 class="fw-bold">{{ $users }}</h3>
                </div>
            </div>
        </div>

        {{-- Khuyến mãi --}}
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <div class="text-danger mb-2">
                        <i class="bi bi-gift fs-1"></i>
                    </div>
                    <h6 class="text-muted">Khuyến mãi</h6>
                    <h3 class="fw-bold">{{ $promotions }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Thêm CSS riêng cho dashboard --}}
<style>
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }
</style>
@endsection
