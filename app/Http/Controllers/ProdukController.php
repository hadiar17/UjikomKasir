<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::all();
        return view('produk.index', compact('produks'));
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'kategori' => 'required|in:makanan,minuman',
            'stok' => 'required|integer',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $gambar = $request->file('gambar');
        $nama_file = time() . '_' . $gambar->getClientOriginalName();
        $lokasi = public_path('uploads');
        $gambar->move($lokasi, $nama_file);
    
        // Buat objek Produk baru dengan data dari request
        $produk = new Produk();
        $produk->nama_produk = $request->nama_produk;
        $produk->harga = $request->harga;
        $produk->kategori = $request->kategori;
        $produk->stok = $request->stok;
        $produk->gambar = $nama_file; // Simpan nama file gambar di kolom gambar
    
        // Simpan objek Produk ke database
        $produk->save();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produk.edit',compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'kategori' => 'required|in:makanan,minuman',
            'stok' => 'required|integer',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $produk = Produk::findOrFail($id);

        $produk->nama_produk = $request->nama_produk;
        $produk->harga = $request->harga;
        $produk->kategori = $request->kategori;
        $produk->stok = $request->stok;

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $nama_file = time() . '_' . $gambar->getClientOriginalName();
            $lokasi = public_path('uploads');
            $gambar->move($lokasi, $nama_file);
            $produk->gambar = $nama_file;
        }

        $produk->save();

        return redirect()->route('produk.index')->with('success','Produk telah diperbarui');
    }

    public function destroy(Produk $produk)
    {
        $produk->delete();

        return redirect()->route('produk.index')->with('hapus', $produk->nama_produk . ' telah dihapus dari daftar produk');
    }
}
