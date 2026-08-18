<?php

namespace App\Http\Controllers;

use App\Models\Transaction;

class AdminTransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaction::with(['kasir', 'details.product'])
            ->latest()
            ->paginate(15);

        $total_transaksi   = Transaction::count();
        $total_pendapatan  = Transaction::sum('total');
        $transaksi_hari_ini = Transaction::whereDate('created_at', date('Y-m-d'))->count();

        // Hitung Pendapatan, Pengeluaran, dan Keuntungan Bulan Ini
        $bulan_ini = date('m');
        $tahun_ini = date('Y');

        $transaksi_bulan_ini = Transaction::with('details.product')
            ->whereMonth('created_at', $bulan_ini)
            ->whereYear('created_at', $tahun_ini)
            ->get();

        $pendapatan_bulan_ini = 0;
        $pengeluaran_bulan_ini = 0;

        foreach ($transaksi_bulan_ini as $t) {
            $pendapatan_bulan_ini += $t->total;
            foreach ($t->details as $d) {
                if ($d->product) {
                    // Harga beli * qty adalah pengeluaran (HPP)
                    $pengeluaran_bulan_ini += ($d->qty * $d->product->harga_beli);
                }
            }
        }
        $keuntungan_bulan_ini = $pendapatan_bulan_ini - $pengeluaran_bulan_ini;

        return view('admin.transaksi', compact(
            'transaksi', 'total_transaksi', 'total_pendapatan', 'transaksi_hari_ini',
            'pendapatan_bulan_ini', 'pengeluaran_bulan_ini', 'keuntungan_bulan_ini'
        ));
    }
}
