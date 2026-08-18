<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $produk = Product::where('stok', '>', 0)->get();
        $transaksi = Transaction::with(['details.product'])
            ->where('kasir_id', Auth::id())
            ->latest()
            ->paginate(15);
            
        return view('kasir.transaksi', compact('produk', 'transaksi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'metode_pembayaran' => 'required|in:cash,qris,transfer,kartu',
            'bayar'             => 'required|numeric|min:0',
            'items'             => 'required|string',
        ]);

        $items = json_decode($request->items, true);
        if (empty($items)) {
            return back()->with('error', 'Keranjang belanja kosong!');
        }

        $total   = collect($items)->sum(fn($i) => $i['harga'] * $i['qty']);
        $metode  = $request->metode_pembayaran;
        $bayar   = $request->bayar;

        // Untuk non-cash, nominal bayar = total (tidak ada kembalian)
        if ($metode !== 'cash') {
            $bayar = $total;
        }

        if ($bayar < $total) {
            return back()->with('error', 'Uang bayar kurang dari total!');
        }

        $transaksiId = null;
        DB::transaction(function () use ($items, $total, $bayar, $metode, &$transaksiId) {
            $invoice = 'INV-' . date('Ymd') . '-' . str_pad(
                Transaction::whereDate('created_at', date('Y-m-d'))->count() + 1,
                4, '0', STR_PAD_LEFT
            );

            $transaksi = Transaction::create([
                'invoice'            => $invoice,
                'kasir_id'           => Auth::id(),
                'total'              => $total,
                'bayar'              => $bayar,
                'kembali'            => max(0, $bayar - $total),
                'metode_pembayaran'  => $metode,
            ]);

            $transaksiId = $transaksi->id;

            foreach ($items as $item) {
                $produk = Product::with('bahanBakus')->findOrFail($item['id']);
                $produk->decrement('stok', $item['qty']);

                // Kurangi stok bahan baku
                foreach ($produk->bahanBakus as $bahanBaku) {
                    $bahanBaku->decrement('stok', $bahanBaku->pivot->jumlah * $item['qty']);
                }

                TransactionDetail::create([
                    'transaction_id' => $transaksi->id,
                    'product_id'     => $item['id'],
                    'qty'            => $item['qty'],
                    'harga'          => $item['harga'],
                    'subtotal'       => $item['harga'] * $item['qty'],
                ]);
            }
        });

        return redirect('/kasir/transaksi')
            ->with('success', 'Transaksi berhasil disimpan!')
            ->with('print_id', $transaksiId);
    }

    public function print($id)
    {
        $transaksi = Transaction::with(['kasir', 'details.product'])->findOrFail($id);
        return view('kasir.struk', compact('transaksi'));
    }

    public function riwayat()
    {
        $transaksi = Transaction::with(['details.product'])
            ->where('kasir_id', Auth::id())
            ->latest()
            ->paginate(15);

        return view('kasir.riwayat', compact('transaksi'));
    }
}
