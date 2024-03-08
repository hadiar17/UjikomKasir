<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\Produk;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        $produks = Produk::all();
        $penjualans = Penjualan::all();
        
        return view('penjualan.index', compact('penjualans','produks'));
    }

    public function create()
    {
        $produks = Produk::where('stok', '>', 0)->get();
        return view('penjualan.create', compact('produks'));
    }

    
public function store(Request $request)
{
     // Validasi data input
     $request->validate([
        'id_produk' => 'required|array',
        'jumlah' => 'required|array',
        'subtotal' => 'required|array',
        'total' => 'required|numeric|min:0',
        'bayar' => 'required|numeric',
        'kembalian' => 'required|numeric|min:0',
    ]);


    $id_produk  = $request->id_produk; 
    $jumlah_produk = $request->jumlah; 
    $sub_total  = $request->subtotal;
    $total      = $request->total; 
    $bayar      = $request-> bayar;
    $kembalian  = $request-> kembalian;

    
    $transaksi = Penjualan::create([
        // 'id_kasir' => '0',
        'total' => $total,
        'bayar' => $bayar,
        'kembalian' => $kembalian,
        'tanggal' => date('Y-m-d'),
    ]);
    
    // Ambil ID dari transaksi yang baru saja dibuat
    $id_transaksi = $transaksi->id;

    for ($i = 0; $i < count($id_produk); $i++) {
        $id = $id_produk[$i];
        $jumlah = $jumlah_produk[$i];
        $subtotal = $sub_total[$i];

        //  var_dump(count($id_produk));die();

        DetailPenjualan::create([
            'produk_id' => $id,
            'penjualan_id' => $id_transaksi,
            'jumlah' => $jumlah,
            'subtotal' => $subtotal,
        ]);
    }
    
    

    // Buat transaksi baru berdasarkan data yang diterima dari request

    // Redirect ke halaman indeks transaksi dengan pesan sukses
    return redirect()->route('penjualan.create')->with('success', 'Transaksi berhasil .');
    }

    // public function simpanTransaksi(Request $request)
    // {
    // // Ambil satu transaksi terbaru
    // $transaksiTerbaru = Penjualan::latest()->first();

    // // Persiapkan data untuk transaksi terbaru
    // $detailTransaksi = [
    //     'tanggal' => $transaksiTerbaru->tanggal,
    //     'details' => [],
    //     'total' => $transaksiTerbaru->total
    // ];

    // // Ambil detail penjualan terkait dengan transaksi terbaru
    // $detailsTransaksi = $transaksiTerbaru->detailPenjualans;

    // // Loop melalui setiap detail transaksi dan tambahkan ke dalam data struk
    // foreach ($detailsTransaksi as $detail) {
    //     $detailTransaksi['details'][] = [
    //         'nama_produk' => $detail->produk->nama_produk,
    //         'harga' => $detail->harga,
    //         'jumlah' => $detail->jumlah,
    //         'subtotal' => $detail->subtotal
    //     ];
    // }

    // // Kembalikan view struk dengan data yang dipersiapkan
    // return view('penjualan.struk', compact('detailTransaksi'));
    // }

}



