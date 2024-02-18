<?php

namespace App\Http\Controllers;

use App\Models\detailpenjualan;
use App\Models\penjualan;
use App\Models\pelanggan;
use App\Models\produk;
use App\Models\User;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function index()
    {
        $user = User::all();
        $dataproduk = produk::all();
        return view('petugas.dashboard', compact('user'), compact('dataproduk'));
    }
    public function create(Request $request)
    {
        $request->validate([
            'namaproduk' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            // ... tambahkan aturan validasi lain sesuai kebutuhan
        ]);

        Produk::create([
            'namaproduk' => $request->input('namaproduk'),
            'harga' => $request->input('harga'),
            'stok' => $request->input('stok'),
            // ... tambahkan kolom lain sesuai kebutuhan
        ]);

        return redirect()->route('petugas.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($produkid)
    {
        $produk = produk::find($produkid);
        return view('petugas.produkedit', compact('produk'));
    }
    public function update($produkid, Request $request)
    {
        $produk = produk::find($produkid);
        $produk->update($request->except(['_token']));
        return redirect('petugas');
    }
    public function destroy($produkid)
    {
        $produk = produk::find($produkid);
        $produk->delete();
        return redirect()->back();
    }

    public function look(){
        $detailpembelian = detailpenjualan::with('penjualan','produk','pelanggan',)->get();
        return view('petugas.penjualan',compact('detailpembelian'));
    }
}
