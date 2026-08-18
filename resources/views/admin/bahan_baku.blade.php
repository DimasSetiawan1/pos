@extends('layouts.app')
@section('title', 'Bahan Baku')
@section('page-title', 'Manajemen Bahan Baku')

@section('content')
<div class="content-card shadow-sm border-0 rounded-4 overflow-hidden">
    <div class="content-card-header d-flex justify-content-between align-items-center p-4 bg-white border-bottom">
        <h5 class="m-0 fw-bold text-dark"><i class="bi bi-box-seam text-coffee me-2"></i>Daftar Bahan Baku</h5>
        <button class="btn btn-coffee rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-plus-lg me-1"></i> Tambah Bahan
        </button>
    </div>
    <div class="table-responsive p-0">
        <table class="table table-hover table-borderless align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-4 text-secondary fw-semibold">No</th>
                    <th class="text-secondary fw-semibold">Kode</th>
                    <th class="text-secondary fw-semibold">Nama Bahan</th>
                    <th class="text-secondary fw-semibold">Stok Saat Ini</th>
                    <th class="text-center text-secondary fw-semibold pe-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bahan as $i => $b)
                <tr style="transition: all 0.2s ease;">
                    <td class="ps-4 text-muted">{{ $i + 1 }}</td>
                    <td><span class="badge bg-light text-secondary border px-2 py-1 rounded-3">{{ $b->kode_bahan }}</span></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="bg-coffee-subtle rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                <i class="bi bi-box text-coffee fs-5"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold text-dark">{{ $b->nama_bahan }}</h6>
                                <small class="text-muted">Satuan: {{ $b->satuan }}</small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            @if($b->stok > 10)
                                <div class="bg-success rounded-circle me-2" style="width: 10px; height: 10px;"></div>
                                <span class="fw-bold fs-6">{{ (int)$b->stok }} <span class="text-muted fw-normal ms-1">{{ $b->satuan }}</span></span>
                            @elseif($b->stok > 0)
                                <div class="bg-warning rounded-circle me-2" style="width: 10px; height: 10px;"></div>
                                <span class="fw-bold fs-6">{{ (int)$b->stok }} <span class="text-muted fw-normal ms-1">{{ $b->satuan }}</span></span>
                            @else
                                <div class="bg-danger rounded-circle me-2" style="width: 10px; height: 10px;"></div>
                                <span class="fw-bold text-danger fs-6">Habis</span>
                            @endif
                        </div>
                    </td>
                    <td class="text-center pe-4">
                        <div class="btn-group shadow-sm rounded-pill">
                            <button class="btn btn-sm btn-light border" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $b->id }}" title="Edit">
                                <i class="bi bi-pencil text-warning"></i>
                            </button>
                            <form action="/admin/bahan-baku/{{ $b->id }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus bahan baku ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-light border" title="Hapus"><i class="bi bi-trash text-danger"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="modalEdit{{ $b->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow-lg rounded-4">
                            <div class="modal-header border-bottom-0 pb-0">
                                <h5 class="modal-title fw-bold"><i class="bi bi-pencil-square text-coffee me-2"></i>Edit Bahan Baku</h5>
                                <button class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="/admin/bahan-baku/{{ $b->id }}" method="POST">
                                @csrf @method('PUT')
                                <div class="modal-body py-4">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold text-muted small">Kode Bahan</label>
                                        <input type="text" name="kode_bahan" class="form-control form-control-lg bg-light border-0" value="{{ $b->kode_bahan }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold text-muted small">Nama Bahan</label>
                                        <input type="text" name="nama_bahan" class="form-control form-control-lg bg-light border-0" value="{{ $b->nama_bahan }}" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 mb-3">
                                            <label class="form-label fw-semibold text-muted small">Satuan</label>
                                            <input type="text" name="satuan" class="form-control form-control-lg bg-light border-0" value="{{ $b->satuan }}" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold text-muted small">Stok Saat Ini</label>
                                            <input type="number" name="stok" class="form-control form-control-lg bg-light border-0" value="{{ (int)$b->stok }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer border-top-0 pt-0">
                                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-coffee rounded-pill px-4 shadow-sm">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <div class="py-5">
                            <i class="bi bi-box-seam text-muted" style="font-size: 3rem;"></i>
                            <h5 class="mt-3 text-dark fw-bold">Belum Ada Bahan Baku</h5>
                            <p class="text-muted">Tambahkan bahan baku pertama Anda dengan menekan tombol Tambah Bahan di atas.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold"><i class="bi bi-plus-circle text-coffee me-2"></i>Tambah Bahan Baku</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="/admin/bahan-baku" method="POST">
                @csrf
                <div class="modal-body py-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted small">Kode Bahan</label>
                        <input type="text" name="kode_bahan" class="form-control form-control-lg bg-light border-0" placeholder="Contoh: BB004" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted small">Nama Bahan</label>
                        <input type="text" name="nama_bahan" class="form-control form-control-lg bg-light border-0" placeholder="Nama bahan baku" required>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label fw-semibold text-muted small">Satuan</label>
                            <input type="text" name="satuan" class="form-control form-control-lg bg-light border-0" placeholder="Kg / Liter" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-muted small">Stok Awal</label>
                            <input type="number" name="stok" class="form-control form-control-lg bg-light border-0" value="0" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-coffee rounded-pill px-4 shadow-sm">Simpan Bahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
