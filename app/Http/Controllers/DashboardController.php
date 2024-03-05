<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\DetailPenjualan;

class DashboardController extends Controller
{
    public function index() 
    {
        $produks = Produk::count();
        $penjualans = Penjualan::count();
        $detailPenjualans = DetailPenjualan::count();

        return view('dashboard', compact('produks','penjualans','detailPenjualans'));
    }
}