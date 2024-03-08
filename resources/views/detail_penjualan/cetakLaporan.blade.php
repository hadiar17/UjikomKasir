<html>
<head>
    <style>
        table.static{
            position: relative;
            border: 1px solid black ;

        }
    </style>
    <title>Cetak Laporan</title>
</head>
<body>
    <div class="form-group">
        <p align="center"><b>Laporan Transaksi</b></p>
        <table class="static" align="center" rules="all" border="1px" style="width: 60%">
            <tr>
                <td>No.</td>
                <td>Total</td>
                <td>Uang Bayar</td>
                <td>Kembalian</td>
            </tr>

            @foreach ($dtLaporan as $item)
            <tr>
               <td>{{ $loop->iteration }}</td>
               <td>{{ $item->penjualan->tanggal }}</td>
               {{-- <td>{{ $item->produk->nama_produk }}</td>
               <td>{{ $item->penjualan->jumlah }}</td> --}}
               <td>{{ $item->penjualan->total }}</td>
               <td>{{ $item->penjualan->bayar }}</td>
               <td>{{ $item->penjualan->kembalian }}</td>
            </tr>
            @endforeach

        </table>
    </div>

    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>
