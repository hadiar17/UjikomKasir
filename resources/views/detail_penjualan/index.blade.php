@extends('adminlte::page')

@section('title','Detail Penjualan')

@section('content')


  <!-- Main content -->
  <div class="content mt-3">
    <div class="card card-info card-outline">
      <div class="card-header">
          <h3>Detail Penjualan</h3>
      </div>

      <div class="card-body">
        <table class="table table-bordered">
          <tr>
            <th>ID</th>
            <th>Tanggal Penjualan</th>
            <th>Produk</th>
            <th>Jumlah</th>
            {{-- <th>Subtotal</th> --}}
            <th>Total</th>
            <th>Bayar</th>
            <th>Kembalian</th>
            <th>Aksi</th>
          </tr>

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
        <td>
            @foreach($details as $detail)
                {{ $detail->produk->nama_produk }}{{ !$loop->last ? ',' : '' }} 
            @endforeach
        </td>
        <td>
            @foreach($details as $detail)
                {{ $detail->jumlah }}{{ !$loop->last ? ',' : '' }}
            @endforeach
        </td>
        {{-- <td><p>Rp.{{ number_format($details[0]->subtotal) }}</p></td> --}}
        <td><p>Rp.{{ isset($details[0]->penjualan) ? number_format($details[0]->penjualan->total, 0, ',', ',') : 'N/A' }}</p></td>
        <td><p>Rp.{{ isset($details[0]->penjualan) ? number_format($details[0]->penjualan->bayar, 0, ',', ',') : 'N/A' }}</p></td>
        <td><p>Rp.{{ isset($details[0]->penjualan) ? number_format($details[0]->penjualan->kembalian, 0, ',', ',') : 'N/A' }}</p></td>
        <td><a href="#" class="btn btn-warning">Edit</a>
            <form action=""method="post" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
        </td>
        </tr>
            @endforeach
            </table>
        </div>
    </div>
</div>

@stop