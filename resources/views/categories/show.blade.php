@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Show Category</h2>
    <a class="btn btn-primary mb-2" href="{{ route('categories.index') }}">Back</a>

    <div class="form-group">
        <strong>Name:</strong> {{ $category->name }}
    </div>
</div>
@endsection
