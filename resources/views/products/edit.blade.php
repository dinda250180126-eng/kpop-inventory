<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <style>
        body { font-family: system-ui, sans-serif; background: #f8fafc; padding: 20px; }
        .form-card { max-width: 500px; margin: 0 auto; background: white; padding: 24px; border-radius: 8px; border: 1px solid #e2e8f0; }
        .form-group { margin-bottom: 16px; }
        label { display: block; margin-bottom: 6px; font-weight: 500; font-size: 14px; }
        input { width: 100%; box-sizing: border-box; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 6px; }
        .error { color: #ef4444; font-size: 13px; margin-top: 4px; }
        .btn { padding: 8px 16px; border-radius: 6px; border: none; cursor: pointer; text-decoration: none; font-weight: 500; }
        .btn-primary { background: #3b82f6; color: white; }
        .btn-secondary { background: #e2e8f0; color: #334155; }
    </style>
</head>
<body>
<div class="form-card">
    <h2 style="margin-top: 0;">✏️ Edit Produk #{{ $product->id }}</h2>

    <form method="POST" action="{{ route('products.update', $product) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nama Produk *</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" required>
            @error('name') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Kategori</label>
            <input type="text" name="category" value="{{ old('category', $product->category) }}" required>
            @error('category') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Harga (Rp) *</label>
            <input type="number" name="price" value="{{ old('price', (int)$product->price) }}" min="1" required>
            @error('price') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Jumlah Stok *</label>
            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" min="0" required>
            @error('stock') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div style="display: flex; gap: 8px; margin-top: 24px;">
            <button type="submit" class="btn btn-primary" style="flex: 1;">Perbarui Data</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
</body>
</html>