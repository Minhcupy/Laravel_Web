<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['user', 'product', 'replies.user'])
            ->latest()
            ->paginate(10);

        return view('admin.reviews.index', compact('reviews'));
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return back()->with('success', 'Đã xóa đánh giá!');
    }

    public function reply(Request $request, Review $review)
    {
        $request->validate([
            'reply' => 'required|string|max:500',
        ]);

        $review->replies()->create([
            'user_id' => auth()->id(),
            'product_id' => $review->product_id,
            'rating' => 5, // mặc định trả lời là admin, không tính rating
            'comment' => $request->reply,
            'parent_id' => $review->id,
        ]);

        return back()->with('success', 'Đã trả lời đánh giá!');
    }
}
