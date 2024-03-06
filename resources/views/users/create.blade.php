@extends('adminlte::page')

@section('title', 'Produk')

@include('partials.head')

@section('content')

    <div class="card card-info card-outline mt-3">
        <div class="card-header">
            <h4>Tambah User</h4>
        </div>
      <div class="card-body">
       <form action="{{ route('users.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="name">Nama </label>
                        <input type="text" name="name" class="form-control mb-3" autocomplete="off" autofocus required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="role">Role </label>
                        <select class="form-control" name="role" autofocus required>
                        <option value="">--Pilih Role--</option>
                        <option value="admin">Admin</option>
                        <option value="pegawai">Pegawai</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="email">Email </label>
                        <input type="email" name="email" class="form-control mb-3" autocomplete="off" autofocus required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="password">Password :</label>
                        <input type="password" name="password" class="form-control mb-3" minlength="8" autofocus required>
                    </div>
                </div>
            </div>
            <div class="row">
                    <button type="submit" class="btn btn-primary">Simpan</button>
            </div>  
        </form>
      </div>
    </div>
   
@stop