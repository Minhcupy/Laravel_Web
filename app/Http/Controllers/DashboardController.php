<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Promotion;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'products'   => Product::count(),
            'categories' => Category::count(),
            'users'      => User::count(),
            'promotions' => Promotion::count(),
        ]);
    }
}
