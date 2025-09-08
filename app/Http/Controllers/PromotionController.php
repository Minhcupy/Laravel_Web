<?php

// app/Http/Controllers/PromotionController.php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function __construct()
    {
        // Chỉ admin mới truy cập danh sách/tạo/xóa
        $this->middleware(['auth', \App\Http\Middleware\CheckRole::class . ':admin'])
            ->only(['index', 'create', 'store', 'destroy']);
        // Áp dụng khuyến mãi cho giỏ: chỉ cần đăng nhập
        $this->middleware('auth')->only('applyPromotion');
    }

    /** Danh sách khuyến mãi (Admin) */
    public function index(Request $request)
    {
        // Tính năng UI độc đáo: bộ lọc "hiệu lực / hết hạn"
        $filter = $request->query('filter', 'all'); // all|active|expired

        $promotions = Promotion::with('product')
            ->when($filter === 'active', fn($q) => $q->active())
            ->when(
                $filter === 'expired',
                fn($q) =>
                $q->where('end_date', '<', now())
            )
            ->orderByDesc('id')
            ->paginate(10);

        return view('promotions.index', compact('promotions', 'filter'));
    }

    public function create()
    {
        $products = Product::orderBy('name')->get(['id', 'name']);
        return view('promotions.create', compact('products'));
    }

    /** Tạo khuyến mãi mới (Admin) */
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id'          => ['required', 'exists:products,id'],
            'discount_percentage' => ['required', 'numeric', 'min:0', 'max:100'],
            'start_date'          => ['required', 'date', 'after_or_equal:today'],
            'end_date'            => ['required', 'date', 'after_or_equal:start_date'],
        ]);

        Promotion::create($data);

        return redirect()
            ->route('promotions.index')
            ->with('success', 'Tạo khuyến mãi thành công!');
    }

    /** Xóa nhanh (tuỳ chọn) */
    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        return back()->with('success', 'Đã xóa khuyến mãi!');
    }

    /**
     * Áp dụng khuyến mãi cho giỏ hàng hiện tại (session('cart')).
     * Logic theo đề: nếu sản phẩm trong cart có khuyến mãi hợp lệ thì giảm theo %,
     * lưu giá đã giảm vào key 'discounted_price' của từng item.
     */
    public function applyPromotion(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Giỏ hàng đang trống.');
        }

        $changed = false;

        foreach ($cart as $productId => &$item) {
            $promotion = \App\Models\Promotion::where('product_id', $productId)
                ->active() // <-- dùng scope mới
                ->orderByDesc('discount_percentage')
                ->first();

            if ($promotion) {
                $origPrice = (float) $item['price'];
                $pct       = (float) $promotion->discount_percentage;

                $discounted = round($origPrice * (1 - $pct / 100)); // VND thường làm tròn nguyên

                $item['discounted_price'] = max(0, $discounted); // <-- đúng key
                $item['promotion_pct']    = $pct;
                $item['promotion_id']     = $promotion->id;
                $changed = true;
            } else {
                // Không có KM hợp lệ -> xoá dấu vết cũ nếu có
                if (isset($item['discounted_price'])) {
                    unset($item['discounted_price'], $item['promotion_pct'], $item['promotion_id']);
                    $changed = true;
                }
            }
        }
        unset($item);

        if ($changed) {
            session()->put('cart', $cart);
            return back()->with('success', 'Đã áp dụng khuyến mãi cho giỏ hàng.');
        }

        return back()->with('error', 'Không có khuyến mãi hợp lệ để áp dụng.');
    }
}
