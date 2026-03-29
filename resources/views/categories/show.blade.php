@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Show Category</h2>
    <a class="btn btn-primary mb-2" href="{{ route('categories.index') }}">Back</a>

    <div class="mb-2">
        <strong>Name:</strong> {{ $category->name }}
    </div>

    <div class="mb-2">
        <strong>Parent Category:</strong> {{ $category->parent->name ?? '-' }}
    </div>

    @if($category->children->count())
    <div class="mt-3">
        <strong>Child Categories:</strong>
        <ul class="list-group mt-1">
            @foreach($category->children as $child)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $child->name }}
                    <a href="{{ route('categories.show', $child) }}" class="btn btn-sm btn-info">View</a>
                </li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
@endsection
