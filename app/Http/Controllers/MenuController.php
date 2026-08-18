<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function makanan(Request $request)
    {
        $search = $request->query('search');
        
        $query = Product::where('kategori', 'makanan');
        
        if ($search) {
            $query->where('nama_produk', 'like', '%' . $search . '%');
        }
        
        $makanan = $query->get();
        
        return view('menu.makanan', compact('makanan', 'search'));
    }

    public function minuman(Request $request)
    {
        $search = $request->query('search');
        
        $queryCoffee = Product::whereIn('kategori', ['minuman_coffee', 'minuman']);
        $queryNonCoffee = Product::where('kategori', 'minuman_non_coffee');
        
        if ($search) {
            $queryCoffee->where('nama_produk', 'like', '%' . $search . '%');
            $queryNonCoffee->where('nama_produk', 'like', '%' . $search . '%');
        }
        
        $coffee = $queryCoffee->get();
        $non_coffee = $queryNonCoffee->get();
        
        return view('menu.minuman', compact('coffee', 'non_coffee', 'search'));
    }
}
