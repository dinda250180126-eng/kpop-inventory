<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'K-Pop Merch Store') - Inventory</title>
    <style>
        * { box-sizing: border-box; font-family: system-ui, -apple-system, sans-serif; }
        body { margin: 0; background: #f8fafc; color: #1e293b; }
        .navbar { background: #0f172a; color: white; padding: 12px 24px; display: flex; justify-content: space-between; align-items: center; }
        .navbar a { color: #94a3b8; text-decoration: none; margin-left: 16px; font-weight: 500; }
        .navbar a:hover, .navbar a.active { color: white; }
        .container { max-width: 1000px; margin: 24px auto; padding: 0 16px; }
        .btn { padding: 8px 14px; border-radius: 6px; font-weight: 500; cursor: pointer; text-decoration: none; border: none; display: inline-block; font-size: 14px; }
        .btn-primary { background: #3b82f6; color: white; }
        .btn-danger { background: #ef4444; color: white; }
        .btn-secondary { background: #e2e8f0; color: #334155; }
        .alert { padding: 12px 16px; border-radius: 6px; margin-bottom: 20px; font-size: 14px; }
        .alert-success { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
        .alert-error { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
        .badge { display: inline-block; padding: 3px 8px; border-radius: 4px; font-size: 12px; font-weight: 600; }
        .badge-admin { background: #fef08a; color: #854d0e; }
        .badge-staff { background: #e0e7ff; color: #3730a3; }
    </style>
</head>
<body>
    <div class="navbar">
        <div style="font-weight: bold; font-size: 16px; color: white;">
            ✨ K-Pop Merch Inventory
        </div>
        <div>
            @auth
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="{{ route('products.index') }}">Produk</a>
                <a href="{{ route('transactions.index') }}">Transaksi Mutasi</a>
                <span style="margin-left: 20px; color: #cbd5e1; font-size: 13px;">
                    {{ Auth::user()->name }} 
                    <span class="badge {{ Auth::user()->role === 'admin' ? 'badge-admin' : 'badge-staff' }}">
                        {{ strtoupper(Auth::user()->role) }}
                    </span>
                </span>
                <form action="{{ route('logout') }}" method="POST" style="display: inline; margin-left: 12px;">
                    @csrf
                    <button type="submit" class="btn btn-secondary" style="padding: 4px 10px; font-size: 12px;">Logout</button>
                </form>
            @endauth
        </div>
    </div>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">✓ {{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-error">
                @foreach($errors->all() as $err)
                    <div>• {{ $err }}</div>
                @endforeach
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>