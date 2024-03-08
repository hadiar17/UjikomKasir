<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi</title>
    <style>
        /* CSS untuk struk */
    </style>
</head>
<body>
    <h2>Struk Transaksi</h2>
    <p><strong>Tanggal:</strong> {{ $detailTransaksi['tanggal'] }}</p>
    <hr>
    <h3>Detail Transaksi:</h3>
    <ul>
        @foreach($detailTransaksi['details'] as $detail)
            <li>{{ $detail['nama_produk'] }} - {{ $detail['jumlah'] }} x Rp{{ $detail['harga'] }} = Rp{{ $detail['subtotal'] }}</li>
        @endforeach
    </ul>
    <hr>
    <p><strong>Total:</strong> Rp{{ $detailTransaksi['total'] }}</p>
</body>
</html>
