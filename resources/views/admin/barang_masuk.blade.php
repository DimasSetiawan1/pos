@extends('layouts.app')
@section('title', 'Barang Masuk')
@section('page-title', 'Data Barang Masuk')

@section('content')
<div class="content-card">
    <div class="content-card-header">
        <h6><i class="bi bi-box-arrow-in-down me-2"></i>Data Barang Masuk</h6>
        <button class="btn btn-coffee btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-plus-lg me-1"></i> Tambah
        </button>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
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

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1">
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
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-coffee">Simpan</button>
            </div>
        </form>
    </div></div>
</div>
@endsection
