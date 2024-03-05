@extends('adminlte::page')

@section('title', 'Penjualan')

@section('content_header')
    <h1>Daftar Penjualan</h1>
@endsection

@section('content')
    @if (session('success') || session('error'))
        @php
            $alertType = session('success') ? 'success' : 'warning';
        @endphp
        <div class="alert alert-{{ $alertType }} alert-dismissible fade show" role="alert">
            {{ session('success') ?? session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form action="{{ route('penjualan.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="tanggal">Tanggal:</label>
                    <input type="date" name="tanggal" class="form-control " required>
                </div>
                <div class="form-group">
                    <label for="produk">Produk:</label>
                    <select id="produk" name="produk_id" class="form-control" required>
                        <option value="">Pilih Produk</option>
                        @foreach($produks as $produk)
                            <option value="{{ $produk->id }}" data-harga="{{ $produk->harga }}">{{ $produk->nama_produk }} - Rp {{ number_format($produk->harga, 0, ',', '.') }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="jumlah">Jumlah:</label>
                    <input type="number" id="jumlah" name="jumlah" class="form-control" min="1" required>
                </div>
                <div class="form-group">
                    <label for="subtotal">Subtotal:</label>
                    <input type="text" id="subtotal" name="subtotal" class="form-control" readonly>
                </div>
                <button type="button" id="tambahProduk" class="btn btn-primary">Tambah Produk</button>
            </div>
            <div class="col">   
                <h3>Detail Penjualan</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
            <tbody id="detailPenjualan">
            </tbody>
        </table>
        <a href="{{ route('penjualan.create') }}">test</a>
        <button type="submit" class="btn btn-success">Simpan Penjualan</button>
    </form>
</div>
</div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Event listener untuk memperbarui subtotal saat memilih produk dan mengubah jumlah
            document.getElementById('produk').addEventListener('change', updateSubtotal);
            document.getElementById('jumlah').addEventListener('input', updateSubtotal);
            document.getElementById('tambahProduk').addEventListener('click', tambahProduk);
        });

        function updateSubtotal() {
            const harga = document.getElementById('produk').selectedOptions[0].getAttribute('data-harga');
            const jumlah = document.getElementById('jumlah').value;
            const subtotal = harga * jumlah;
            document.getElementById('subtotal').value = subtotal.toLocaleString('id-ID');
        }

        function tambahProduk() {
            const produkSelect = document.getElementById('produk');
            const produkOption = produkSelect.selectedOptions[0];
            const produkNama = produkOption.text.split(' - ')[0];
            const jumlah = document.getElementById('jumlah').value;
            const subtotal = document.getElementById('subtotal').value;

            const detailPenjualan = document.getElementById('detailPenjualan');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>${produkNama}</td>
                <td>${jumlah}</td>
                <td>${subtotal}</td>
                <td>
                    <button type="button" onclick="hapusProduk(this)" class="btn btn-danger">Hapus</button>
                    <input type="hidden" name="produk[${produkOption.value}][id]" value="${produkOption.value}">
                    <input type="hidden" name="produk[${produkOption.value}][jumlah]" value="${jumlah}">
                </td>
            `;
            detailPenjualan.appendChild(newRow);
        }

        function hapusProduk(button) {
            button.closest('tr').remove();
        }


    </script>
@endsection 
