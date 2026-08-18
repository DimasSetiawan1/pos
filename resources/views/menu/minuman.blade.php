@extends('layouts.app')
@section('title', 'Menu Minuman')
@section('page-title', 'Menu Minuman')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h4 class="fw-bold" style="color: var(--coffee-dark);">📋 Daftar Menu Minuman</h4>
        <p class="text-muted small">Daftar minuman yang tersedia di Blok Barat Coffee. Gunakan pencarian untuk mencari menu dengan cepat.</p>
    </div>
    <div class="col-md-4">
        <form action="/menu-minuman" method="GET" class="d-flex gap-2">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 text-muted">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Cari minuman..." value="{{ $search }}">
            </div>
            @if($search)
                <a href="/menu-minuman" class="btn btn-secondary"><i class="bi bi-x-lg"></i></a>
            @endif
            <button type="submit" class="btn btn-coffee">Cari</button>
        </form>
    </div>
</div>

<ul class="nav nav-pills mb-4" id="minuman-tabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="coffee-tab" data-bs-toggle="pill" data-bs-target="#coffee" type="button" role="tab" aria-controls="coffee" aria-selected="true">
            <i class="bi bi-cup-hot me-2"></i>Coffee
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="noncoffee-tab" data-bs-toggle="pill" data-bs-target="#noncoffee" type="button" role="tab" aria-controls="noncoffee" aria-selected="false">
            <i class="bi bi-cup-straw me-2"></i>Non-Coffee
        </button>
    </li>
</ul>

<div class="tab-content" id="minuman-tabs-content">
    
    <!-- Tab Coffee -->
    <div class="tab-pane fade show active" id="coffee" role="tabpanel" aria-labelledby="coffee-tab">
        @if(in_array(Auth::user()->role, ['admin', 'kasir']))
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-coffee" data-bs-toggle="modal" data-bs-target="#modalTambahCoffee">
                <i class="bi bi-plus-lg me-1"></i> Tambah Coffee
            </button>
        </div>
        @endif
        
        <div class="row g-4">
            @forelse($coffee as $item)
            <div class="col-md-4 col-sm-6">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative card-hover" style="background: white;">
                    <!-- Badge Ketersediaan -->
                    <div class="position-absolute top-0 end-0 m-3 z-3">
                        @if($item->stok > 0)
                            <span class="badge bg-success px-3 py-2 rounded-pill shadow-sm"><i class="bi bi-check-circle me-1"></i> Tersedia</span>
                        @else
                            <span class="badge bg-danger px-3 py-2 rounded-pill shadow-sm"><i class="bi bi-x-circle me-1"></i> Habis</span>
                        @endif
                    </div>
                    
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
                    
                    <div class="card-body p-4 d-flex flex-column">
                        <h5 class="card-title fw-bold mb-1" style="color: var(--coffee-dark);">{{ $item->nama_produk }}</h5>
                        <p class="text-muted small mb-3">Kategori: Coffee</p>
                        
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
                            <button class="btn btn-sm btn-outline-warning flex-fill" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id }}">
                                <i class="bi bi-pencil"></i> Edit
                            </button>
                            <form action="/produk/{{ $item->id }}" method="POST" class="d-inline flex-fill" onsubmit="return confirm('Hapus minuman ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger w-100"><i class="bi bi-trash"></i> Hapus</button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            
            @if(in_array(Auth::user()->role, ['admin', 'kasir']))
            <!-- Modal Edit Coffee -->
            <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1">
                <div class="modal-dialog"><div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Coffee</h5>
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
                                <label class="form-label fw-semibold">Nama Minuman</label>
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
                            <input type="hidden" name="kategori" value="minuman_coffee">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-coffee">Simpan</button>
                        </div>
                    </form>
                </div></div>
            </div>
            @endif
            @empty
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 p-5 text-center bg-white">
                    <div class="mb-3" style="font-size: 4rem;">☕</div>
                    <h5 class="fw-bold" style="color: var(--coffee-dark);">Tidak ada menu Coffee ditemukan</h5>
                    <p class="text-muted">Coba cari dengan kata kunci lain atau tambahkan produk baru.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
    
    <!-- Tab Non-Coffee -->
    <div class="tab-pane fade" id="noncoffee" role="tabpanel" aria-labelledby="noncoffee-tab">
        @if(in_array(Auth::user()->role, ['admin', 'kasir']))
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-coffee" data-bs-toggle="modal" data-bs-target="#modalTambahNonCoffee">
                <i class="bi bi-plus-lg me-1"></i> Tambah Non-Coffee
            </button>
        </div>
        @endif
        
        <div class="row g-4">
            @forelse($non_coffee as $item)
            <div class="col-md-4 col-sm-6">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative card-hover" style="background: white;">
                    <!-- Badge Ketersediaan -->
                    <div class="position-absolute top-0 end-0 m-3 z-3">
                        @if($item->stok > 0)
                            <span class="badge bg-success px-3 py-2 rounded-pill shadow-sm"><i class="bi bi-check-circle me-1"></i> Tersedia</span>
                        @else
                            <span class="badge bg-danger px-3 py-2 rounded-pill shadow-sm"><i class="bi bi-x-circle me-1"></i> Habis</span>
                        @endif
                    </div>
                    
                    @php
                        $slug = Str::slug($item->nama_produk);
                    @endphp
                    <div class="ratio ratio-16x9 d-flex align-items-center justify-content-center" 
                         style="background: linear-gradient(135deg, #e8ddd5 0%, #f4f0eb 100%); position: relative;">
                         <img src="/images/products/{{ $slug }}.jpg?v={{ time() }}" 
                              onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($item->nama_produk) }}&background=d35400&color=fff&size=150'" 
                              class="img-fluid w-100 h-100" style="object-fit:cover;" alt="{{ $item->nama_produk }}">
                         <div class="position-absolute bottom-0 start-0 m-2">
                             <span class="badge badge-coffee shadow-sm px-3 py-1 rounded-pill">{{ $item->kode_produk }}</span>
                         </div>
                    </div>
                    
                    <div class="card-body p-4 d-flex flex-column">
                        <h5 class="card-title fw-bold mb-1" style="color: var(--coffee-dark);">{{ $item->nama_produk }}</h5>
                        <p class="text-muted small mb-3">Kategori: Non-Coffee</p>
                        
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
                            <button class="btn btn-sm btn-outline-warning flex-fill" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id }}">
                                <i class="bi bi-pencil"></i> Edit
                            </button>
                            <form action="/produk/{{ $item->id }}" method="POST" class="d-inline flex-fill" onsubmit="return confirm('Hapus minuman ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger w-100"><i class="bi bi-trash"></i> Hapus</button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            
            @if(in_array(Auth::user()->role, ['admin', 'kasir']))
            <!-- Modal Edit Non-Coffee -->
            <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1">
                <div class="modal-dialog"><div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Non-Coffee</h5>
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
                                <label class="form-label fw-semibold">Nama Minuman</label>
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
                            <input type="hidden" name="kategori" value="minuman_non_coffee">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-coffee">Simpan</button>
                        </div>
                    </form>
                </div></div>
            </div>
            @endif
            @empty
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 p-5 text-center bg-white">
                    <div class="mb-3" style="font-size: 4rem;">🥤</div>
                    <h5 class="fw-bold" style="color: var(--coffee-dark);">Tidak ada menu Non-Coffee ditemukan</h5>
                    <p class="text-muted">Coba cari dengan kata kunci lain atau tambahkan produk baru.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>

</div>

@if(in_array(Auth::user()->role, ['admin', 'kasir']))
<!-- Modal Tambah Coffee -->
<div class="modal fade" id="modalTambahCoffee" tabindex="-1">
    <div class="modal-dialog"><div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Tambah Coffee Baru</h5>
            <button class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <form action="/produk" method="POST">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Kode Produk</label>
                    <input type="text" name="kode_produk" class="form-control" placeholder="Contoh: COF01" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Coffee</label>
                    <input type="text" name="nama_produk" class="form-control" placeholder="Nama minuman" required>
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
                <input type="hidden" name="kategori" value="minuman_coffee">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-coffee">Tambah</button>
            </div>
        </form>
    </div></div>
</div>

<!-- Modal Tambah Non-Coffee -->
<div class="modal fade" id="modalTambahNonCoffee" tabindex="-1">
    <div class="modal-dialog"><div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Tambah Non-Coffee Baru</h5>
            <button class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <form action="/produk" method="POST">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Kode Produk</label>
                    <input type="text" name="kode_produk" class="form-control" placeholder="Contoh: NCF01" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Non-Coffee</label>
                    <input type="text" name="nama_produk" class="form-control" placeholder="Nama minuman" required>
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
                <input type="hidden" name="kategori" value="minuman_non_coffee">
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
    .card-hover {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .nav-pills .nav-link {
        color: var(--coffee-medium);
        font-weight: 600;
        border-radius: 8px;
        padding: 8px 24px;
        margin-right: 8px;
        background-color: white;
        border: 1px solid #e8ddd5;
    }
    .nav-pills .nav-link.active {
        background-color: var(--coffee-medium);
        color: white;
        border-color: var(--coffee-medium);
    }
    .nav-pills .nav-link:hover:not(.active) {
        background-color: var(--coffee-cream);
    }
</style>
@endsection
