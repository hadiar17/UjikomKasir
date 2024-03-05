<!-- resources/views/produk/index.blade.php -->

@extends('adminlte::page')

@section('title', 'Produk')

@section('content_header')
    <h1>Daftar Produk</h1>
@stop

@section('content')

    @if(session('success') || session('hapus'))
        @php
            $alertType = session('success') ? 'success' : 'warning';
        @endphp
        <div class="alert alert-{{ $alertType }} alert-dismissible fade show" role="alert"">
            {{ session('success') ?? session('hapus') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <a href="{{ route('produk.create') }}" class="btn btn-primary">Tambah Produk</a>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Foto</th>
                <th>Harga</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            @foreach($produks as $produk)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td >{{ $produk->nama_produk }}</td>
                    <td><img src="{{ asset('uploads/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}" class="rounded" style="max-width: 150px; max-height: 150px;">
                    </td>
                    <td><p>Rp. {{ number_format($produk->harga) }}</p></td>
                    <td>{{ $produk->kategori }}</td>
                    <td>{{ $produk->stok }}</td>
                    <td>
                       
                        <a href="#" class="btn btn-primary">Detail</a>
                        <a href="{{ route('produk.edit',$produk->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('produk.destroy', $produk->id) }}" method="post" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                    </td>
                </tr>
            @endforeach 
        </tbody>
    </table>

@stop
