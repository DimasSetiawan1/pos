@extends('layouts.app')
@section('title', 'Supplier & Bahan Baku')
@section('page-title', 'Manajemen Supplier & Bahan Baku')

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
                <button class="nav-link" id="pills-bahan-tab" data-bs-toggle="pill" data-bs-target="#pills-bahan" type="button" role="tab" aria-controls="pills-bahan" aria-selected="false">
                    <i class="bi bi-basket2 me-2"></i>Bahan Baku
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

        <!-- Tab Bahan Baku -->
        <div class="tab-pane fade" id="pills-bahan" role="tabpanel" aria-labelledby="pills-bahan-tab">
            <div class="p-3 d-flex justify-content-end border-top" style="background-color: #faf6f2;">
                <button class="btn btn-coffee btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahBahan">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Bahan Baku
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr><th>No</th><th>Kode</th><th>Nama Bahan</th><th>Satuan</th><th>Stok</th><th>Aksi</th></tr>
                    </thead>
                    <tbody>
                        @forelse($bahan as $i => $b)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td><span class="badge badge-coffee">{{ $b->kode_bahan }}</span></td>
                            <td class="fw-semibold">{{ $b->nama_bahan }}</td>
                            <td>{{ $b->satuan }}</td>
                            <td>
                                <span class="badge {{ $b->stok > 10 ? 'bg-success' : ($b->stok > 0 ? 'bg-warning text-dark' : 'bg-danger') }}">
                                    {{ (int)$b->stok }} {{ $b->satuan }}
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-warning"
                                    data-bs-toggle="modal" data-bs-target="#modalEditBahan{{ $b->id }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form action="/admin/bahan-baku/{{ $b->id }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Hapus bahan baku ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Edit Bahan -->
                        <div class="modal fade" id="modalEditBahan{{ $b->id }}" tabindex="-1">
                            <div class="modal-dialog"><div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Bahan Baku</h5>
                                    <button class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="/admin/bahan-baku/{{ $b->id }}" method="POST">
                                    @csrf @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Kode Bahan</label>
                                            <input type="text" name="kode_bahan" class="form-control" value="{{ $b->kode_bahan }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Nama Bahan</label>
                                            <input type="text" name="nama_bahan" class="form-control" value="{{ $b->nama_bahan }}" required>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 mb-3">
                                                <label class="form-label fw-semibold">Satuan</label>
                                                <input type="text" name="satuan" class="form-control" value="{{ $b->satuan }}" required>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <label class="form-label fw-semibold">Stok</label>
                                                <input type="number" name="stok" class="form-control" value="{{ $b->stok }}" step="0.01" required>
                                            </div>
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
                        <tr><td colspan="6" class="text-center text-muted py-5">Belum ada bahan baku</td></tr>
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

<!-- Modal Tambah Bahan Baku -->
<div class="modal fade" id="modalTambahBahan" tabindex="-1">
    <div class="modal-dialog"><div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Tambah Bahan Baku</h5>
            <button class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <form action="/admin/bahan-baku" method="POST">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Kode Bahan</label>
                    <input type="text" name="kode_bahan" class="form-control" placeholder="Contoh: BB004" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Bahan</label>
                    <input type="text" name="nama_bahan" class="form-control" placeholder="Nama bahan baku" required>
                </div>
                <div class="row">
                    <div class="col-6 mb-3">
                        <label class="form-label fw-semibold">Satuan</label>
                        <input type="text" name="satuan" class="form-control" placeholder="Kg / Liter / Pcs" required>
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label fw-semibold">Stok Awal</label>
                        <input type="number" name="stok" class="form-control" value="0" step="0.01" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-coffee" type="submit">Tambah</button>
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
