@extends('layouts.app')
@section('title', 'Quên mật khẩu')
@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%; border-radius: 1rem;">
        <div class="text-center mb-4">
            <span style="display:inline-block;width:80px;height:80px;background:#e3f2fd;border-radius:50%;box-shadow:0 0 10px #1e88e5;">
                <svg width="60" height="60" viewBox="0 0 60 60" fill="none" style="margin-top:10px;" xmlns="http://www.w3.org/2000/svg">
                    <ellipse cx="30" cy="20" rx="18" ry="7" fill="#1e88e5"/>
                    <rect x="22" y="32" width="16" height="6" rx="3" fill="#42a5f5" transform="rotate(-25 22 32)"/>
                    <rect x="36" y="40" width="10" height="4" rx="2" fill="#1565c0" transform="rotate(-10 36 40)"/>
                    <circle cx="30" cy="20" r="3" fill="#fff" stroke="#1565c0" stroke-width="2"/>
                </svg>
            </span>
            <h2 class="fw-bold text-primary mt-3 mb-1">Quên mật khẩu Mimi Shop</h2>
            <p class="text-muted mb-0">Nhập email để nhận liên kết đặt lại mật khẩu.</p>
        </div>
        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold text-primary">Email</label>
                <input type="email" name="email" id="email" class="form-control rounded-pill" value="{{ old('email') }}" required autofocus>
                @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn btn-primary w-100 rounded-pill fw-bold py-2">
                <i class="bi bi-envelope-arrow-up me-1"></i> Gửi liên kết đặt lại mật khẩu
            </button>
        </form>
        <div class="text-center mt-3">
            <a href="{{ route('login') }}" class="text-primary fw-semibold">Quay lại đăng nhập</a>
        </div>
    </div>
</div>
<style>
body {
    background: linear-gradient(135deg, #e3f2fd 0%, #fff 100%);
}
.card {
    border: none;
}
.btn-primary {
    background: linear-gradient(90deg, #1e88e5 60%, #42a5f5 100%);
    border: none;
}
.btn-primary:hover {
    background: #1565c0;
}
</style>
@endsection