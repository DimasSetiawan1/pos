@extends('layouts.app')
@section('title', 'Manajemen Produk')
@section('page-title', 'Manajemen Produk')

@section('content')
<div class="content-card">
    <div class="content-card-header">
        <h6><i class="bi bi-box-seam me-2"></i>Daftar Produk</h6>
        <button class="btn btn-coffee btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-plus-lg me-1"></i> Tambah Produk
        </button>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produk as $i => $p)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td><span class="badge badge-coffee">{{ $p->kode_produk }}</span></td>
                    <td class="fw-semibold">{{ $p->nama_produk }}</td>
                    <td><span class="badge bg-secondary">{{ ucfirst($p->kategori) }}</span></td>
                    <td>Rp {{ number_format($p->harga_beli,0,',','.') }}</td>
                    <td>Rp {{ number_format($p->harga_jual,0,',','.') }}</td>
                    <td>
                        <span class="badge {{ $p->stok > 10 ? 'bg-success' : ($p->stok > 0 ? 'bg-warning text-dark' : 'bg-danger') }}">
                            {{ $p->stok }}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-outline-warning"
                            data-bs-toggle="modal" data-bs-target="#modalEdit{{ $p->id }}">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <form action="/admin/produk/{{ $p->id }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Hapus produk ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="modalEdit{{ $p->id }}" tabindex="-1">
                    <div class="modal-dialog"><div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Produk</h5>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="/admin/produk/{{ $p->id }}" method="POST">
                            @csrf @method('PUT')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Kode Produk</label>
                                    <input type="text" name="kode_produk" class="form-control" value="{{ $p->kode_produk }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Nama Produk</label>
                                    <input type="text" name="nama_produk" class="form-control" value="{{ $p->nama_produk }}" required>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="form-label fw-semibold">Harga Beli</label>
                                        <input type="number" name="harga_beli" class="form-control" value="{{ $p->harga_beli }}" required>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label fw-semibold">Harga Jual</label>
                                        <input type="number" name="harga_jual" class="form-control" value="{{ $p->harga_jual }}" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Stok</label>
                                    <input type="number" name="stok" class="form-control" value="{{ $p->stok }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Kategori</label>
                                    <select name="kategori" class="form-select" required>
                                        <option value="minuman" {{ $p->kategori == 'minuman' ? 'selected' : '' }}>Minuman</option>
                                        <option value="makanan" {{ $p->kategori == 'makanan' ? 'selected' : '' }}>Makanan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button class="btn btn-coffee">Simpan</button>
                            </div>
                        </form>
                    </div></div>
                </div>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-5">Belum ada produk</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog"><div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Tambah Produk Baru</h5>
            <button class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <form action="/admin/produk" method="POST">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Kode Produk</label>
                    <input type="text" name="kode_produk" class="form-control" placeholder="Contoh: PR004" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Produk</label>
                    <input type="text" name="nama_produk" class="form-control" placeholder="Nama produk" required>
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
                <div class="mb-3">
                    <label class="form-label fw-semibold">Kategori</label>
                    <select name="kategori" class="form-select" required>
                        <option value="minuman" selected>Minuman</option>
                        <option value="makanan">Makanan</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-coffee">Tambah</button>
            </div>
        </form>
    </div></div>
</div>
@endsection
