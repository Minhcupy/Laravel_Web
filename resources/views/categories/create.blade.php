@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create New Category</h2>
    <a class="btn btn-primary mb-2" href="{{ route('categories.index') }}">Back</a>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label"><strong>Name:</strong></label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="parent_id" class="form-label"><strong>Parent Category:</strong></label>
            <select name="parent_id" id="parent_id" class="form-select">
                <option value="">-- None (Top-level Category) --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>
@endsection
