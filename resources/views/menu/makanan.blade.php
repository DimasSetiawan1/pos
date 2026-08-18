@extends('layouts.app')
@section('title', 'Menu Makanan')
@section('page-title', 'Menu Makanan')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h4 class="fw-bold" style="color: var(--coffee-dark);">📋 Daftar Menu Makanan</h4>
        <p class="text-muted small">Daftar makanan yang tersedia di Blok Barat Coffee. Gunakan pencarian untuk mencari menu dengan cepat.</p>
    </div>
    <div class="col-md-4">
        <form action="/menu-makanan" method="GET" class="d-flex gap-2">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 text-muted">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Cari makanan..." value="{{ $search }}">
            </div>
            @if($search)
                <a href="/menu-makanan" class="btn btn-secondary"><i class="bi bi-x-lg"></i></a>
            @endif
            <button type="submit" class="btn btn-coffee">Cari</button>
        </form>
        @if(in_array(Auth::user()->role, ['admin', 'kasir']))
            <button class="btn btn-coffee ms-2" data-bs-toggle="modal" data-bs-target="#modalTambahMakanan">
                <i class="bi bi-plus-lg me-1"></i> Tambah Makanan
            </button>
        @endif
    </div>
</div>

<div class="row g-4">
    @forelse($makanan as $item)
    <div class="col-md-4 col-sm-6">
        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative" style="transition: transform 0.2s, box-shadow 0.2s; background: white;">
            <!-- Badge Ketersediaan -->
            <div class="position-absolute top-0 end-0 m-3 z-3">
                @if($item->stok > 0)
                    <span class="badge bg-success px-3 py-2 rounded-pill shadow-sm"><i class="bi bi-check-circle me-1"></i> Tersedia</span>
                @else
                    <span class="badge bg-danger px-3 py-2 rounded-pill shadow-sm"><i class="bi bi-x-circle me-1"></i> Habis</span>
                @endif
            </div>

            <!-- Bagian Atas Card / Foto Produk -->
            @php
                $slug = Str::slug($item->nama_produk);
            @endphp
            <div class="ratio ratio-16x9 d-flex align-items-center justify-content-center" 
                 style="background: linear-gradient(135deg, var(--coffee-cream) 0%, #e8ddd5 100%); position: relative;">
                 <img src="/images/products/{{ $slug }}.jpg?v={{ time() }}" 
                      onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($item->nama_produk) }}&background=d35400&color=fff&size=150'" 
                      class="img-fluid w-100 h-100" style="object-fit:cover;" alt="{{ $item->nama_produk }}">
                 <div class="position-absolute bottom-0 start-0 m-2">
                     <span class="badge badge-coffee shadow-sm px-3 py-1 rounded-pill">{{ $item->kode_produk }}</span>
                 </div>
            </div>

            <!-- Konten Detail Produk -->
            <div class="card-body p-4 d-flex flex-column">
                <h5 class="card-title fw-bold mb-1" style="color: var(--coffee-dark);">{{ $item->nama_produk }}</h5>
                <p class="text-muted small mb-3">Kategori: Makanan</p>
                
                <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small d-block">Harga</span>
                        <span class="fs-5 fw-bold" style="color: var(--coffee-medium);">Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</span>
                    </div>
                    <div class="text-end">
                        <span class="text-muted small d-block">Stok</span>
                        <span class="badge {{ $item->stok > 10 ? 'bg-success-subtle text-success border border-success-subtle' : ($item->stok > 0 ? 'bg-warning-subtle text-warning border border-warning-subtle' : 'bg-danger-subtle text-danger border border-danger-subtle') }} px-2 py-1 rounded">
                            {{ $item->stok }} Porsi
                        </span>
                    </div>
                </div>
                @if(in_array(Auth::user()->role, ['admin', 'kasir']))
                <div class="mt-3 d-flex gap-2">
                    <button class="btn btn-sm btn-outline-warning flex-fill" data-bs-toggle="modal" data-bs-target="#modalEditMakanan{{ $item->id }}">
                        <i class="bi bi-pencil"></i> Edit
                    </button>
                    <form action="/produk/{{ $item->id }}" method="POST" class="d-inline flex-fill" onsubmit="return confirm('Hapus makanan ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger w-100"><i class="bi bi-trash"></i> Hapus</button>
                    </form>
                </div>

                <!-- Modal Edit -->
                <div class="modal fade" id="modalEditMakanan{{ $item->id }}" tabindex="-1">
                    <div class="modal-dialog"><div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Makanan</h5>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="/produk/{{ $item->id }}" method="POST">
                            @csrf @method('PUT')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Kode Produk</label>
                                    <input type="text" name="kode_produk" class="form-control" value="{{ $item->kode_produk }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Nama Makanan</label>
                                    <input type="text" name="nama_produk" class="form-control" value="{{ $item->nama_produk }}" required>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="form-label fw-semibold">Harga Beli</label>
                                        <input type="number" name="harga_beli" class="form-control" value="{{ $item->harga_beli }}" required>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label fw-semibold">Harga Jual</label>
                                        <input type="number" name="harga_jual" class="form-control" value="{{ $item->harga_jual }}" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Stok</label>
                                    <input type="number" name="stok" class="form-control" value="{{ $item->stok }}" required>
                                </div>
                                <input type="hidden" name="kategori" value="makanan">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-coffee">Simpan</button>
                            </div>
                        </form>
                    </div></div>
                </div>
                @endif
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 p-5 text-center bg-white">
            <div class="mb-3" style="font-size: 4rem;">🔍</div>
            <h5 class="fw-bold" style="color: var(--coffee-dark);">Tidak ada menu makanan ditemukan</h5>
            <p class="text-muted">Coba cari dengan kata kunci lain atau tambahkan produk dengan kategori "Makanan" terlebih dahulu.</p>
            @if(in_array(Auth::user()->role, ['admin', 'kasir']))
                <div class="mt-3">
                    <a href="/produk" class="btn btn-coffee"><i class="bi bi-plus-lg me-1"></i> Tambah Produk</a>
                </div>
            @endif
        </div>
    </div>
    @endforelse
</div>

@if(in_array(Auth::user()->role, ['admin', 'kasir']))
<!-- Modal Tambah Makanan -->
<div class="modal fade" id="modalTambahMakanan" tabindex="-1">
    <div class="modal-dialog"><div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Tambah Makanan Baru</h5>
            <button class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <form action="/produk" method="POST">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Kode Produk</label>
                    <input type="text" name="kode_produk" class="form-control" placeholder="Contoh: MK001" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Makanan</label>
                    <input type="text" name="nama_produk" class="form-control" placeholder="Nama makanan" required>
                </div>
                <div class="row">
                    <div class="col-6 mb-3">
                        <label class="form-label fw-semibold">Harga Beli</label>
                        <input type="number" name="harga_beli" class="form-control" placeholder="0" required>
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label fw-semibold">Harga Jual</label>
                        <input type="number" name="harga_jual" class="form-control" placeholder="0" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Stok Awal</label>
                    <input type="number" name="stok" class="form-control" value="0" required>
                </div>
                <input type="hidden" name="kategori" value="makanan">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-coffee">Tambah</button>
            </div>
        </form>
    </div></div>
</div>
@endif

<style>
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
</style>
@endsection
