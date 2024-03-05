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

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'tanggal' => 'required|date',
    //         'produk.*.id' => 'required|exists:produks,id',
    //         'produk.*.jumlah' => 'required|integer|min:1',
    //     ]);

    //     foreach ($request->produk as $produk) {
    //         $produks = Produk::find($produk['id']);
    //         if ($produks->stok < $produk['jumlah']) {
    //             return redirect()->back()->with('error', 'Stok ' . $produks->nama_produk . ' tersisa ' . $produks->stok );
    //         }
    //     }

    //     $penjualan = Penjualan::create($request->only('tanggal'));

    //     foreach ($request->produk as $produk) {
    //         $detailPenjualan = new DetailPenjualan([
    //             'produk_id' => $produk['id'],
    //             'jumlah' => $produk['jumlah'],
    //             'subtotal' => Produk::find($produk['id'])->harga * $produk['jumlah'],
    //         ]);

    //         Produk::find($produk['id'])->decrement('stok', $produk['jumlah']);

    //         $penjualan->detailPenjualan()->save($detailPenjualan);
    //     }

    //     return redirect()->route('penjualan.index')->with('success', 'Transaksi Berhasil');
    // }



    
public function store(Request $request)
{
    $id_produk  = $request->id_produk; 
    $jumlah_produk = $request->jumlah; 
    $sub_total  = $request->subtotal;
    $total      = $request->total; 
    $bayar      = $request-> bayar;
    $kembalian  = $request-> kembalian;

    // var_dump($id_produk );die();
    // var_dump($jumlah_produk );die();
    // var_dump($sub_total );die();
    // var_dump($total );die();
    // var_dump($bayar );die();
    // var_dump($kembalian );die();
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
    // var_dump($request);die();
    // Validasi data dari request
    

    // Buat transaksi baru berdasarkan data yang diterima dari request

    // Redirect ke halaman indeks transaksi dengan pesan sukses
    return redirect()->route('penjualan.create')->with('success', 'Transaksi berhasil ditambahkan.');
    }



}



