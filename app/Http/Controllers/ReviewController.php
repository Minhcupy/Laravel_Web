<?php
namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $productId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        Review::create([
            'user_id'    => Auth::id(),
            'product_id' => $productId,
            'rating'     => $request->rating,
            'comment'    => $request->comment,
        ]);

        return back()->with('success', 'Đánh giá đã được gửi!');
    }

    public function edit(Review $review)
    {
        // Chỉ cho phép chủ review hoặc admin sửa
        if (Auth::id() !== $review->user_id && Auth::user()->role !== 'admin') {
            abort(403);
        }
        return view('reviews.edit', compact('review'));
    }

    public function update(Request $request, Review $review)
    {
        if (Auth::id() !== $review->user_id && Auth::user()->role !== 'admin') {
            abort(403);
        }
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);
        $review->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
        return redirect()->route('products.show', $review->product_id)
            ->with('success', 'Đã cập nhật đánh giá!');
    }

    public function destroy(Review $review)
    {
        if (Auth::id() !== $review->user_id && Auth::user()->role !== 'admin') {
            abort(403);
        }
        $productId = $review->product_id;
        $review->delete();
        return redirect()->route('products.show', $productId)
            ->with('success', 'Đã xóa đánh giá!');
    }
}
