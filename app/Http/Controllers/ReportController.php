<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        // Lấy danh mục để filter
        $categories = Category::orderBy('name')->get(['id', 'name']);

        return view('reports.index', compact('categories'));
    }

    public function filter(Request $request)
    {
        $query = Order::query();

        // lọc theo 1 ngày
        if ($request->date) {
            $query->whereDate('created_at', $request->date);
        }

        // lọc theo tháng
        if ($request->month && $request->year) {
            $query->whereYear('created_at', $request->year)
                ->whereMonth('created_at', $request->month);
        }

        // lọc theo năm
        if ($request->year && !$request->month) {
            $query->whereYear('created_at', $request->year);
        }

        // lọc theo payment
        if ($request->payment_method) {
            $query->where('payment_method', $request->payment_method);
        }

        // lọc theo trạng thái
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // lọc theo danh mục
        if ($request->category) {
            $query->whereHas('items.product', function ($q) use ($request) {
                $q->where('category_id', $request->category);
            });
        }

        $data = $query->selectRaw("DATE(created_at) as day, COUNT(*) as orders_count, SUM(total) as revenue")
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        return response()->json([
            'labels'   => $data->pluck('day')->map(fn($d) => \Carbon\Carbon::parse($d)->format('d/m')),
            'revenues' => $data->pluck('revenue'),
            'rows'     => $data
        ]);
    }


    public function print(Request $request)
    {
        $query = Order::query();

        if ($request->date) {
            $query->whereDate('created_at', $request->date);
        }
        if ($request->month) {
            $query->whereMonth('created_at', $request->month);
        }
        if ($request->year) {
            $query->whereYear('created_at', $request->year);
        }
        if ($request->payment_method) {
            $query->where('payment_method', $request->payment_method);
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->category) {
            $query->whereHas('items.product', function ($q) use ($request) {
                $q->where('category_id', $request->category);
            });
        }

        $data = $query->selectRaw("DATE(created_at) as day, COUNT(*) as orders_count, SUM(total) as revenue")
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        // 🟢 Xử lý filters hiển thị đẹp
        $filters = $request->all();
        if ($request->category) {
            $cat = \App\Models\Category::find($request->category);
            $filters['category'] = $cat ? $cat->name : $request->category;
        }

        return view('reports.print', compact('data', 'filters'));
    }
}
