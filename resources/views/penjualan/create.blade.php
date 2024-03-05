<!-- resources/views/penjualan/create.blade.php -->

@extends('adminlte::page')

@section('title','penjualan')

@include('script')
    

@section('css')
    @parent
    <style>
        body {
            overflow: hidden;
        }
    </style>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <!-- Tampilkan daftar produk -->
        <div class="col-md-9" style="max-height: 90vh; overflow-y: auto;">
            <div class="row">
                @foreach ($produks as $produk)
                <div class="col-lg-3 col-md-6 col-xs-12 mb-4 mt-3"> 
                    <div class="card product-card">
                        <div class="produk" data-id="{{ $produk->id }}" data-nama="{{ $produk->nama_produk }}" data-stok="{{ $produk->stok }}" data-harga="{{ $produk->harga }}" data-jumlah="1">
                            <img src="{{ asset('uploads/' . $produk->gambar) }}" class="card-img-top product-img" alt="{{ $produk->nama_produk }}" width="200px" height="200px">
                            <div class="card-body">
                                <h5 class="card-title"><b>{{ $produk->nama_produk }}</b></h5>
                                <br>
                                <p class="card-text badge badge-success">Rp. {{ number_format($produk->harga, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        <div class="col-lg-3 col-md-12 mb-4 mt-3">
            <div class="card">
                <div class="card-header">
                    Keranjang
                </div>
                <form action="{{ route('penjualan.store') }}" method="POST">
                    @csrf
                <div class="card-body" style="overflow-y: auto; min-height:30vh; max-height: 30vh;" id="daftar-transaksi">
                    <!-- Baris transaksi akan ditambahkan di sini -->
                </div>

                <div class="card-footer">
                    <div class="mb-3">
                        <label for="totalharga" class="form-label">Total Harga</label>
                        <input type="number" name="total" class="form-control" id="totalharga" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah-bayar" class="form-label">Jumlah Bayar</label>
                        <input type="number" name="bayar" class="form-control" id="jumlah-bayar">
                    </div>
                    <div class="mb-3">
                        <label for="kembalian" class="form-label">Kembalian</label>
                        <input type="number" name="kembalian" class="form-control" id="kembalian" readonly>
                    </div>
                    
                    <button type="submit" class="btn btn-primary" id="btn-simpan">Simpan Transaksi</button>
                </div>
            </form>
            </div>
        </div>

    </div>
</div>

<!-- Script JavaScript -->
<script>
 document.addEventListener('DOMContentLoaded', function() {
    var daftarTransaksi = {}; // Objek untuk menyimpan transaksi dengan id produk sebagai kunci
    var totalHarga = 0;

    var produkItems = document.querySelectorAll('.produk');
    produkItems.forEach(function(produkItem) {
        produkItem.addEventListener('click', function() {
            var id = produkItem.getAttribute('data-id');
            var nama = produkItem.getAttribute('data-nama');
            var harga = parseFloat(produkItem.getAttribute('data-harga'));
            var stok = produkItem.getAttribute('data-stok');
            var gambar = produkItem.querySelector('img').src; // Ambil URL gambar produk

            tambahkanProdukKeTransaksi(id, nama, harga, stok, gambar,);
        });
    });

    function tambahkanProdukKeTransaksi(id, nama, harga, stok, gambar) {
        if (!daftarTransaksi[id]) {
            daftarTransaksi[id] = {
                nama: nama,
                jumlah: 1,
                harga: harga,
                stok : stok,
                subtotal: harga,
                gambar: gambar // Simpan URL gambar produk
            };

            // Tambahkan item baru ke daftar transaksi
            var transaksiBaru = `
            <div id="transaksi-${id}" class="transaksi-item mb-3">
                <input type = "hidden" name="id_produk[]" value="${id}"> 
                <input type = "hidden" name="jumlah[]" value="${1}"> 
                <input type = "hidden" name="subtotal[]" value="${harga}"> 

                <div class="info-box">
                    <div style="display: flex; align-item:center;">
                        <img src="${gambar}" alt="${nama}" class="info-box-img" width="70px" height="70px">
                        <div class="info-box-content">
                            <div class="info-box-text">${nama}</div>
                            <div class="info-box-number">Jumlah: <span class="jumlah">${daftarTransaksi[id].jumlah}</span></div>
                            <p class="card-text badge ">Rp. <span class="subtotal">${harga.toLocaleString()}</span></p>
                        </div>
                    </div>
                </div>
            </div>
            `;
            document.querySelector('#daftar-transaksi').insertAdjacentHTML('beforeend', transaksiBaru);

        } else {
            // Jika item sudah ada di daftar, tambahkan jumlah dan subtotal
            if(daftarTransaksi[id].jumlah < stok) { //memeriksa jumlah sudah mencapai stok
            daftarTransaksi[id].jumlah++;
            daftarTransaksi[id].subtotal += harga;

            // Perbarui tampilan jumlah dan subtotal
            var transaksiItem = document.querySelector(`#transaksi-${id}`);
            transaksiItem.querySelector('.jumlah').textContent = daftarTransaksi[id].jumlah;
            transaksiItem.querySelector('.subtotal').textContent = daftarTransaksi[id].subtotal.toLocaleString();

            transaksiItem.querySelector('input[name="jumlah[]"]').value = daftarTransaksi[id].jumlah;
            transaksiItem.querySelector('input[name="subtotal[]"]').value = daftarTransaksi[id].subtotal;
            
            } else {
                //jika jumlah sudah mencapai stok tampilkan
                alert('Stok produk tidak mecukupi')

            }
        }
        totalHarga = hitungTotalHarga(); // Update total harga
        $('#totalharga').val(totalHarga); // Tampilkan total harga

        hitungJumlahBayarDanKembalian();

    }

    function hitungTotalHarga() {
        totalHarga = 0;

        for (var id in daftarTransaksi) {
            totalHarga += daftarTransaksi[id].subtotal;
        }

        return totalHarga;
    }

    function hitungJumlahBayarDanKembalian() {
        var jumlahBayar = parseFloat(document.getElementById('jumlah-bayar').value.replace(',', '')); // Menghapus tanda koma
        if(isNaN(jumlahBayar)) {
            $('#kembalian').val('');
            return;
        }   

        var kembalian = jumlahBayar - totalHarga;


        console.log('Kembalian: Rp. ' + kembalian.toLocaleString());
        $('#kembalian').val(kembalian);
    }

   // Hitung total harga saat halaman dimuat
   totalHarga = hitungTotalHarga();
    $('#totalharga').val(totalHarga);

    // Tambahkan event listener untuk tombol hitung total
    document.getElementById('jumlah-bayar').addEventListener('input', function() {
        hitungJumlahBayarDanKembalian();
    });

});

</script>

@stop

