@extends('app')
@section('title', 'Dashboard Inventory')

@section('content')
<h2 style="margin-bottom: 24px;">📊 Dashboard Statistik & Laporan Inventory</h2>

<!-- Kartu Ringkasan Statistik -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 30px;">
    <div style="background: white; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
        <div style="font-size: 13px; color: #64748b; font-weight: 600;">TOTAL PRODUK</div>
        <div style="font-size: 28px; font-weight: bold; color: #0f172a; margin-top: 8px;">{{ $totalProducts }}</div>
    </div>
    
    <div style="background: white; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
        <div style="font-size: 13px; color: #64748b; font-weight: 600;">TOTAL SEMUA STOK</div>
        <div style="font-size: 28px; font-weight: bold; color: #0f172a; margin-top: 8px;">{{ $totalStock }} <span style="font-size: 16px; font-weight: normal; color: #64748b;">pcs</span></div>
    </div>

    <div style="background: white; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
        <div style="font-size: 13px; color: #64748b; font-weight: 600;">TOTAL KATEGORI</div>
        <div style="font-size: 28px; font-weight: bold; color: #0f172a; margin-top: 8px;">{{ $totalCategories }}</div>
    </div>

    <div style="background: white; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
        <div style="font-size: 13px; color: #64748b; font-weight: 600;">TOTAL SUPPLIER</div>
        <div style="font-size: 28px; font-weight: bold; color: #0f172a; margin-top: 8px;">{{ $totalSuppliers }}</div>
    </div>
</div>

<!-- Peringatan Stok Menipis -->
<div style="background: white; padding: 24px; border-radius: 8px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
    <h3 style="margin-top: 0; color: #b91c1c;">⚠️ Peringatan Stok Sedikit (≤ 10 pcs)</h3>
    <table style="width: 100%; border-collapse: collapse; text-align: left; margin-top: 12px;">
        <thead>
            <tr style="border-bottom: 2px solid #e2e8f0; color: #475569; font-size: 14px;">
                <th style="padding: 10px;">Nama Merchandise</th>
                <th style="padding: 10px;">Kategori</th>
                <th style="padding: 10px;">Sisa Stok</th>
                <th style="padding: 10px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($lowStockProducts as $low)
                <tr style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 10px; font-weight: 600;">{{ $low->name }}</td>
                    <td style="padding: 10px; color: #64748b;">{{ $low->category }}</td>
                    <td style="padding: 10px; color: #dc2626; font-weight: bold;">{{ $low->stock }} pcs</td>
                    <td style="padding: 10px;">
                        <a href="{{ route('products.edit', $low) }}" class="btn btn-secondary" style="padding: 4px 10px; font-size: 12px;">Restock / Edit</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center; color: #16a34a; padding: 16px;">
                        Semua stok barang aman di atas 10 pcs.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection