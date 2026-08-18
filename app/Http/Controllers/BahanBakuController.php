<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use Illuminate\Http\Request;

class BahanBakuController extends Controller
{
    public function index()
    {
        $bahan = \App\Models\BahanBaku::all();
        return view('admin.bahan_baku', compact('bahan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_bahan' => 'required|unique:bahan_bakus,kode_bahan',
            'nama_bahan' => 'required',
            'satuan'     => 'required',
            'harga'      => 'required|numeric|min:0',
            'stok'       => 'required|numeric|min:0',
        ]);

        BahanBaku::create($request->only(['kode_bahan','nama_bahan','satuan','harga','stok']));

        return back()->with('success', 'Bahan baku berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $bahan = BahanBaku::findOrFail($id);

        $request->validate([
            'kode_bahan' => 'required|unique:bahan_bakus,kode_bahan,' . $id,
            'nama_bahan' => 'required',
            'satuan'     => 'required',
            'harga'      => 'required|numeric|min:0',
            'stok'       => 'required|numeric|min:0',
        ]);

        $bahan->update($request->only(['kode_bahan','nama_bahan','satuan','harga','stok']));

        return back()->with('success', 'Bahan baku berhasil diupdate!');
    }

    public function destroy($id)
    {
        BahanBaku::findOrFail($id)->delete();
        return back()->with('success', 'Bahan baku berhasil dihapus!');
    }
}
