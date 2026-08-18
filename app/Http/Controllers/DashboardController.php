<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\Transaction;
use App\Models\BahanBaku;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function admin()
    {
        // Menghitung pendapatan berdasarkan periode
        $harian = Transaction::whereDate('created_at', now()->today())->sum('total');
        $mingguan = Transaction::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->sum('total');
        $bulanan = Transaction::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->sum('total');
        $tahunan = Transaction::whereYear('created_at', now()->year)->sum('total');

        $produk_terlaris = \App\Models\TransactionDetail::select('product_id', DB::raw('SUM(qty) as total_terjual'))
            ->groupBy('product_id')
            ->orderByDesc('total_terjual')
            ->with('product')
            ->take(5)
            ->get();

        $stok_rendah = \App\Models\Product::where('stok', '<=', 10)->orderBy('stok')->take(5)->get();

        return view('admin.dashboard', compact(
            'harian', 'mingguan', 'bulanan', 'tahunan',
            'produk_terlaris', 'stok_rendah'
        ));
    }

    public function kasir()
    {
        $produk = Product::where('stok', '>', 0)->count();

        $transaksi_hari_ini = Transaction::whereDate('created_at', date('Y-m-d'))
            ->where('kasir_id', auth()->id())
            ->count();

        $pendapatan_hari_ini = Transaction::whereDate('created_at', date('Y-m-d'))
            ->where('kasir_id', auth()->id())
            ->sum('total');

        $riwayat = Transaction::where('kasir_id', auth()->id())
            ->whereDate('created_at', date('Y-m-d'))
            ->latest()->get();

        return view('kasir.dashboard', compact(
            'produk', 'transaksi_hari_ini', 'pendapatan_hari_ini', 'riwayat'
        ));
    }
}