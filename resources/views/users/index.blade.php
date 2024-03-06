@extends('adminlte::page')

@section('title', 'Produk')

@section('content')


    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Data User</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="card card-info card-outline">
          <div class="card-header">
            <div class="card-tools">
              <a href="{{ route('users.create') }}" class="btn btn-primary">Tambah User   <i class="fas fa-plus-square"></i></a>
            </div>
          </div>

          <div class="card-body">
            <table class="table table-bordered">
              <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>role</th>
                  <th>Email</th>
                  <th>Aksi</th>
              </tr>

                <?php $no = 1; ?>

              @foreach ($users as $user)
              <tr>
                <td>{{ $no++ }}</td>
                <td >{{ $user->name }}</td>
                <td >{{ $user->role }}</td>
                <td >{{ $user->email }}</td>
                <td><a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning m-1 ">Edit</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="post" style="display: inline">
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
