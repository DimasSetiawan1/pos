@extends('layouts.app')
@section('title', 'Manajemen Supplier')
@section('page-title', 'Manajemen Supplier')

@section('content')
<div class="content-card">
    <div class="content-card-header">
        <h6><i class="bi bi-truck me-2"></i>Daftar Supplier</h6>
        <button class="btn btn-coffee btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-plus-lg me-1"></i> Tambah Supplier
        </button>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
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
                            data-bs-toggle="modal" data-bs-target="#modalEdit{{ $s->id }}">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <form action="/admin/supplier/{{ $s->id }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Hapus supplier ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="modalEdit{{ $s->id }}" tabindex="-1">
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
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button class="btn btn-coffee">Simpan</button>
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

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1">
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
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-coffee">Tambah</button>
            </div>
        </form>
    </div></div>
</div>
@endsection
