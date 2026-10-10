<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockTransactionController extends Controller
{
    public function index()
    {
        $transactions = StockTransaction::with(['product', 'user'])
            ->latest()
            ->paginate(10);

        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $products = Product::orderBy('name', 'asc')->get();
        return view('transactions.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type'       => 'required|in:in,out',
            'quantity'   => 'required|integer|min:1',
            'notes'      => 'nullable|string|max:255',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($request->type === 'out' && $product->stock < $request->quantity) {
            return back()->withErrors(['quantity' => 'Stok tidak mencukupi! Sisa stok saat ini: ' . $product->stock . ' pcs'])->withInput();
        }

        DB::transaction(function () use ($request, $product) {
            StockTransaction::create([
                'product_id' => $product->id,
                'user_id'    => Auth::id(),
                'type'       => $request->type,
                'quantity'   => $request->quantity,
                'notes'      => $request->notes,
            ]);

            if ($request->type === 'in') {
                $product->increment('stock', $request->quantity);
            } else {
                $product->decrement('stock', $request->quantity);
            }
        });

        return redirect()->route('transactions.index')->with('success', 'Transaksi mutasi stok berhasil dicatat!');
    }
}