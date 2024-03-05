<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use Illuminate\Http\Request;

class DetailPenjualanController extends Controller
{
    public function index()
    {
        $detailPenjualans = DetailPenjualan::all();
        return view('detail_penjualan.index', compact('detailPenjualans'));
    }

    public function create()
    {

    }

    public function store()
    {
        
    }
}
