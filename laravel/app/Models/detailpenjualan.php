<?php

namespace App\Models;

use App\Models\penjualan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailpenjualan extends Model
{
    use HasFactory;
    protected $fillable=[
        'detailid','penjualanid','produkid','jumlahproduk'
    ];
    public function penjualan(){
        return $this->belongsTo(penjualan::class);
    }
    public function produk(){
        return $this->belongsTo(produk::class);
    }
    public function pelanggan(){
        return $this->belongsTo(pelanggan::class);
    }
}
