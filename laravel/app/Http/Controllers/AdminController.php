<?php

namespace App\Http\Controllers;

use App\Models\produk;
use App\Models\User;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class AdminController extends Controller
{

    
    public function index(){
        $dataproduk = Produk::all();
        return view('admin.dashboard', compact('dataproduk'));
    }
    
    public function regist(){
        $user = User::all();
        return view('admin.registrasi',compact('user'));
    }
    public function create(Request $request)
    {
        produk::create($request->except(['_token']));
        return redirect()->back();
    }
    
    public function edit($produkid){
          $produk = produk::find($produkid);
          return view('admin.barangedit',compact('produk'));
    }

    public function update($produkid , Request $request){
        $produk = produk::find($produkid);
        $produk->update($request->except(['_token']));
        return redirect('admin');
    }

    public function destroy($produkid){
        $produk = produk::find($produkid);
        $produk->delete();
        return redirect()->back();
    }
}
