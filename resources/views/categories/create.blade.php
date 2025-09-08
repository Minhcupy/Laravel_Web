@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create New Category</h2>
    <a class="btn btn-primary mb-2" href="{{ route('categories.index') }}">Back</a>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <strong>Name:</strong>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success mt-2">Submit</button>
    </form>
</div>
@endsection
