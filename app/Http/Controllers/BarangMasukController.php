<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Supplier;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index()
    {
        $barang_masuk = BarangMasuk::with('supplier')->latest()->get();
        $supplier = Supplier::all();
        return view('admin.suplier_barang_masuk', compact('barang_masuk', 'supplier'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'tanggal'     => 'required|date',
            'total_item'  => 'required|integer|min:1',
        ]);

        BarangMasuk::create($request->only(['supplier_id','tanggal','total_item','keterangan']));

        return back()->with('success', 'Data barang masuk berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        BarangMasuk::findOrFail($id)->delete();
        return back()->with('success', 'Data berhasil dihapus!');
    }
}
