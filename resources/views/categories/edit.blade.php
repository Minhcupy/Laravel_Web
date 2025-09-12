@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Category</h2>
    <a class="btn btn-primary mb-3" href="{{ route('categories.index') }}">Back</a>

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label"><strong>Name:</strong></label>
            <input type="text" name="name" id="name" value="{{ $category->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="parent_id" class="form-label"><strong>Parent Category:</strong></label>
            <select name="parent_id" id="parent_id" class="form-select">
                <option value="">-- None --</option>
                @foreach(App\Models\Category::whereNull('parent_id')->where('id', '!=', $category->id)->get() as $parent)
                    <option value="{{ $parent->id }}" {{ $category->parent_id == $parent->id ? 'selected' : '' }}>
                        {{ $parent->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
