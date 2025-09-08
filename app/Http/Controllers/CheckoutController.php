<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $cart = session('cart', []);
        $selected = $request->input('selected', []);

        if (empty($selected)) {
            return redirect()->route('cart.index')->with('error', 'Vui lòng chọn sản phẩm để thanh toán!');
        }

        $cartSelected = array_intersect_key($cart, array_flip($selected));
        if (empty($cartSelected)) {
            return redirect()->route('cart.index')->with('error', 'Không có sản phẩm hợp lệ để thanh toán!');
        }

        session()->put('checkout_cart', $cartSelected);

        return view('checkout.index', ['cart' => $cartSelected]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'phone'          => 'required|string|max:20',
            'address'        => 'required|string|max:255',
            'payment_method' => 'required|string'
        ]);

        $cart = session('checkout_cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Không có sản phẩm nào để thanh toán!');
        }

        // Kiểm tra tồn kho
        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if (!$product || $product->stock < $item['quantity']) {
                return redirect()->route('cart.index')->with('error', "Sản phẩm {$item['name']} không đủ hàng trong kho!");
            }
        }

        // Tính tổng
        $total = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart));

        // Tạo order
        $order = Order::create([
            'user_id'        => Auth::id(),
            'name'           => $request->name,
            'phone'          => $request->phone,
            'address'        => $request->address,
            'total'          => $total,
            'payment_method' => $request->payment_method,
            'status'         => 'pending'
        ]);

        // Lưu items + trừ tồn kho
        foreach ($cart as $id => $item) {
            $product = Product::find($id);

            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $id,
                'quantity'   => $item['quantity'],
                'price'      => $item['price']
            ]);

            $product->decrement('stock', $item['quantity']);
        }

        // Cập nhật trạng thái trong giỏ hàng
        $fullCart = session('cart', []);
        foreach (array_keys($cart) as $id) {
            if (isset($fullCart[$id])) {
                $fullCart[$id]['status'] = 'ordered';
            }
        }
        session()->put('cart', $fullCart);

        session()->forget('checkout_cart');

        // Nếu chọn VNPay thì redirect sang VNPay
        if ($request->payment_method === 'vnpay') {
            return $this->vnpayPayment($order);
        }

        // Nếu COD thì hiển thị hóa đơn
        return redirect()->route('checkout.invoice', $order->id)
            ->with('success', 'Đặt hàng thành công (COD)!');
    }

    private function vnpayPayment(Order $order)
    {
        $vnp_TmnCode    = trim(env('VNPAY_TMN_CODE'));
        $vnp_HashSecret = trim(env('VNPAY_HASH_SECRET'));
        $vnp_Url        = trim(env('VNPAY_URL'));
        $vnp_Returnurl  = trim(env('VNPAY_RETURN_URL'));

        // Số tiền đơn vị: đồng * 100 (đơn vị nhỏ nhất). Ép int và đảm bảo >= 100
        $amount = (int) round($order->total * 100);
        if ($amount < 100) $amount = 100;

        $inputData = [
            "vnp_Version"    => "2.1.0",
            "vnp_TmnCode"    => $vnp_TmnCode,
            "vnp_Amount"     => $amount,
            "vnp_Command"    => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode"   => "VND",
            "vnp_IpAddr"     => request()->ip(),
            "vnp_Locale"     => "vn",
            "vnp_OrderInfo"  => "Thanh toán đơn hàng #" . $order->id,
            "vnp_OrderType"  => "billpayment",
            "vnp_ReturnUrl"  => $vnp_Returnurl, // CHUẨN KEY
            "vnp_TxnRef"     => (string)$order->id,
            // "vnp_ExpireDate" => date('YmdHis', strtotime('+15 minutes')), // nếu muốn
            // "vnp_BankCode"   => "NCB", // để test nhanh
        ];

        ksort($inputData);

        // Build query & hashData theo mẫu VNPay (urlencode từng cặp)
        $hashData = '';
        $query    = '';
        $i = 0;
        foreach ($inputData as $key => $value) {
            $keyEnc = urlencode($key);
            $valEnc = urlencode($value);
            $hashData .= ($i ? '&' : '') . "{$keyEnc}={$valEnc}";
            $query    .= "{$keyEnc}={$valEnc}&";
            $i = 1;
        }

        $vnpSecureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        $paymentUrl    = $vnp_Url . '?' . $query . 'vnp_SecureHash=' . $vnpSecureHash;

        // Log để debug khi cần
        Log::info('VNPay build', [
            'inputData' => $inputData,
            'hashData'  => $hashData,
            'secure'    => $vnpSecureHash,
            'url'       => $paymentUrl,
        ]);

        return redirect($paymentUrl);
    }

    public function vnpayReturn(Request $request)
    {
        Log::info('VNPay Return', $request->all()); // thêm dòng này

        $vnp_HashSecret = trim(env('VNPAY_HASH_SECRET'));
        $inputData = $request->all();
        $vnp_SecureHash = $inputData['vnp_SecureHash'] ?? '';

        unset($inputData['vnp_SecureHash'], $inputData['vnp_SecureHashType']);
        ksort($inputData);

        $hashData = '';
        $i = 0;
        foreach ($inputData as $key => $value) {
            $hashData .= ($i ? '&' : '') . urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);


        $orderId = $inputData['vnp_TxnRef'] ?? null;
        $order   = $orderId ? Order::find($orderId) : null;

        if (!hash_equals($secureHash, $vnp_SecureHash) || !$order) {
            Log::error('VNPay hash failed', [
                'calculated' => $secureHash,
                'received'   => $vnp_SecureHash,
                'orderId'    => $orderId
            ]);
            return redirect()->route('shop.index')
                ->with('error', 'Chữ ký VNPay không hợp lệ hoặc không tìm thấy đơn hàng!');
        }

        if (($inputData['vnp_ResponseCode'] ?? '') === '00') {
            $order->status = 'paid';
            $order->save();
            session()->forget('cart');

            return redirect()->route('checkout.invoice', $order->id)
                ->with('success', 'Thanh toán VNPay thành công!');
        } else {
            $order->status = 'failed';
            $order->save();

            return redirect()->route('checkout.invoice', $order->id)
                ->with('error', 'Thanh toán VNPay thất bại! Mã lỗi: ' . $inputData['vnp_ResponseCode']);
        }
    }

    public function invoice($orderId)
    {
        $order = Order::with('items.product')->findOrFail($orderId);
        return view('checkout.invoice', compact('order'));
    }
}
