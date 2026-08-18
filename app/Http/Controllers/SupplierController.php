<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $supplier = Supplier::all();
        $bahan = \App\Models\BahanBaku::all();
        return view('admin.suplier_bahan', compact('supplier', 'bahan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required',
        ]);

        Supplier::create($request->only(['nama_supplier','alamat','telepon']));

        return back()->with('success', 'Supplier berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);
        $request->validate(['nama_supplier' => 'required']);
        $supplier->update($request->only(['nama_supplier','alamat','telepon']));
        return back()->with('success', 'Supplier berhasil diupdate!');
    }

    public function destroy($id)
    {
        Supplier::findOrFail($id)->delete();
        return back()->with('success', 'Supplier berhasil dihapus!');
    }
}
