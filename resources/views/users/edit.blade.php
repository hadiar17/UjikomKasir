@extends('adminlte::page')

@section('title', 'Produk')

@include('partials.head')

@section('content')

        <div class="card card-info card-outline mt-3">
            <div class="card-header">
                <h3>Edit Data User</h3>
            </div>
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="name">Nama </label>
                            <input type="text" name="name" class="form-control mb-3" value="{{ $user->name }}" autocomplete="off" autofocus required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="role">Role </label>
                            <select class="form-control" name="role" autofocus required>
                                <option value="">--Pilih Role--</option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="pegawai" {{ $user->role === 'pegawai' ? 'selected' : '' }}>pegawai</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="email">Email </label>
                            <input type="email" name="email" class="form-control mb-3" value="{{ $user->email }}" autocomplete="off" autofocus required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="password">Password :</label>
                            <input type="password" name="password" class="form-control mb-1" minlength="8" autofocus>
                            <small class="text-muted">*Kosongkan jika tidak ingin mengubah password.</small>
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