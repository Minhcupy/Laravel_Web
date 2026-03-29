@extends('layouts.admin')

@section('title', 'Categories')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">📂 Parent Categories</h2>
        <a href="{{ route('categories.create') }}" class="btn btn-success">➕ Add Category</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Bảng Parent Categories --}}
    <div class="card shadow mb-4">
        <div class="card-body p-0">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th width="200px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories->whereNull('parent_id') as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <a href="{{ route('categories.show', $category) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Bảng Child Categories --}}
    <!-- <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">📂 Child Categories</h2>
    </div>

    <div class="card shadow">
        <div class="card-body p-0">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Parent Category</th>
                        <th width="200px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories->whereNotNull('parent_id') as $child)
                        <tr>
                            <td>{{ $child->id }}</td>
                            <td>{{ $child->name }}</td>
                            <td>{{ $child->parent->name ?? '-' }}</td>
                            <td>
                                <a href="{{ route('categories.show', $child) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('categories.edit', $child) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('categories.destroy', $child) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div> -->

</div>
@endsection
