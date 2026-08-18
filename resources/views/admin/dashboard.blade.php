@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')

@push('styles')
<style>
    .dash-card {
        background: white;
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        border: 1px solid rgba(0,0,0,0.02);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    .dash-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(111,78,55,0.15);
        border-color: var(--coffee-medium);
    }
    .dash-icon-wrap {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        margin-bottom: 16px;
    }
    .val-text {
        font-size: 1.7rem;
        font-weight: 800;
        color: var(--coffee-dark);
        margin-bottom: 4px;
    }
    .label-text {
        font-size: 0.9rem;
        font-weight: 600;
        color: #888;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .bg-gradient-1 { background: linear-gradient(135deg, #e3f2fd, #bbdefb); color: #1565c0; }
    .bg-gradient-2 { background: linear-gradient(135deg, #e8f5e9, #c8e6c9); color: #2e7d32; }
    .bg-gradient-3 { background: linear-gradient(135deg, #fff3e0, #ffe0b2); color: #ef6c00; }
    .bg-gradient-4 { background: linear-gradient(135deg, #fce4ec, #f8bbd0); color: #c2185b; }
    
    .panel-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        border: none;
        overflow: hidden;
    }
    .panel-header {
        padding: 20px 24px;
        border-bottom: 1px solid #f5ede3;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #faf6f2;
    }
    .panel-header h6 {
        margin: 0;
        font-weight: 700;
        color: var(--coffee-dark);
        font-size: 1.1rem;
    }
</style>
@endpush

@section('content')
<div class="d-flex align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1" style="color: var(--coffee-dark);">👋 Selamat Datang, Admin!</h4>
        <p class="text-muted mb-0">Berikut adalah ringkasan performa Blok Barat Coffee hari ini.</p>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-3 col-sm-6">
        <a href="/admin/laporan/harian" class="text-decoration-none">
            <div class="dash-card">
                <div class="dash-icon-wrap bg-gradient-1"><i class="bi bi-calendar-event"></i></div>
                <div class="val-text">Rp {{ number_format($harian, 0, ',', '.') }}</div>
                <div class="label-text">Pendapatan Harian</div>
                <div style="position: absolute; right: -20px; bottom: -20px; font-size: 6rem; opacity: 0.05; transform: rotate(-15deg);"><i class="bi bi-calendar-event"></i></div>
            </div>
        </a>
    </div>
    <div class="col-md-3 col-sm-6">
        <a href="/admin/laporan/mingguan" class="text-decoration-none">
            <div class="dash-card">
                <div class="dash-icon-wrap bg-gradient-2"><i class="bi bi-calendar-week"></i></div>
                <div class="val-text">Rp {{ number_format($mingguan, 0, ',', '.') }}</div>
                <div class="label-text">Pendapatan Mingguan</div>
                <div style="position: absolute; right: -20px; bottom: -20px; font-size: 6rem; opacity: 0.05; transform: rotate(-15deg);"><i class="bi bi-calendar-week"></i></div>
            </div>
        </a>
    </div>
    <div class="col-md-3 col-sm-6">
        <a href="/admin/laporan/bulanan" class="text-decoration-none">
            <div class="dash-card">
                <div class="dash-icon-wrap bg-gradient-3"><i class="bi bi-calendar-month"></i></div>
                <div class="val-text">Rp {{ number_format($bulanan, 0, ',', '.') }}</div>
                <div class="label-text">Pendapatan Bulanan</div>
                <div style="position: absolute; right: -20px; bottom: -20px; font-size: 6rem; opacity: 0.05; transform: rotate(-15deg);"><i class="bi bi-calendar-month"></i></div>
            </div>
        </a>
    </div>
    <div class="col-md-3 col-sm-6">
        <a href="/admin/laporan/tahunan" class="text-decoration-none">
            <div class="dash-card">
                <div class="dash-icon-wrap bg-gradient-4"><i class="bi bi-graph-up-arrow"></i></div>
                <div class="val-text">Rp {{ number_format($tahunan, 0, ',', '.') }}</div>
                <div class="label-text">Pendapatan Tahunan</div>
                <div style="position: absolute; right: -20px; bottom: -20px; font-size: 6rem; opacity: 0.05; transform: rotate(-15deg);"><i class="bi bi-graph-up-arrow"></i></div>
            </div>
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-7">
        <div class="panel-card">
            <div class="panel-header">
                <h6><i class="bi bi-star-fill me-2 text-warning"></i>Produk Terlaris</h6>
            </div>
            <div class="p-0">
                <div class="list-group list-group-flush border-0">
                    @forelse($produk_terlaris as $item)
                    <div class="list-group-item d-flex justify-content-between align-items-center p-3 border-bottom" style="transition: background 0.2s; cursor: default;" onmouseover="this.style.background='#faf6f2'" onmouseout="this.style.background='transparent'">
                        <div class="d-flex align-items-center">
                            @php $slug = Str::slug($item->product->nama_produk ?? ''); @endphp
                            <div class="me-3" style="width: 50px; height: 50px;">
                                <img src="/images/products/{{ $slug }}.jpg" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($item->product->nama_produk ?? 'P') }}&background=6f4e37&color=fff&size=150'" class="rounded-3 w-100 h-100 shadow-sm" style="object-fit:cover; border: 1px solid #f0e8e0;" alt="{{ $item->product->nama_produk ?? '' }}">
                            </div>
                            <div>
                                <h6 class="mb-1 fw-bold text-dark" style="font-size: 1.05rem;">{{ $item->product->nama_produk ?? 'Produk Dihapus' }}</h6>
                                <span class="badge bg-light text-secondary border fw-semibold">{{ $item->product->kategori ?? 'Umum' }}</span>
                            </div>
                        </div>
                        <div class="text-end">
                            <div class="fw-bold mb-1" style="color: var(--coffee-dark); font-size: 1.15rem;">{{ $item->total_terjual }} <span style="font-size: 0.9rem; font-weight: normal;">Terjual</span></div>
                            <small class="text-muted">Total Penjualan</small>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-5">
                        <i class="bi bi-basket2 text-muted" style="font-size: 2.5rem; opacity: 0.5;"></i>
                        <p class="mt-2 mb-0 text-muted fw-semibold">Belum ada data penjualan</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-5">
        <div class="panel-card h-100">
            <div class="panel-header">
                <h6><i class="bi bi-exclamation-triangle-fill me-2 text-warning"></i>Peringatan Stok</h6>
            </div>
            <div class="p-0">
                <div class="list-group list-group-flush border-0">
                    @forelse($stok_rendah as $p)
                    <div class="list-group-item d-flex justify-content-between align-items-center p-3 border-bottom" style="transition: background 0.2s;" onmouseover="this.style.background='#faf6f2'" onmouseout="this.style.background='transparent'">
                        <div class="d-flex align-items-center">
                            <div class="rounded-4 d-flex align-items-center justify-content-center me-3 {{ $p->stok == 0 ? 'bg-danger-subtle text-danger' : 'bg-warning-subtle text-warning' }}" style="width: 50px; height: 50px; font-size: 1.4rem;">
                                <i class="bi {{ $p->stok == 0 ? 'bi-x-circle-fill' : 'bi-exclamation-triangle-fill' }}"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 fw-bold text-dark" style="font-size: 1.05rem;">{{ $p->nama_produk }}</h6>
                                <span class="text-muted small">Stok tersisa: <strong class="{{ $p->stok == 0 ? 'text-danger' : 'text-warning' }} fs-6">{{ $p->stok }}</strong></span>
                            </div>
                        </div>
                        <div>
                            @if($p->stok == 0)
                                <span class="badge bg-danger rounded-pill px-3 py-2 shadow-sm">Habis!</span>
                            @else
                                <span class="badge bg-warning text-dark rounded-pill px-3 py-2 shadow-sm">Menipis</span>
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-5">
                        <div class="bg-success-subtle rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="bi bi-check2-all text-success" style="font-size: 2rem;"></i>
                        </div>
                        <h6 class="fw-bold text-success">Semua Stok Aman</h6>
                        <p class="text-muted small mb-0">Tidak ada produk yang stoknya menipis.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection