<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // ================== ADMIN: Danh sách sản phẩm ==================
    public function index()
    {
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    // ================== SHOP: Trang khách hàng ==================
    public function shopIndex(Request $request)
    {
        $categories = Category::all();

        $query = Product::with('promotion', 'category');

        // Lọc theo category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Lọc theo search
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->paginate(8)->withQueryString();

        return view('shop.index', compact('products', 'categories'));
    }



    // ================== ADMIN: Form tạo sản phẩm ==================
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    // ================== ADMIN: Lưu sản phẩm mới ==================
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0', // ✅ Thêm validate stock
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Upload ảnh nếu có
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product created.');
    }

    // ================== Xem chi tiết sản phẩm ==================
    public function show($id)
    {
        $product = Product::with(['category', 'reviews.user'])->findOrFail($id);

        // Tính trung bình & tổng
        $average = round($product->reviews()->avg('rating'), 2);
        $total = $product->reviews()->count();

        // Thống kê số sao
        $ratingStats = $product->reviews()
            ->selectRaw('rating, COUNT(*) as count')
            ->groupBy('rating')
            ->pluck('count', 'rating');

        return view('products.show', compact('product', 'average', 'total', 'ratingStats'));
    }


    // ================== ADMIN: Form chỉnh sửa sản phẩm ==================
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    // ================== ADMIN: Cập nhật sản phẩm ==================
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0', // ✅ Thêm validate stock
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Nếu có ảnh mới → xóa ảnh cũ
        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    // ================== ADMIN: Xóa sản phẩm ==================
    public function destroy(Product $product)
    {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted.');
    }
}
