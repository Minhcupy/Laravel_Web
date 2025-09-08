@extends('layouts.admin')


@section('content')
<div class="container">
    <h2 class="mb-3">Danh sách khuyến mãi</h2>

    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if(session('error'))   <div class="alert alert-danger">{{ session('error') }}</div> @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <a href="{{ route('promotions.create') }}" class="btn btn-primary">Tạo khuyến mãi mới</a>
        </div>
        {{-- Bộ lọc: tính năng UI cá nhân --}}
        <form class="d-flex" method="get">
            <select name="filter" class="form-select me-2" onchange="this.form.submit()">
                <option value="all"     {{ $filter==='all'?'selected':'' }}>Tất cả</option>
                <option value="active"  {{ $filter==='active'?'selected':'' }}>Đang hiệu lực</option>
                <option value="expired" {{ $filter==='expired'?'selected':'' }}>Đã hết hạn</option>
            </select>
            <noscript><button class="btn btn-secondary">Lọc</button></noscript>
        </form>
    </div>

    @if($promotions->count() === 0)
        <div class="alert alert-info">Chưa có chương trình khuyến mãi</div>
    @else
    <div class="table-responsive">
        <table class="table table-bordered align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th>Sản phẩm</th>
                    <th>Giảm (%)</th>
                    <th>Bắt đầu</th>
                    <th>Kết thúc</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($promotions as $p)
                    <tr @class([
                        'table-success' => now()->between($p->start_date, $p->end_date),
                        'table-secondary' => now()->gt($p->end_date)
                    ])>
                        <td class="text-start">{{ $p->product->name ?? '—' }}</td>
                        <td>{{ number_format($p->discount_percentage, 2) }}</td>
                        <td>{{ $p->start_date->format('d/m/Y H:i') }}</td>
                        <td>{{ $p->end_date->format('d/m/Y H:i') }}</td>
                        <td>
                            <form action="{{ route('promotions.destroy', $p) }}" method="POST"
                                  onsubmit="return confirm('Xóa khuyến mãi này?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $promotions->withQueryString()->links() }}
    </div>
    @endif
</div>
@endsection
