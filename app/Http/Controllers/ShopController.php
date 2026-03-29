<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        // Lấy danh sách danh mục để hiển thị dropdown
        $categories = Category::all();

        // Query sản phẩm
        $query = Product::query()->with('category');

        // Nếu có filter category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Nếu có filter tìm kiếm theo tên
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Phân trang
        $products = $query->paginate(8)->withQueryString();
        return view('shop.index', compact('products', 'categories'));
    }
}
