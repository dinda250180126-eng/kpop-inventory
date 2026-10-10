@extends('app')
@section('title', 'Catat Mutasi Stok')

@section('content')
<div style="max-width: 500px; margin: 0 auto; background: white; padding: 24px; border-radius: 8px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
    <h2 style="margin-top: 0; margin-bottom: 20px;">Catat Mutasi Stok Baru</h2>

    <form method="POST" action="{{ route('transactions.store') }}">
        @csrf
        
        <div style="margin-bottom: 16px;">
            <label style="display: block; font-weight: bold; margin-bottom: 6px;">Pilih Produk Merchandise *</label>
            <select name="product_id" style="width: 100%; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 6px;" required>
                <option value="">-- Pilih Merchandise --</option>
                @foreach($products as $p)
                    <option value="{{ $p->id }}" {{ old('product_id') == $p->id ? 'selected' : '' }}>
                        {{ $p->name }} (Sisa Stok: {{ $p->stock }} pcs)
                    </option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 16px;">
            <label style="display: block; font-weight: bold; margin-bottom: 6px;">Jenis Mutasi *</label>
            <select name="type" style="width: 100%; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 6px;" required>
                <option value="in" {{ old('type') == 'in' ? 'selected' : '' }}>📥 Masuk (Barang Masuk / Restock)</option>
                <option value="out" {{ old('type') == 'out' ? 'selected' : '' }}>📤 Keluar (Barang Terjual / Berkurang)</option>
            </select>
        </div>

        <div style="margin-bottom: 16px;">
            <label style="display: block; font-weight: bold; margin-bottom: 6px;">Jumlah *</label>
            <input type="number" name="quantity" value="{{ old('quantity', 1) }}" min="1" style="width: 100%; box-sizing: border-box; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 6px;" required>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: bold; margin-bottom: 6px;">Catatan / Keterangan</label>
            <input type="text" name="notes" value="{{ old('notes') }}" placeholder="Contoh: Restock batch 1 / Terjual di pop-up store" style="width: 100%; box-sizing: border-box; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 6px;">
        </div>

        <div style="display: flex; gap: 8px;">
            <button type="submit" class="btn btn-primary" style="flex: 1;">Simpan Mutasi</button>
            <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection