@extends('app')
@section('title', 'Edit Produk')

@section('content')
<div style="max-width: 500px; margin: 0 auto; background: white; padding: 24px; border-radius: 8px; border: 1px solid #e2e8f0;">
    <h2 style="margin-top: 0;">Edit Data Produk</h2>

    <form method="POST" action="{{ route('products.update', $product) }}">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 16px;">
            <label style="display: block; font-weight: bold; margin-bottom: 6px;">Nama Produk *</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" style="width: 100%; box-sizing: border-box; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 6px;" required>
        </div>

        <div style="margin-bottom: 16px;">
            <label style="display: block; font-weight: bold; margin-bottom: 6px;">Kategori *</label>
            <select name="category_id" style="width: 100%; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 6px;">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 16px;">
            <label style="display: block; font-weight: bold; margin-bottom: 6px;">Harga (Rp) *</label>
            <input type="number" name="price" value="{{ old('price', $product->price) }}" style="width: 100%; box-sizing: border-box; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 6px;" required>
        </div>

        <div style="margin-bottom: 16px;">
            <label style="display: block; font-weight: bold; margin-bottom: 6px;">Stok *</label>
            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" style="width: 100%; box-sizing: border-box; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 6px;" required>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: bold; margin-bottom: 6px;">Supplier</label>
            @foreach($suppliers as $sup)
                <div style="margin-bottom: 4px;">
                    <label style="font-weight: normal;">
                        <input type="checkbox" name="suppliers[]" value="{{ $sup->id }}" {{ $product->suppliers->contains($sup->id) ? 'checked' : '' }}> 
                        {{ $sup->name }}
                    </label>
                </div>
            @endforeach
        </div>

        <div style="display: flex; gap: 8px;">
            <button type="submit" class="btn btn-primary" style="flex: 1;">Update Data</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection