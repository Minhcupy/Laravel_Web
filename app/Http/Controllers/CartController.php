<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;

class CartController extends Controller
{
    // Hiển thị giỏ hàng
    public function index()
    {
        $cart = session('cart', []);
        return view('cart.index', compact('cart'));
    }

    // Thêm sản phẩm vào giỏ
    public function add(Request $request, $id)
    {
        $product = Product::with('promotion')->findOrFail($id);
        $cart = session()->get('cart', []);

        $quantity = max(1, (int) $request->quantity); // lấy số lượng từ request
        if ($quantity > $product->stock) {
            if ($request->ajax()) {
                return response()->json(['error' => 'Số lượng vượt quá tồn kho!'], 400);
            }
            return back()->with('error', 'Số lượng vượt quá tồn kho!');
        }

        $price = $product->price;
        $discountPrice = $product->discounted_price;

        if (isset($cart[$id])) {
            $newQty = min($cart[$id]['quantity'] + $quantity, $product->stock);
            $cart[$id]['quantity'] = $newQty;
        } else {
            $cart[$id] = [
                "name"           => $product->name,
                "price"          => $price,
                "discount_price" => $discountPrice,
                "quantity"       => $quantity,
                "stock"          => $product->stock,
                "image"          => $product->image,
                "promotion_id"   => $product->promotion->id ?? null,
                "promotion_pct"  => $product->promotion->discount_percentage ?? null,
            ];
        }

        session()->put('cart', $cart);

        if ($request->ajax()) {
            return response()->json([
                'success' => 'Đã thêm vào giỏ!',
                'cart_count' => collect($cart)->sum('quantity')
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Đã thêm vào giỏ!');
    }



    // Cập nhật số lượng
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        $product = Product::with('promotion')->findOrFail($id);
        $newQty = max(1, (int)$request->quantity);

        if ($newQty > $product->stock) {
            return back()->with('error', 'Số lượng vượt quá tồn kho!');
        }

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $newQty;
            $cart[$id]['discount_price'] = $product->discounted_price; // luôn update giá giảm mới nhất
            $cart[$id]['promotion_id']   = $product->promotion->id ?? null;
            $cart[$id]['promotion_pct']  = $product->promotion->discount_percentage ?? null;
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Cập nhật thành công!');
    }

    // Xóa sản phẩm
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.index')->with('success', 'Đã xóa sản phẩm!');
    }

    // Xóa toàn bộ giỏ
    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Đã hủy toàn bộ giỏ hàng!');
    }

    // Thanh toán
    public function checkout()
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return back()->with('error', 'Giỏ hàng trống!');
        }

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => Auth::id(),
                'status'  => 'pending',
                'total'   => collect($cart)->sum(fn($item) => $item['discount_price'] * $item['quantity']),
            ]);

            foreach ($cart as $id => $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $id,
                    'quantity'   => $item['quantity'],
                    'price'      => $item['discount_price'],
                    'promotion_id' => $item['promotion_id'] ?? null,
                ]);

                $product = Product::find($id);
                if ($product) {
                    $product->stock -= $item['quantity'];
                    $product->save();
                }
            }

            DB::commit();
            session()->forget('cart');

            // 🔹 Gửi email
            $user = Auth::user();
            Mail::to($user->email)->send(new InvoiceMail($order));

            return redirect()->route('orders.show', $order->id)
                ->with('success', 'Đặt hàng thành công! Hóa đơn đã được gửi đến email của bạn.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
}
