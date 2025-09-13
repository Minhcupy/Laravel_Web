@extends('layouts.admin')

@section('title', 'Categories')

@section('content')
<div class="container-fluid mt-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">📂 Quản lý danh mục</h2>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-success shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Thêm danh mục
        </a>
    </div>

    {{-- Thông báo --}}
    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    {{-- Bảng Parent Categories --}}
    <div class="card shadow-sm border-0 rounded-3 mb-4">
        <div class="card-header bg-primary text-white fw-semibold">
            Danh mục cha
        </div>
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0 text-center">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Tên danh mục</th>
                        <th style="width: 160px;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories->whereNull('parent_id') as $category)
                        <tr>
                            <td class="fw-semibold">#{{ $category->id }}</td>
                            <td class="text-start">
                                <i class="bi bi-folder-fill text-warning me-1"></i> {{ $category->name }}
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('admin.categories.show', $category) }}" 
                                       class="btn btn-outline-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.categories.edit', $category) }}" 
                                       class="btn btn-outline-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Bạn có chắc chắn muốn xoá?')">
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
                            <td colspan="3" class="text-muted text-center">Chưa có danh mục nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Bảng Child Categories --}}
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-secondary text-white fw-semibold">
            Danh mục con
        </div>
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0 text-center">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Tên danh mục</th>
                        <th>Danh mục cha</th>
                        <th style="width: 160px;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories->whereNotNull('parent_id') as $child)
                        <tr>
                            <td class="fw-semibold">#{{ $child->id }}</td>
                            <td class="text-start">
                                <i class="bi bi-folder2-open text-primary me-1"></i> {{ $child->name }}
                            </td>
                            <td>
                                <span class="badge bg-info text-dark">
                                    {{ $child->parent->name ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('admin.categories.show', $child) }}" 
                                       class="btn btn-outline-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.categories.edit', $child) }}" 
                                       class="btn btn-outline-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $child) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Bạn có chắc chắn muốn xoá?')">
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
                            <td colspan="4" class="text-muted text-center">Chưa có danh mục con nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- CSS riêng --}}
<style>
    .table-hover tbody tr:hover {
        background: #f8f9fa;
        transition: 0.2s;
    }
</style>
@endsection
