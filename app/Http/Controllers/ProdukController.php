<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'kode_produk' => 'required|unique:products,kode_produk',
            'nama_produk' => 'required',
            'harga_beli'  => 'required|numeric|min:0',
            'harga_jual'  => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'kategori'    => 'required|in:makanan,minuman,minuman_coffee,minuman_non_coffee',
        ]);

        Product::create($request->only(['kode_produk','nama_produk','harga_beli','harga_jual','stok','kategori']));

        return back()->with('success', 'Produk berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $produk = Product::findOrFail($id);

        $request->validate([
            'kode_produk' => 'required|unique:products,kode_produk,' . $id,
            'nama_produk' => 'required',
            'harga_beli'  => 'required|numeric|min:0',
            'harga_jual'  => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'kategori'    => 'required|in:makanan,minuman,minuman_coffee,minuman_non_coffee',
        ]);

        $produk->update($request->only(['kode_produk','nama_produk','harga_beli','harga_jual','stok','kategori']));

        return back()->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return back()->with('success', 'Produk berhasil dihapus!');
    }
}
