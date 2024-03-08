@extends('adminlte::page')

@section('title','Detail Penjualan')

@section('content')


  <!-- Main content -->
  <div class="content mt-3">
    <div class="card card-info card-outline">
      <div class="card-header">
         <div class="card-tools">
            <a href="{{ route('cetakLaporan') }}" target="_blank" class="btn btn-success">Cetak Laporan <i class="fas fa-print"></i></a>
            </div> 
      </div>

      <div class="card-body">
        <table class="table table-bordered">
          <tr>
            <th>No</th>
            <th>Tanggal Penjualan</th>
            <th>Produk</th>
            <th>Jumlah</th>
            {{-- <th>Subtotal</th> --}}
            <th>Total</th>
            <th>Bayar</th>
            <th>Kembalian</th>
            {{-- <th>Aksi</th> --}}
          </tr>

       @php
    $groupedDetails = [];
    foreach ($detailPenjualans as $detailPenjualan) {
        $groupedDetails[$detailPenjualan->penjualan_id][] = $detailPenjualan;
    }
@endphp

<?php $no = 1; ?>

@foreach($groupedDetails as $penjualanId => $details)
    <tr>
        {{-- <td>{{ $details[0]->id }}</td> --}}
        <td>{{ $no++ }}</td>
        <td>{{ $details[0]->penjualan_id ? $details[0]->penjualan->tanggal : 'N/A' }}</td>

        <td class="col-3">
            @foreach($details as $detail)
                {{ $detail->produk->nama_produk }}{{ !$loop->last ? ',' : '' }} 
            @endforeach
        </td>
        <td>
            @foreach($details as $detail)
                {{ $detail->jumlah }}{{ !$loop->last ? ',' : '' }}
            @endforeach
        </td>
        <td><p>Rp.{{ isset($details[0]->penjualan) ? number_format($details[0]->penjualan->total, 0, ',', ',') : 'N/A' }}</p></td>
        <td><p>Rp.{{ isset($details[0]->penjualan) ? number_format($details[0]->penjualan->bayar, 0, ',', ',') : 'N/A' }}</p></td>
        <td><p>Rp.{{ isset($details[0]->penjualan) ? number_format($details[0]->penjualan->kembalian, 0, ',', ',') : 'N/A' }}</p></td>

    </tr>
@endforeach

            </table>
        </div>
    </div>
</div>

@stop