
@extends('adminlte::page')

@section('title','produk')

@include('partials.head')
    
@section('content_header')
    <h1>Edit Produk</h1>
@endsection

@section('content')

    <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')  
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="nama_produk">Nama Produk:</label>
                    <input type="text" name="nama_produk" class="form-control" value="{{ $produk->nama_produk }}" required>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="harga">Harga:</label>
                    <input type="text" name="harga" class="form-control" value="{{ $produk->harga }}" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="kategori">Kategori:</label>
                    <select name="kategori" class="form-control" required>
                        <option value="makanan" {{ $produk->kategori == 'makanan' ? 'selected' : '' }}>Makanan</option>
                        <option value="minuman" {{ $produk->kategori == 'minuman' ? 'selected' : '' }}>Minuman</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="stok">Stok:</label>
                    <input type="number" name="stok" class="form-control" value="{{ $produk->stok }}" required>
                </div>
            </div>
        </div>
        <div class="form-group mb-3">
            <label for="gambar">Gambar:</label>
            <input type="file" name="gambar" class="form-control">
            <img src="{{ asset('uploads/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}" style="max-width: 150px; margin-top: 10px;">
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
@stop