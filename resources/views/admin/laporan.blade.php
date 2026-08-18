@extends('layouts.app')
@section('title', $title)
@section('page-title', $title)

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="m-0"><i class="bi bi-file-earmark-bar-graph me-2"></i>{{ $title }}</h5>
            <a href="{{ url()->previous() == url()->current() ? '/dashboard-admin' : url()->previous() }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-7">
        <div class="content-card">
            <div class="content-card-header">
                <h6><i class="bi bi-wallet2 me-2"></i>Rincian Pendapatan</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Periode</th>
                            <th class="text-end">Total Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporan as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if(isset($item->url) && $item->url)
                                    <a href="{{ $item->url }}" class="text-decoration-none fw-semibold">{{ $item->label_formatted }} <i class="bi bi-box-arrow-up-right ms-1 small"></i></a>
                                @else
                                    <span class="fw-semibold">{{ $item->label_formatted }}</span>
                                @endif
                            </td>
                            <td class="text-end fw-bold text-success">Rp {{ number_format($item->total_pendapatan, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-4">Belum ada data pendapatan</td>
                        </tr>
                        @endforelse
                    </tbody>
                    @if($laporan->count() > 0)
                    <tfoot>
                        <tr class="table-light fw-bold">
                            <td colspan="2" class="text-end">Total Keseluruhan:</td>
                            <td class="text-end text-success fs-5">Rp {{ number_format($laporan->sum('total_pendapatan'), 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                    @endif
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-5">
        <div class="content-card">
            <div class="content-card-header">
                <h6><i class="bi bi-box-seam me-2"></i>Bahan Baku Terpakai</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Nama Bahan</th>
                            <th class="text-end">Total Terpakai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penggunaan_bahan as $bahan)
                        <tr>
                            <td><span class="fw-semibold">{{ $bahan->nama_bahan }}</span></td>
                            <td class="text-end fw-bold text-danger">{{ (int)$bahan->total_digunakan }} {{ $bahan->satuan }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="text-center text-muted py-4">Belum ada data penggunaan bahan baku</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
