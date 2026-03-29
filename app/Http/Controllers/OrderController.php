<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Payment;

class OrderController extends Controller
{
    // Danh sách đơn hàng
    public function index()
    {
        $orders = Order::latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    // Xem chi tiết đơn hàng
    public function show(Order $order)
    {
        $order->load('items.product');
        return view('orders.show', compact('order'));
    }

    // Cập nhật trạng thái đơn hàng
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string|in:pending,processing,completed,cancelled'
        ]);

        $oldStatus = $order->status;
        $newStatus = $request->status;

        // Nếu hủy đơn hàng thì hoàn lại stock
        if ($newStatus === 'cancelled' && $oldStatus !== 'cancelled') {
            foreach ($order->items as $item) {
                if ($item->product) {
                    $item->product->stock += $item->quantity;
                    $item->product->save();
                }
            }
        }

        $order->update(['status' => $newStatus]);

        return redirect()->route('orders.index')->with('success', 'Cập nhật trạng thái thành công!');
    }

    public function report()
    {
        // Lấy số liệu tổng hợp
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 'completed')->sum('total');
        $pendingOrders = Order::where('status', 'pending')->count();
        $cancelledOrders = Order::where('status', 'cancelled')->count();

        // Thống kê theo tháng (doanh thu trong 6 tháng gần nhất)
        $monthlyRevenue = Order::selectRaw('MONTH(created_at) as month, SUM(total) as revenue')
            ->where('status', 'completed')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('admin.report', compact('totalOrders', 'totalRevenue', 'pendingOrders', 'cancelledOrders', 'monthlyRevenue'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();

        // Nếu admin chỉnh sang "Hoàn thành" thì cập nhật giỏ hàng (order_items)
        if ($order->status === 'Hoàn thành') {
            foreach ($order->items as $item) {
                // ví dụ: cập nhật trạng thái trong bảng order_items (nếu có)
                $item->update(['status' => 'Hoàn thành']);
            }
        }

        return redirect()->route('admin.orders.index')
            ->with('success', 'Cập nhật trạng thái thành công!');
    }



    // Xóa đơn hàng
    public function destroy(Order $order)
    {
        // Nếu đơn chưa hủy thì hoàn stock trước khi xóa
        if ($order->status !== 'cancelled') {
            foreach ($order->items as $item) {
                if ($item->product) {
                    $item->product->stock += $item->quantity;
                    $item->product->save();
                }
            }
        }

        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Xóa đơn hàng thành công!');
    }

    public function store(Request $request)
    {
        $cart = session('cart', []);
        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
        // 1. Tạo order như bạn đang làm
        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $total,
            'status' => 'paid',
            'payment_method' => $request->payment_method, // COD / online
        ]);

        // 2. Tạo payment record
        Payment::create([
            'order_id' => $order->id,
            'amount' => $order->total,
            'payment_method' => $order->payment_method,
        ]);

        return redirect()->route('orders.index')->with('success', 'Đặt hàng thành công!');
    }

    public function myOrders()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        return view('orders.my', compact('orders'));
    }

    public function invoice(Order $order)
    {
        $order->load('items.product'); // không load 'user' nếu không có quan hệ user
        return view('orders.invoice', compact('order')); // trỏ tới orders.invoice
    }


    public function cancel(Order $order)
    {
        if ($order->user_id !== Auth::id() || $order->status !== 'pending') {
            return back()->with('error', 'Bạn không thể hủy đơn này!');
        }
        $order->status = 'cancelled';
        $order->save();

        // Hoàn lại tồn kho
        foreach ($order->items as $item) {
            if ($item->product) {
                $item->product->stock += $item->quantity;
                $item->product->save();
            }
        }

        return back()->with('success', 'Đã hủy đơn hàng!');
    }
}
