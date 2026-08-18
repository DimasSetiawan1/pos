@extends('layouts.app')
@section('title', 'Supplier & Barang Masuk')
@section('page-title', 'Manajemen Supplier & Barang Masuk')

@section('content')
<div class="content-card">
    <div class="content-card-header d-flex justify-content-between align-items-center" style="padding-bottom: 0; border-bottom: none;">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-supplier-tab" data-bs-toggle="pill" data-bs-target="#pills-supplier" type="button" role="tab" aria-controls="pills-supplier" aria-selected="true">
                    <i class="bi bi-truck me-2"></i>Supplier
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-barang-masuk-tab" data-bs-toggle="pill" data-bs-target="#pills-barang-masuk" type="button" role="tab" aria-controls="pills-barang-masuk" aria-selected="false">
                    <i class="bi bi-box-arrow-in-down me-2"></i>Barang Masuk
                </button>
            </li>
        </ul>
    </div>
    
    <div class="tab-content" id="pills-tabContent">
        <!-- Tab Supplier -->
        <div class="tab-pane fade show active" id="pills-supplier" role="tabpanel" aria-labelledby="pills-supplier-tab">
            <div class="p-3 d-flex justify-content-end border-top" style="background-color: #faf6f2;">
                <button class="btn btn-coffee btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahSupplier">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Supplier
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr><th>No</th><th>Nama Supplier</th><th>Alamat</th><th>Telepon</th><th>Aksi</th></tr>
                    </thead>
                    <tbody>
                        @forelse($supplier as $i => $s)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td class="fw-semibold">{{ $s->nama_supplier }}</td>
                            <td>{{ $s->alamat ?? '-' }}</td>
                            <td>{{ $s->telepon ?? '-' }}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-warning"
                                    data-bs-toggle="modal" data-bs-target="#modalEditSupplier{{ $s->id }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form action="/admin/supplier/{{ $s->id }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Hapus supplier ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Edit Supplier -->
                        <div class="modal fade" id="modalEditSupplier{{ $s->id }}" tabindex="-1">
                            <div class="modal-dialog"><div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Supplier</h5>
                                    <button class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="/admin/supplier/{{ $s->id }}" method="POST">
                                    @csrf @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Nama Supplier</label>
                                            <input type="text" name="nama_supplier" class="form-control" value="{{ $s->nama_supplier }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Alamat</label>
                                            <input type="text" name="alamat" class="form-control" value="{{ $s->alamat }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Telepon</label>
                                            <input type="text" name="telepon" class="form-control" value="{{ $s->telepon }}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                                        <button class="btn btn-coffee" type="submit">Simpan</button>
                                    </div>
                                </form>
                            </div></div>
                        </div>
                        @empty
                        <tr><td colspan="5" class="text-center text-muted py-5">Belum ada supplier</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tab Barang Masuk -->
        <div class="tab-pane fade" id="pills-barang-masuk" role="tabpanel" aria-labelledby="pills-barang-masuk-tab">
            <div class="p-3 d-flex justify-content-end border-top" style="background-color: #faf6f2;">
                <button class="btn btn-coffee btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahBarangMasuk">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Barang Masuk
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr><th>No</th><th>Tanggal</th><th>Supplier</th><th>Total Item</th><th>Keterangan</th><th>Aksi</th></tr>
                    </thead>
                    <tbody>
                        @forelse($barang_masuk as $i => $b)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($b->tanggal)->format('d M Y') }}</td>
                            <td class="fw-semibold">{{ $b->supplier->nama_supplier ?? '-' }}</td>
                            <td><span class="badge bg-info text-dark">{{ $b->total_item }} item</span></td>
                            <td><small>{{ $b->keterangan ?? '-' }}</small></td>
                            <td>
                                <form action="/admin/barang-masuk/{{ $b->id }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Hapus data ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="text-center text-muted py-5">Belum ada data barang masuk</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Supplier -->
<div class="modal fade" id="modalTambahSupplier" tabindex="-1">
    <div class="modal-dialog"><div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Tambah Supplier</h5>
            <button class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <form action="/admin/supplier" method="POST">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Supplier</label>
                    <input type="text" name="nama_supplier" class="form-control" placeholder="Nama supplier" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Alamat</label>
                    <input type="text" name="alamat" class="form-control" placeholder="Alamat">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Telepon</label>
                    <input type="text" name="telepon" class="form-control" placeholder="08xxxxxxxxxx">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-coffee" type="submit">Tambah</button>
            </div>
        </form>
    </div></div>
</div>

<!-- Modal Tambah Barang Masuk -->
<div class="modal fade" id="modalTambahBarangMasuk" tabindex="-1">
    <div class="modal-dialog"><div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Tambah Barang Masuk</h5>
            <button class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <form action="/admin/barang-masuk" method="POST">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Supplier</label>
                    <select name="supplier_id" class="form-select" required>
                        <option value="">-- Pilih Supplier --</option>
                        @foreach($supplier as $s)
                            <option value="{{ $s->id }}">{{ $s->nama_supplier }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Total Item</label>
                    <input type="number" name="total_item" class="form-control" value="1" min="1" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="3" placeholder="Keterangan barang masuk..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Batal</button>
                <button class="btn btn-coffee" type="submit">Simpan</button>
            </div>
        </form>
    </div></div>
</div>

<style>
    .nav-pills .nav-link {
        color: var(--coffee-medium);
        font-weight: 600;
        border-radius: 8px;
        padding: 8px 16px;
        margin-right: 8px;
    }
    .nav-pills .nav-link.active {
        background-color: var(--coffee-medium);
        color: white;
    }
    .nav-pills .nav-link:hover:not(.active) {
        background-color: var(--coffee-cream);
    }
</style>
@endsection
