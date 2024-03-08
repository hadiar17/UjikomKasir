<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Produk;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\DetailPenjualan;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() 
    {
        $produks = Produk::count();
        $penjualans = Penjualan::count();
        $detailPenjualans = DetailPenjualan::count();
        $users = User::count();

        $mostPurchasedProducts = DetailPenjualan::select('produk_id', DB::raw('SUM(jumlah) as total_quantity'))
            ->with('produk') // Memuat relasi Product
            ->leftJoin('produks', 'produk_id', '=', 'produks.id')
            ->groupBy('produk_id')
            ->orderByDesc('total_quantity')
            ->limit(5) // Ambil 5 produk teratas
            ->get();


        // Inisialisasi array untuk menyimpan data
        $donutLabels = [];
        $donutData = [];

        // Loop melalui data produk yang paling banyak dibeli dan menyimpannya ke dalam array
        foreach ($mostPurchasedProducts as $produk) {
            $donutLabels[] = $produk->produk->nama_produk; // Mengambil nama produk dari relasi
            $donutData[] = $produk->total_quantity;
        }

        // Membuat array untuk dataDonut
        $dataDonut = [
            'labels' => $donutLabels,
            'data' => $donutData
        ];

        $incomePerMonth = DetailPenjualan::select(DB::raw('DATE_FORMAT(penjualans.tanggal, "%Y-%m") as month'), DB::raw('SUM(detail_penjualans.jumlah * produks.harga) as total_income'))
            ->join('penjualans', 'penjualans.id', '=', 'detail_penjualans.penjualan_id')
            ->join('produks', 'produks.id', '=', 'detail_penjualans.produk_id')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $dataIncome = [
            'labels' => $incomePerMonth->pluck('month'),
            'data' => $incomePerMonth->pluck('total_income')
        ];


        return view('dashboard', compact('produks','penjualans','detailPenjualans','users','mostPurchasedProducts','dataDonut','incomePerMonth','dataIncome'));
    }
}
