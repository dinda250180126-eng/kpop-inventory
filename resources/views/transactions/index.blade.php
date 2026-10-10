@extends('app')
@section('title', 'Riwayat Transaksi Stok')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
    <h2>🔄 Riwayat Mutasi Stok Barang</h2>
    <a href="{{ route('transactions.create') }}" class="btn btn-primary">+ Catat Mutasi Baru</a>
</div>

<div style="background: white; border-radius: 8px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0; color: #475569; font-size: 14px;">
                <th style="padding: 12px 16px;">Tanggal</th>
                <th style="padding: 12px 16px;">Nama Merchandise</th>
                <th style="padding: 12px 16px;">Jenis</th>
                <th style="padding: 12px 16px;">Jumlah</th>
                <th style="padding: 12px 16px;">Catatan</th>
                <th style="padding: 12px 16px;">Petugas</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $t)
                <tr style="border-bottom: 1px solid #f1f5f9; font-size: 14px;">
                    <td style="padding: 12px 16px; color: #64748b;">{{ $t->created_at->format('d M Y, H:i') }}</td>
                    <td style="padding: 12px 16px; font-weight: 600;">{{ $t->product->name ?? 'Produk Dihapus' }}</td>
                    <td style="padding: 12px 16px;">
                        @if($t->type === 'in')
                            <span class="badge" style="background: #dcfce7; color: #166534;">Masuk (Restock)</span>
                        @else
                            <span class="badge" style="background: #fee2e2; color: #991b1b;">Keluar (Terjual)</span>
                        @endif
                    </td>
                    <td style="padding: 12px 16px; font-weight: bold; color: {{ $t->type === 'in' ? '#16a34a' : '#dc2626' }};">
                        {{ $t->type === 'in' ? '+' : '-' }}{{ $t->quantity }} pcs
                    </td>
                    <td style="padding: 12px 16px; color: #475569;">{{ $t->notes ?? '-' }}</td>
                    <td style="padding: 12px 16px; color: #64748b;">{{ $t->user->name ?? 'Sistem' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: #94a3b8; padding: 32px;">Belum ada riwayat transaksi mutasi stok.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 20px;">
    {{ $transactions->links() }}
</div>
@endsection