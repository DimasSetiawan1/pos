@extends('layouts.app')
@section('title', 'Riwayat Transaksi')
@section('page-title', 'Riwayat Transaksi')

@section('content')
<h5 class="fw-bold mb-3" style="color: var(--coffee-dark);"><i class="bi bi-graph-up me-2"></i>Laporan Transaksi (Keseluruhan)</h5>
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card p-4 rounded-4 shadow-sm border-0 bg-white" style="transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
            <div class="d-flex align-items-center">
                <div class="stat-icon p-3 rounded-circle" style="background:#e8f5e9; font-size: 1.5rem;">🧾</div>
                <div class="ms-3">
                    <div class="stat-label text-muted fw-semibold small">Total Transaksi</div>
                    <div class="stat-value fw-bold fs-4" style="color: var(--coffee-dark);">{{ $total_transaksi }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card p-4 rounded-4 shadow-sm border-0 bg-white" style="transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
            <div class="d-flex align-items-center">
                <div class="stat-icon p-3 rounded-circle" style="background:#fff3e0; font-size: 1.5rem;">💰</div>
                <div class="ms-3">
                    <div class="stat-label text-muted fw-semibold small">Total Pendapatan</div>
                    <div class="stat-value fw-bold fs-4" style="color: var(--coffee-dark);">Rp {{ number_format($total_pendapatan,0,',','.') }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card p-4 rounded-4 shadow-sm border-0 bg-white" style="transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
            <div class="d-flex align-items-center">
                <div class="stat-icon p-3 rounded-circle" style="background:#e3f2fd; font-size: 1.5rem;">📅</div>
                <div class="ms-3">
                    <div class="stat-label text-muted fw-semibold small">Transaksi Hari Ini</div>
                    <div class="stat-value fw-bold fs-4" style="color: var(--coffee-dark);">{{ $transaksi_hari_ini }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<h5 class="fw-bold mb-3 mt-4" style="color: var(--coffee-dark);"><i class="bi bi-cash-coin me-2"></i>Laporan Keuangan (Bulan Ini)</h5>
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card p-4 rounded-4 shadow-sm border-0 bg-white" style="transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
            <div class="d-flex align-items-center">
                <div class="stat-icon p-3 rounded-circle" style="background:#fff3e0; font-size: 1.5rem;">📈</div>
                <div class="ms-3">
                    <div class="stat-label text-muted fw-semibold small">Pendapatan Bulan Ini</div>
                    <div class="stat-value fw-bold fs-4" style="color: #198754;">Rp {{ number_format($pendapatan_bulan_ini,0,',','.') }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card p-4 rounded-4 shadow-sm border-0 bg-white" style="transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
            <div class="d-flex align-items-center">
                <div class="stat-icon p-3 rounded-circle" style="background:#ffebee; font-size: 1.5rem;">📉</div>
                <div class="ms-3">
                    <div class="stat-label text-muted fw-semibold small">Pengeluaran (HPP)</div>
                    <div class="stat-value fw-bold fs-4" style="color: #dc3545;">Rp {{ number_format($pengeluaran_bulan_ini,0,',','.') }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card p-4 rounded-4 shadow-sm border-0 bg-white" style="transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
            <div class="d-flex align-items-center">
                <div class="stat-icon p-3 rounded-circle" style="background:#e8f5e9; font-size: 1.5rem;">💸</div>
                <div class="ms-3">
                    <div class="stat-label text-muted fw-semibold small">Keuntungan Bersih</div>
                    <div class="stat-value fw-bold fs-4" style="color: #0d6efd;">Rp {{ number_format($keuntungan_bulan_ini,0,',','.') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-card">
    <div class="content-card-header">
        <h6><i class="bi bi-receipt me-2"></i>Semua Transaksi</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr><th>Invoice</th><th>Kasir</th><th>Metode</th><th>Total</th><th>Bayar</th><th>Kembali</th><th>Waktu</th><th>Detail</th></tr>
            </thead>
            <tbody>
                @forelse($transaksi as $t)
                <tr>
                    <td><span class="fw-semibold text-coffee">{{ $t->invoice }}</span></td>
                    <td>{{ $t->kasir->name ?? '-' }}</td>
                    <td>
                        @php
                            $metode = $t->metode_pembayaran ?? 'cash';
                            $badge = ['cash'=>'bg-success','qris'=>'bg-primary','transfer'=>'bg-info text-dark','kartu'=>'bg-warning text-dark'];
                            $icon  = ['cash'=>'💵','qris'=>'📱','transfer'=>'🏦','kartu'=>'💳'];
                            $label = ['cash'=>'Cash','qris'=>'QRIS','transfer'=>'Transfer','kartu'=>'Kartu'];
                        @endphp
                        <span class="badge {{ $badge[$metode] ?? 'bg-secondary' }}">
                            {{ $icon[$metode] ?? '' }} {{ $label[$metode] ?? ucfirst($metode) }}
                        </span>
                    </td>
                    <td>Rp {{ number_format($t->total,0,',','.') }}</td>
                    <td>Rp {{ number_format($t->bayar,0,',','.') }}</td>
                    <td>Rp {{ number_format($t->kembali,0,',','.') }}</td>
                    <td><small class="text-muted">{{ $t->created_at->format('d M Y H:i') }}</small></td>
                    <td>
                        <button class="btn btn-sm btn-outline-secondary"
                            data-bs-toggle="modal" data-bs-target="#modalDetail{{ $t->id }}">
                            <i class="bi bi-eye"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-5">Belum ada transaksi</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-3">{{ $transaksi->links() }}</div>
</div>

<!-- Render Modals Outside the Table -->
@foreach($transaksi as $t)
<!-- Modal Detail -->
<div class="modal fade" id="modalDetail{{ $t->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg"><div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Detail — {{ $t->invoice }}</h5>
            <button class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr><th>Produk</th><th>Qty</th><th>Harga</th><th>Subtotal</th></tr>
                    </thead>
                    <tbody>
                        @foreach($t->details as $d)
                        <tr>
                            <td>{{ $d->product->nama_produk ?? '-' }}</td>
                            <td>{{ $d->qty }}</td>
                            <td>Rp {{ number_format($d->harga,0,',','.') }}</td>
                            <td>Rp {{ number_format($d->subtotal,0,',','.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="table-warning">
                            <td colspan="3" class="fw-bold text-end">TOTAL</td>
                            <td class="fw-bold">Rp {{ number_format($t->total,0,',','.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div></div>
</div>
@endforeach

@endsection
