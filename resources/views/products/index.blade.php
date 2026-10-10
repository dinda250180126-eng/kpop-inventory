@extends('app')
@section('title', 'Katalog Produk')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2>📦 Master Data Produk</h2>
    <a href="{{ route('products.create') }}" class="btn btn-primary">+ Tambah Produk</a>
</div>

<!-- Search, Filter Kategori & Sorting -->
<form method="GET" action="{{ route('products.index') }}" style="display: flex; gap: 8px; margin-bottom: 24px; flex-wrap: wrap;">
    <input type="text" name="q" placeholder="Cari nama produk..." value="{{ $q ?? '' }}" style="flex: 2; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 6px;">
    
    <select name="category" style="flex: 1; padding: 8px; border: 1px solid #cbd5e1; border-radius: 6px;">
        <option value="">Semua Kategori</option>
        @foreach($categories as $c)
            <option value="{{ $c->name }}" {{ ($cat ?? '') == $c->name ? 'selected' : '' }}>{{ $c->name }}</option>
        @endforeach
    </select>

    <select name="sort" style="flex: 1; padding: 8px; border: 1px solid #cbd5e1; border-radius: 6px;">
        <option value="latest" {{ ($sort ?? '') == 'latest' ? 'selected' : '' }}>Terbaru</option>
        <option value="price_asc" {{ ($sort ?? '') == 'price_asc' ? 'selected' : '' }}>Harga: Termurah</option>
        <option value="price_desc" {{ ($sort ?? '') == 'price_desc' ? 'selected' : '' }}>Harga: Termahal</option>
        <option value="stock_asc" {{ ($sort ?? '') == 'stock_asc' ? 'selected' : '' }}>Stok: Tersedikit</option>
        <option value="stock_desc" {{ ($sort ?? '') == 'stock_desc' ? 'selected' : '' }}>Stok: Terbanyak</option>
    </select>

    <button type="submit" class="btn btn-primary">Filter</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Reset</a>
</form>

<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 16px;">
    @forelse($products as $p)
        <div style="background: white; border: 1px solid #e2e8f0; border-radius: 8px; padding: 16px; display: flex; flex-direction: column; justify-content: space-between; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <div>
                <span class="badge" style="background: #f1f5f9; color: #475569; margin-bottom: 8px;">{{ $p->category }}</span>
                
                <h3 style="margin: 0 0 8px 0; font-size: 16px;">
                    <a href="{{ route('products.show', $p) }}" style="text-decoration: none; color: #0f172a; font-weight: 600;">
                        {{ $p->name }} &rarr;
                    </a>
                </h3>

                <div style="font-size: 18px; font-weight: bold; color: #0f172a; margin-bottom: 8px;">
                    Rp {{ number_format($p->price, 0, ',', '.') }}
                </div>
                <div style="font-size: 13px; color: #64748b;">
                    Stok: <strong>{{ $p->stock }}</strong> pcs
                </div>
                
                <div style="margin-top: 10px; font-size: 12px; color: #64748b;">
                    <strong>Supplier:</strong>
                    @forelse($p->suppliers as $sup)
                        <span style="display: inline-block; background: #e0f2fe; color: #0369a1; padding: 2px 6px; border-radius: 4px; margin-top: 2px;">{{ $sup->name }}</span>
                    @empty
                        <span style="color: #94a3b8;">-</span>
                    @endforelse
                </div>
            </div>

            <div style="display: flex; gap: 8px; margin-top: 16px;">
                <a href="{{ route('products.show', $p) }}" class="btn btn-primary" style="flex: 1; text-align: center;">Lihat Detail</a>
                <a href="{{ route('products.edit', $p) }}" class="btn btn-secondary" style="flex: 1; text-align: center;">Edit</a>
                @if(Auth::user() && Auth::user()->role === 'admin')
                    <form method="POST" action="{{ route('products.destroy', $p) }}" style="flex: 1;" onsubmit="return confirm('Hapus produk ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="width: 100%;">Hapus</button>
                    </form>
                @endif
            </div>
        </div>
    @empty
        <p style="grid-column: 1 / -1; text-align: center; color: #94a3b8; padding: 40px;">Tidak ada produk ditemukan.</p>
    @endforelse
</div>

<div style="margin-top: 24px;">
    {{ $products->links() }}
</div>
@endsection