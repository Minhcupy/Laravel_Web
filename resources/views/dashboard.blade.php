@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Admin Dashboard</h2>
        <!-- Nút quay về trang chủ -->
        <a href="{{ route('shop.index') }}" class="btn btn-secondary">⬅ Quay về trang chủ</a>
    </div>

    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card bg-light shadow">
                <div class="card-body text-center">
                    <h5>Tổng sản phẩm</h5>
                    <h3>{{ $products }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card bg-light shadow">
                <div class="card-body text-center">
                    <h5>Tổng danh mục</h5>
                    <h3>{{ $categories }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card bg-light shadow">
                <div class="card-body text-center">
                    <h5>Tài khoản</h5>
                    <h3>{{ $users }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card bg-light shadow">
                <div class="card-body text-center">
                    <h5>Khuyến mãi</h5>
                    <h3>{{ $promotions }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
