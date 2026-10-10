<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()->with('suppliers');

        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $sort = $request->get('sort', 'latest');
        match ($sort) {
            'price_asc'  => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'stock_asc'  => $query->orderBy('stock', 'asc'),
            'stock_desc' => $query->orderBy('stock', 'desc'),
            default      => $query->latest(),
        };

        $products = $query->paginate(8)->withQueryString();
        $categories = Category::all();
        $q = $request->q;
        $cat = $request->category;

        return view('products.index', compact('products', 'categories', 'q', 'cat', 'sort'));
    }

    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('products.create', compact('categories', 'suppliers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'suppliers'   => 'nullable|array',
            'suppliers.*' => 'exists:suppliers,id',
        ]);

        $category = Category::findOrFail($request->category_id);

        $product = Product::create([
            'name'     => $validated['name'],
            'category' => $category->name,
            'price'    => $validated['price'],
            'stock'    => $validated['stock'],
        ]);

        if (!empty($validated['suppliers'])) {
            $product->suppliers()->sync($validated['suppliers']);
        }

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function show(Product $product)
    {
        $product->load('suppliers');
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        $product->load('suppliers');
        return view('products.edit', compact('product', 'categories', 'suppliers'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'suppliers'   => 'nullable|array',
            'suppliers.*' => 'exists:suppliers,id',
        ]);

        $category = Category::findOrFail($request->category_id);

        $product->update([
            'name'     => $validated['name'],
            'category' => $category->name,
            'price'    => $validated['price'],
            'stock'    => $validated['stock'],
        ]);

        $product->suppliers()->sync($validated['suppliers'] ?? []);

        return redirect()->route('products.index')->with('success', 'Data produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        $product->suppliers()->detach();
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }
}