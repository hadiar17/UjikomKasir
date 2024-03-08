<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\DetailPenjualan;

class DetailPenjualanController extends Controller
{
    public function index()
    {
        $detailPenjualans = DetailPenjualan::all();
        return view('detail_penjualan.index', compact('detailPenjualans'));
    }

    public function cetakLaporan()
    {
        $dtLaporan = DetailPenjualan::with(['produk', 'penjualan'])->get();
        return view('detail_penjualan.cetakLaporan', compact('dtLaporan'));
    }
    

    public function create()
    {

    }

    public function store()
    {
        
    }

    public function edit(DetailPenjualan $detailPenjualan)
    {
      
    }

    public function update()
    {

    }

    public function destroy($id)
    {
        $detailPenjualan = DetailPenjualan::find($id);
        if (!$detailPenjualan) {
            return redirect()->back()->with('error', 'Detail penjualan tidak ditemukan');
        }
        $detailPenjualan->delete();
        return redirect()->back()->with('success', 'Detail penjualan berhasil dihapus');
    }
    
}
