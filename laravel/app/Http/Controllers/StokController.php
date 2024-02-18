<?php

namespace App\Http\Controllers;

use App\Models\produk;
use Illuminate\Http\Request;

class StokController extends Controller
{
    public function index()
    {
        $dataproduk = produk::all();
        return view('stok', compact('dataproduk'));
    }
    public function adddata($produkid){
        $produk = produk::find($produkid);
        return view('tambahstok',compact('produk'));
    }
    public function tambahi(Request $request ,$produkid){
        
        $product = Produk::findOrFail($produkid);
        $quantity = $request->input('quantity'); // Ambil nilai quantity dari form

        $product->stok += $quantity;
        $product->save();

        return redirect('stok');
    }
    public function reducedata($produkid){
        $produk = produk::find($produkid);
        return view('kurangstok',compact('produk'));
    }
    public function kurangi(Request $request ,$produkid){
        
        $product = Produk::findOrFail($produkid);
        $quantity = $request->input('quantity'); // Ambil nilai quantity dari form

        $product->stok -= $quantity;
        $product->save();

        return redirect('stok');
    }
}
