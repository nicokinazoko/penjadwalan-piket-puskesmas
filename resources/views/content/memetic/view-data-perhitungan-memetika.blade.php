@extends('master.master')

@section('title', 'SPP | Lihat Data Perhitungan Algoritma Memetika')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Hasil Algoritma Memetika</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            {{-- <li class="breadcrumb-item"><a href="{{ route('piket-view-data') }}">Data Piket</a></li> --}}
                            <li class="breadcrumb-item active"><a href="{{ route('view-memetika') }}">Algoritma
                                    Memetika</a>
                            </li>
                            <li class="breadcrumb-item active">View Data Perhitungan Algoritma Memetika</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                {{-- form --}}
                <div class="card">
                    <div class="card-header d-flex p-0">
                        <h3 class="card-title p-3">Hasil Proses Algoritma Genetika</h3>
                        <ul class="nav nav-pills ml-auto p-2">
                            <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Hasil</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Chart</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Populasi
                                    Akhir</a>
                                {{-- <li class="nav-item"><a class="nav-link" href="#tab_4" data-toggle="tab">Fitness
                                    Populasi Awal</a>
                                <li class="nav-item"><a class="nav-link" href="#tab_5" data-toggle="tab">Fitness
                                    Populasi Akhir</a> --}}
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">

                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Tanggal Jadwal</th>
                                            <th class="text-center">Tanggal Jumlah Populasi </th>
                                            <th class="text-center">Jumlah Generasi </th>
                                            <th class="text-center">Crossover Rate</th>
                                            <th class="text-center">Mutation Rate</th>
                                            <th class="text-center">Waktu Proses</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @foreach ($dataPerhitunganMemetika as $dataMemetika)
                                            <tr>
                                                <td><a href="{{ route('view-data-perhitungan-algoritma-memetika-by-tanggal', ['tanggal_pembuatan' => $dataMemetika->tanggal_pembuatan_jadwal]) }}"
                                                        }>
                                                        {{ $dataMemetika->tanggal_pembuatan_jadwal }}</a></td>
                                                <td>{{ $dataMemetika->jumlah_populasi }}</td>
                                                <td>{{ $dataMemetika->jumlah_generasi }}</td>
                                                <td>{{ $dataMemetika->mutation_rate }}</td>
                                                <td>{{ $dataMemetika->crossover_rate }}</td>
                                                <td>{{ $dataMemetika->selisih_waktu }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center">Tanggal Jadwal</th>
                                            <th class="text-center">Tanggal Jumlah Populasi </th>
                                            <th class="text-center">Jumlah Generasi </th>
                                            <th class="text-center">Crossover Rate</th>
                                            <th class="text-center">Mutation Rate</th>
                                            <th class="text-center">Waktu Proses</th>
                                        </tr>

                                    </tfoot>
                                </table>
                            </div>
                            <div class="tab-pane" id="tab_2">
                                <div class="chart">
                                    <canvas id="areaChart"
                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_3">
                                <div class="chart">
                                    <canvas id="lineChart"
                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>

                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
    </div>
    <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection


@section('addons-scripts')
    {{-- @include('layouts.footer.form-scripts') --}}
    @include('layouts.footer.table-data-scripts')
    <!-- uPlot -->

    <script>
        /* Initialization of datatables */
        $(document).ready(function() {
            $('table.display').DataTable();
        });
    </script>
    <script>
        $(function() {
            /* ChartJS
             * -------
             * Here we will create a few charts using ChartJS
             */

            //--------------
            //- AREA CHART -
            //--------------

            // Get context with jQuery - using jQuery's .get() method.
            var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

            var areaChartData = {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                        label: 'Digital Goods',
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: [28, 48, 40, 19, 86, 27, 90]
                    },
                    {
                        label: 'Electronics',
                        backgroundColor: 'rgba(210, 214, 222, 1)',
                        borderColor: 'rgba(210, 214, 222, 1)',
                        pointRadius: false,
                        pointColor: 'rgba(210, 214, 222, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: [65, 59, 80, 81, 56, 55, 40]
                    },
                ]
            }

            var areaChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: false,
                        }
                    }]
                }
            }

            // This will get the first returned node in the jQuery collection.
            new Chart(areaChartCanvas, {
                type: 'line',
                data: areaChartData,
                options: areaChartOptions
            })

            //-------------
            //- LINE CHART -
            //--------------
            var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
            var lineChartOptions = $.extend(true, {}, areaChartOptions)
            var lineChartData = $.extend(true, {}, areaChartData)
            lineChartData.datasets[0].fill = false;
            lineChartData.datasets[1].fill = false;
            lineChartOptions.datasetFill = false

            var lineChart = new Chart(lineChartCanvas, {
                type: 'line',
                data: lineChartData,
                options: lineChartOptions
            })

            //-------------
            //- DONUT CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
            var donutData = {
                labels: [
                    'Chrome',
                    'IE',
                    'FireFox',
                    'Safari',
                    'Opera',
                    'Navigator',
                ],
                datasets: [{
                    data: [700, 500, 400, 600, 300, 100],
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                }]
            }
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })

            //-------------
            //- PIE CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
            var pieData = donutData;
            var pieOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(pieChartCanvas, {
                type: 'pie',
                data: pieData,
                options: pieOptions
            })

            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            var temp1 = areaChartData.datasets[1]
            barChartData.datasets[0] = temp1
            barChartData.datasets[1] = temp0

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            }

            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })

            //---------------------
            //- STACKED BAR CHART -
            //---------------------
            var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
            var stackedBarChartData = $.extend(true, {}, barChartData)

            var stackedBarChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{
                        stacked: true,
                    }],
                    yAxes: [{
                        stacked: true
                    }]
                }
            }

            new Chart(stackedBarChartCanvas, {
                type: 'bar',
                data: stackedBarChartData,
                options: stackedBarChartOptions
            })
        })
    </script>

@endsection
