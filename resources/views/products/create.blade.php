@extends('app')
@section('title', 'Tambah Merchandise Baru')

@section('content')
<div style="max-width: 600px; margin: 0 auto; background: white; padding: 28px; border-radius: 8px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
    <h2 style="margin-top: 0; margin-bottom: 20px;">+ Tambah Merchandise K-Pop Baru</h2>

    <form method="POST" action="{{ route('products.store') }}">
        @csrf

        <div style="margin-bottom: 16px;">
            <label style="display: block; font-weight: 600; margin-bottom: 6px; font-size: 14px;">Nama Produk *</label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Lightstick Ver 3 / Album Photobook" style="width: 100%; box-sizing: border-box; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px;" required autofocus>
        </div>

        <div style="margin-bottom: 16px;">
            <label style="display: block; font-weight: 600; margin-bottom: 6px; font-size: 14px;">Kategori *</label>
            <select name="category_id" style="width: 100%; box-sizing: border-box; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px;" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $c)
                    <option value="{{ $c->id }}" {{ old('category_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                @endforeach
            </select>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 6px; font-size: 14px;">Harga (Rp) *</label>
                <input type="number" name="price" value="{{ old('price') }}" min="0" placeholder="Contoh: 150000" style="width: 100%; box-sizing: border-box; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px;" required>
            </div>
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 6px; font-size: 14px;">Stok Awal *</label>
                <input type="number" name="stock" value="{{ old('stock', 0) }}" min="0" style="width: 100%; box-sizing: border-box; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px;" required>
            </div>
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 6px; font-size: 14px;">Supplier (Bisa pilih lebih dari satu / Many-to-Many)</label>
            <div style="max-height: 140px; overflow-y: auto; border: 1px solid #cbd5e1; padding: 10px; border-radius: 6px; background: #f8fafc;">
                @forelse($suppliers as $sup)
                    <label style="display: flex; align-items: center; gap: 8px; margin-bottom: 6px; font-size: 14px; cursor: pointer;">
                        <input type="checkbox" name="suppliers[]" value="{{ $sup->id }}" {{ in_array($sup->id, old('suppliers', [])) ? 'checked' : '' }}>
                        <span>{{ $sup->name }}</span>
                    </label>
                @empty
                    <span style="font-size: 13px; color: #94a3b8;">Belum ada master supplier.</span>
                @endforelse
            </div>
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn btn-primary" style="flex: 1;">Simpan Produk</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection