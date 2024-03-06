<!-- resources/views/produk/index.blade.php -->

@extends('adminlte::page')

@section('title', 'Produk')

@section('content')

    @if(session('success') || session('hapus'))
        @php
            $alertType = session('success') ? 'success' : 'warning';
        @endphp
        <div class="alert alert-{{ $alertType }} alert-dismissible fade show mt-3" role="alert"">
            {{ session('success') ?? session('hapus') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Produk</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Data Produk</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>

   

    <div class="content">
        <div class="card card-info card-outline">
          <div class="card-header">
            <div class="card-tools">
                <a href="{{ route('produk.create') }}" class="btn btn-primary">Tambah Produk  <i class="fas fa-plus-square"></i></a>
            </div>
          </div>

          <div class="card-body">
            <table class="table table-bordered">
              <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Foto</th>
                <th>Harga</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Aksi</th>
              </tr>

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
                    <td><a href="{{ route('produk.edit',$produk->id) }}" class="btn btn-warning m-1 ">Edit</a>
                        <form action="{{ route('produk.destroy', $produk->id) }}" method="post" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin Hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach 
        </table>
    </div>
  </div>
</div>


@stop
