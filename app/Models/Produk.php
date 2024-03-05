<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = ['nama_produk','harga','kategori','stok','gambar'];

    public static $validCategories = ['makanan', 'minuman'];

    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class);
    }
}
