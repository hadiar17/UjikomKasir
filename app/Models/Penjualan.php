<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $fillable = ['tanggal','total','bayar','kembalian'];

    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class);
    }

}
