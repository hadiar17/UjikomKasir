<!-- resources/views/produk/create.blade.php -->

@extends('adminlte::page')

@section('title','produk')

@include('partials.head')

@section('content_header')
    <h1>Tambah Produk</h1>
@endsection

@section('content')

    <form action="{{ route('produk.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="nama_produk">Nama Produk </label>
                    <input type="text" name="nama_produk" class="form-control" required>
                </div>
            </div>
        <div class="col">
                <div class="form-group">
                    <label for="harga">Harga </label>
                    <input type="text" name="harga" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="kategori">Kategori </label>
                    <select name="kategori" class="form-control" required>
                        <option value="makanan">Makanan</option>
                        <option value="minuman">Minuman</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="stok">Stok </label>
                    <input type="text" name="stok" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group mb-3">
                    <label for="gambar">Gambar </label>
                    <input type="file" name="gambar" class="form-control" id="gambar">
                </div>
            </div>
                <button type="submit" class="btn btn-primary">Tambah Produk</button>

        </div>
    </form>
@stop
