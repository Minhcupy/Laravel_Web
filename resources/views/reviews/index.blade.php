@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">📋 Quản lý đánh giá</h2>

    @foreach($reviews as $review)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <strong>{{ $review->user->name }}</strong>
                        <span class="text-warning">⭐ {{ $review->rating }}</span>
                        <p class="mb-1">{{ $review->comment }}</p>
                        <small class="text-muted">Sản phẩm: {{ $review->product->name }}</small>
                    </div>
                    <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Xóa đánh giá này?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Xóa</button>
                    </form>
                </div>

                {{-- Hiển thị trả lời --}}
                @if($review->replies->count())
                    <div class="ms-3 mt-2 border-start ps-2">
                        @foreach($review->replies as $reply)
                            <p class="mb-1"><strong>{{ $reply->user->name }} (Admin):</strong> {{ $reply->comment }}</p>
                        @endforeach
                    </div>
                @endif

                {{-- Form trả lời --}}
                <form action="{{ route('admin.reviews.reply', $review->id) }}" method="POST" class="mt-2">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="reply" class="form-control" placeholder="Nhập câu trả lời...">
                        <button class="btn btn-primary">Trả lời</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    {{ $reviews->links() }}
</div>
@endsection
