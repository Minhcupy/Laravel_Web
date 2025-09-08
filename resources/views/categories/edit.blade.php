@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Category</h2>
    <a class="btn btn-primary mb-2" href="{{ route('categories.index') }}">Back</a>

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="form-group">
            <strong>Name:</strong>
            <input type="text" name="name" value="{{ $category->name }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success mt-2">Update</button>
    </form>
</div>
@endsection
