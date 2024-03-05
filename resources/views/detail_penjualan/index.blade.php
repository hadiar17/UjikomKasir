@extends('adminlte::page')

@section('title','Detail Penjualan')
    
@section('content_header')
    <h1>Detail Penjualan</h1>
@endsection

@section('content')

<a href="" class="btn btn-primary">Tambah Detail Penjualan</a>

<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tanggal Penjualan</th>
            <th>Produk</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
            <th>Total</th>
            <th>Bayar</th>
            <th>Kembalian</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>

    @php
        $groupedDetails = [];
        foreach ($detailPenjualans as $detailPenjualan) {
            $groupedDetails[$detailPenjualan->penjualan_id][] = $detailPenjualan;
        }
    @endphp

@foreach($groupedDetails as $penjualanId => $details)
    <tr>
        <td>{{ $details[0]->id }}</td>
        <td>{{ $details[0]->penjualan_id ? $details[0]->penjualan->tanggal : 'N/A' }}</td>
        <td>{{ $details[0]->produk_id ? $details[0]->produk->nama_produk : 'N/A' }} </td>
        <td>
            @foreach($details as $detail)
                {{ $detail->jumlah }}{{ !$loop->last ? ',' : '' }}
            @endforeach
        </td>
        <td><p>Rp.{{ number_format($details[0]->subtotal) }}</p></td>
        <td><p>Rp.{{ isset($details[0]->penjualan) ? number_format($details[0]->penjualan->total, 0, ',', ',') : 'N/A' }}</p></td>
        <td><p>Rp.{{ isset($details[0]->penjualan) ? number_format($details[0]->penjualan->bayar, 0, ',', ',') : 'N/A' }}</p></td>
        <td><p>Rp.{{ isset($details[0]->penjualan) ? number_format($details[0]->penjualan->kembalian, 0, ',', ',') : 'N/A' }}</p></td>
        <td>
            <a href="#" class="btn btn-warning">Edit</a>
            <a href="#" class="btn btn-danger">Hapus</a>
        </td>
    </tr>
@endforeach

    </tbody>
</table>

@stop