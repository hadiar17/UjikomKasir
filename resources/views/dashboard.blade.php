
@extends('adminlte::page')

@section('title', 'Produk')
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

@section('content')

    
@if(session('error'))
<div class="alert alert-warning alert-dismissible fade show mt-3" role="alert"">
    {{session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

    <div class="container-fluid mt-3">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                <h3>{{ $produks }}</h3>

                <p>Total Produk</p>
                </div>
                <div class="icon">
                <i class="ion ion-bag"></i>
                </div>
            </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                <h3>{{ $penjualans }}</h3>

                <p>Transaksi</p>
                </div>
                <div class="icon">
                <i class="ion ion-stats-bars"></i>
                </div>
            </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                <h3>{{ $users }}</h3>

                <p>Pengguna</p>
                </div>
                <div class="icon">
                <i class="ion ion-person-add"></i>
                </div>
            </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                <h3>{{ $detailPenjualans }}</h3>

                <p>Riwayat Transaksi</p>
                </div>
                <div class="icon">
                <i class="ion ion-pie-graph"></i>
                </div>
            </div>
            </div>
            <!-- ./col -->
        </div>
        
        <div class="row">
        
                <div class="card" style="width: 20rem;">
                    <div class="card-body ">
                        <p>Produk Terlaris</p>
                        <div class="cart">
                            <canvas id="donutChart" style="min-height:200px ; height:250px ; max-height:300px ; min-width:200px ; width:250px ; max-width:300px ;" width="200" height="200"></canvas>
                        </div>
                    </div>
                </div>
         

            <div class="col-7">
                <div class="card" style="width: 25rem;">
                    <div class="card-body ">
                        <p>Pendapatan Perbulan</p>
                        <div class="cart">
                            <canvas id="myChart" style="min-height:200px ; height:250px ; max-height:300px ; min-width:200px ; width:250px ; max-width:300px ;" width="200" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($dataIncome['labels']) !!},
            datasets: [{
                label: 'Income per Month',
                data: {!! json_encode($dataIncome['data']) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });




            var ctx = document.getElementById('donutChart').getContext('2d');
            var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: @json($dataDonut['labels']),
                datasets: [{
                    data: @json($dataDonut['data']),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
                    borderWidth: 1
                }]
            },
        });
        </script>

    


@stop