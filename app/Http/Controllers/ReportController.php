<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index($type)
    {
        $laporan = collect();
        $title = '';

        if ($type === 'harian') {
            $title = 'Laporan Pendapatan Hari Ini';
            // Tampilkan daftar menu yang dibeli untuk hari ini
            $transaksi = Transaction::with('details.product')->whereDate('created_at', now()->today())->orderBy('created_at', 'desc')->get();
            
            foreach ($transaksi as $t) {
                // Kumpulkan nama menu yang dibeli
                $items = [];
                foreach($t->details as $d) {
                    $nama_produk = $d->product ? $d->product->nama_produk : 'Produk Dihapus';
                    $items[] = $nama_produk . ' (x' . $d->qty . ')';
                }
                $menu_list = implode(', ', $items);

                $laporan->push((object)[
                    'label_formatted' => $menu_list,
                    'total_pendapatan' => $t->total
                ]);
            }
            
        } elseif ($type === 'mingguan') {
            $title = 'Laporan Pendapatan Minggu Ini';
            // Tampilkan per hari dalam minggu ini
            $transaksi = Transaction::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->orderBy('created_at', 'asc')->get();
            
            $grouped = $transaksi->groupBy(function($date) {
                return Carbon::parse($date->created_at)->translatedFormat('l, d M Y');
            });
            
            foreach ($grouped as $day => $transactions) {
                $laporan->push((object)[
                    'label_formatted' => $day,
                    'total_pendapatan' => $transactions->sum('total')
                ]);
            }
            
        } elseif ($type === 'bulanan') {
            $reqMonth = request('month', now()->month);
            $reqYear = request('year', now()->year);
            $dateObj = Carbon::createFromDate($reqYear, $reqMonth, 1);
            
            $title = 'Laporan Pendapatan Bulan ' . $dateObj->translatedFormat('F Y');
            // Tampilkan per tanggal dalam bulan ini
            $transaksi = Transaction::whereMonth('created_at', $reqMonth)
                ->whereYear('created_at', $reqYear)
                ->orderBy('created_at', 'asc')->get();
            
            $grouped = $transaksi->groupBy(function($date) {
                return Carbon::parse($date->created_at)->translatedFormat('d F Y');
            });
            
            foreach ($grouped as $date => $transactions) {
                $laporan->push((object)[
                    'label_formatted' => $date,
                    'total_pendapatan' => $transactions->sum('total'),
                    'url' => null
                ]);
            }
            
        } elseif ($type === 'tahunan') {
            $reqYear = request('year', now()->year);
            $title = 'Laporan Pendapatan Tahun ' . $reqYear;
            // Tampilkan per bulan dalam tahun ini
            $transaksi = Transaction::whereYear('created_at', $reqYear)
                ->orderBy('created_at', 'asc')->get();
            
            $grouped = $transaksi->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('Y-m');
            });
            
            foreach ($grouped as $month => $transactions) {
                $carbonMonth = Carbon::parse($month . '-01');
                $laporan->push((object)[
                    'label_formatted' => 'Bulan ' . $carbonMonth->translatedFormat('F Y'),
                    'total_pendapatan' => $transactions->sum('total'),
                    'url' => url('/admin/laporan/bulanan?month=' . $carbonMonth->month . '&year=' . $carbonMonth->year)
                ]);
            }
            
        } else {
            abort(404);
        }

        // Hitung penggunaan bahan baku sesuai periode
        $baseQuery = DB::table('bahan_bakus')
            ->select('bahan_bakus.id', 'bahan_bakus.nama_bahan', 'bahan_bakus.satuan')
            ->leftJoin('product_bahan_bakus', 'bahan_bakus.id', '=', 'product_bahan_bakus.bahan_baku_id')
            ->leftJoin('transaction_details', 'product_bahan_bakus.product_id', '=', 'transaction_details.product_id')
            ->leftJoin('transactions', 'transaction_details.transaction_id', '=', 'transactions.id')
            ->selectRaw('SUM(transaction_details.qty * product_bahan_bakus.jumlah) as total_digunakan');

        if ($type === 'harian') {
            $baseQuery->whereDate('transactions.created_at', now()->today());
        } elseif ($type === 'mingguan') {
            $baseQuery->whereBetween('transactions.created_at', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($type === 'bulanan') {
            $reqMonth = request('month', now()->month);
            $reqYear = request('year', now()->year);
            $baseQuery->whereMonth('transactions.created_at', $reqMonth)
                      ->whereYear('transactions.created_at', $reqYear);
        } elseif ($type === 'tahunan') {
            $reqYear = request('year', now()->year);
            $baseQuery->whereYear('transactions.created_at', $reqYear);
        }

        $penggunaan_bahan = $baseQuery
            ->groupBy('bahan_bakus.id', 'bahan_bakus.nama_bahan', 'bahan_bakus.satuan')
            ->having('total_digunakan', '>', 0)
            ->orderBy('bahan_bakus.nama_bahan')
            ->get();

        return view('admin.laporan', compact('laporan', 'title', 'type', 'penggunaan_bahan'));
    }
}
