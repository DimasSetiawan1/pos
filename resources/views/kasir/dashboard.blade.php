@extends('layouts.app')
@section('title', 'Dashboard Kasir')
@section('page-title', 'Dashboard Kasir')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon" style="background:#e8f5e9;">📦</div>
            <div class="stat-value">{{ $produk }}</div>
            <div class="stat-label">Total Produk Tersedia</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon" style="background:#e3f2fd;">🧾</div>
            <div class="stat-value">{{ $transaksi_hari_ini }}</div>
            <div class="stat-label">Transaksi Hari Ini</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon" style="background:#fff3e0;">💰</div>
            <div class="stat-value" style="font-size:1.3rem;">Rp {{ number_format($pendapatan_hari_ini,0,',','.') }}</div>
            <div class="stat-label">Pendapatan Hari Ini</div>
        </div>
    </div>
</div>

<div class="content-card">
    <div class="content-card-header">
        <h6><i class="bi bi-clock-history me-2"></i>Transaksi Terbaru Hari Ini</h6>
        <a href="/kasir/transaksi" class="btn btn-coffee btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Transaksi Baru
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead><tr><th>Invoice</th><th>Total</th><th>Bayar</th><th>Kembali</th><th>Waktu</th></tr></thead>
            <tbody>
                @forelse($riwayat as $t)
                <tr>
                    <td class="fw-semibold">{{ $t->invoice }}</td>
                    <td>Rp {{ number_format($t->total,0,',','.') }}</td>
                    <td>Rp {{ number_format($t->bayar,0,',','.') }}</td>
                    <td>Rp {{ number_format($t->kembali,0,',','.') }}</td>
                    <td><small class="text-muted">{{ $t->created_at->format('H:i') }}</small></td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-4">Belum ada transaksi hari ini</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection