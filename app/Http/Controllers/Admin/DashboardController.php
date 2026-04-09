<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $heroCount = Hero::count();
        $categoryCount = Category::count();
        $productCount = Product::count();

        return view('admin.dashboard', compact('heroCount', 'categoryCount', 'productCount'));
    }
}
