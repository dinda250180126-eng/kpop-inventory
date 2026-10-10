<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalSuppliers = Supplier::count();
        $totalStock = Product::sum('stock');
        
        // Produk dengan stok menipis (di bawah 10)
        $lowStockProducts = Product::where('stock', '<=', 10)->get();

        return view('dashboard', compact(
            'totalProducts', 
            'totalCategories', 
            'totalSuppliers', 
            'totalStock', 
            'lowStockProducts'
        ));
    }
}