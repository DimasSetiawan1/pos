@extends('layouts.app')
@section('title', 'Riwayat Transaksi')
@section('page-title', 'Riwayat Transaksi')

@section('content')
<div class="content-card">
    <div class="content-card-header">
        <h6><i class="bi bi-clock-history me-2"></i>Riwayat Transaksi Saya</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr><th>Invoice</th><th>Metode</th><th>Total</th><th>Bayar</th><th>Kembali</th><th>Tanggal</th><th>Detail</th></tr>
            </thead>
            <tbody>
                @forelse($transaksi as $t)
                <tr>
                    <td class="fw-semibold">{{ $t->invoice }}</td>
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

                <!-- Modal Detail -->
                <div class="modal fade" id="modalDetail{{ $t->id }}" tabindex="-1">
                    <div class="modal-dialog modal-lg"><div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Detail — {{ $t->invoice }}</h5>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
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
                    </div></div>
                </div>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-5">Belum ada transaksi</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-3">{{ $transaksi->links() }}</div>
</div>
@endsection
