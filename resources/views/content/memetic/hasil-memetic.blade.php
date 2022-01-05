@extends('master.master')

@section('title', 'SPP | Proses Algoritma Memetika')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Hasil Algoritma Memetika</h1>
                        <h1>Bulan {{$dataTanggal['namaBulan'] . ' ' . $dataTanggal['tahun']}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            {{-- <li class="breadcrumb-item"><a href="{{ route('piket-view-data') }}">Data Piket</a></li> --}}
                            <li class="breadcrumb-item active">Algoritma Memetika</li>
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
                        <h3 class="card-title p-3">Hasil Proses Algoritma Memetika</h3>
                        <ul class="nav nav-pills ml-auto p-2">
                            <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Hasil</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Populasi
                                    Awal</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Populasi
                                    Akhir</a>
                            <li class="nav-item"><a class="nav-link" href="#tab_4" data-toggle="tab">Fitness
                                    Populasi Awal</a>
                            <li class="nav-item"><a class="nav-link" href="#tab_5" data-toggle="tab">Fitness
                                    Populasi Akhir</a>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <form action="{{ route('proses-simpan-data-algoritma-memetika') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="dataJadwal" value="{{ serialize($jadwalAkhir) }}">

                                    <button type="submit" class="btn btn-primary btn-lg"> Simpan Data
                                    </button>
                                    <br>
                                    <br>
                                        {{-- <a class="btn btn-app">
                                            <i class="fas fa-save">
                                                <button type="submit">
                                                    Simpan Data</button></i> Save
                                        </a> --}}


                                </form>

                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center">Nama Pegawai</th>
                                            <th colspan="{{ $jumlahHari }}" rowspan="1" class="text-center">
                                                Tanggal</th>
                                        </tr>
                                        <tr>
                                            @for ($i = 0; $i < $jumlahHari; $i++)
                                                <th>{{ $i + 1 }}</th>
                                            @endfor
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for ($i = 0; $i < count($jadwalAkhir); $i++)
                                            <tr>
                                                <td>{{ $jadwalAkhir[$i]['namaPegawai'] }}</td>
                                                @for ($j = 0; $j < $jumlahHari; $j++)
                                                    @if (date('l', strtotime($jadwalAkhir[$i]['dataPiket'][$j]['tanggalPiket'])) === 'Sunday')
                                                        <td>Libur</td>
                                                    @else
                                                        <td>{{ $jadwalAkhir[$i]['dataPiket'][$j]['nilaiFitness'] }}</td>
                                                    @endif

                                                @endfor
                                                {{-- @foreach
                                                <td>{{$jadwalAkhir['dataPiket']}}</td>
                                                @endforeach --}}
                                            </tr>
                                        @endfor


                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th rowspan="2" class="text-center">Nama Pegawai</th>
                                            <th colspan="{{ $jumlahHari }}" rowspan="1" class="text-center">
                                                Tanggal</th>
                                        </tr>
                                        <tr>
                                            @for ($i = 0; $i < $jumlahHari; $i++)
                                                <th>{{ $i + 1 }}</th>
                                            @endfor
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">
                                <table id="" class=" table table-bordered table-striped display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID Pegawai</th>
                                            <th>Nama Pegawai</th>
                                            <th>ID Piket</th>
                                            <th>Nama Piket</th>
                                            <th>Hari</th>
                                            <th>Tanggal Piket</th>
                                            <th>Nilai Fitness</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($populasiAwal as $dataPopulasiAwal)
                                            <tr>
                                                <td>{{ $dataPopulasiAwal['idPegawai'] }}</td>
                                                <td>{{ $dataPopulasiAwal['namaPegawai'] }}</td>
                                                <td>{{ $dataPopulasiAwal['idPiket'] }}</td>
                                                <td>{{ $dataPopulasiAwal['namaPiket'] }}</td>
                                                <td>{{ $dataPopulasiAwal['hari'] }}</td>
                                                <td>{{ $dataPopulasiAwal['tanggal'] }}</td>
                                                <td>{{ $dataPopulasiAwal['nilaiFitness'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID Pegawai</th>
                                            <th>Nama Pegawai</th>
                                            <th>ID Piket</th>
                                            <th>Nama Piket</th>
                                            <th>Hari</th>
                                            <th>Tanggal Piket</th>
                                            <th>Nilai Fitness</th>
                                        </tr>

                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_3">
                                <table id="" class=" table table-bordered table-striped display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID Pegawai</th>
                                            <th>Nama Pegawai</th>
                                            <th>ID Piket</th>
                                            <th>Nama Piket</th>
                                            <th>Hari</th>
                                            <th>Tanggal Piket</th>
                                            <th>Nilai Fitness</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($populasiAkhir as $dataPopulasiAkhir)
                                            <tr>
                                                <td>{{ $dataPopulasiAkhir['idPegawai'] }}</td>
                                                <td>{{ $dataPopulasiAkhir['namaPegawai'] }}</td>
                                                <td>{{ $dataPopulasiAkhir['idPiket'] }}</td>
                                                <td>{{ $dataPopulasiAkhir['namaPiket'] }}</td>
                                                <td>{{ $dataPopulasiAkhir['hari'] }}</td>
                                                <td>{{ $dataPopulasiAkhir['tanggal'] }}</td>
                                                <td>{{ $dataPopulasiAkhir['nilaiFitness'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID Pegawai</th>
                                            <th>Nama Pegawai</th>
                                            <th>ID Piket</th>
                                            <th>Nama Piket</th>
                                            <th>Hari</th>
                                            <th>Tanggal Piket</th>
                                            <th>Nilai Fitness</th>
                                        </tr>

                                    </tfoot>
                                </table>
                            </div>
                            <div class="tab-pane" id="tab_4">
                                <canvas id="donutChartAwal"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                            <div class="tab-pane text-center" id="tab_5">
                                <canvas id="donutChartAkhir"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
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
    <script>
        /* Initialization of datatables */
        $(document).ready(function() {
            $('table.display').DataTable();
        });
    </script>
    <!-- FLOT CHARTS -->
    <script src="{{ asset('vendor/plugins/flot/jquery.flot.js') }}"></script>
    <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
    <script src="{{ asset('vendor/plugins/flot/plugins/jquery.flot.resize.js') }}"></script>
    <!-- FLOT PIE PLUGIN - also used to draw donut charts -->
    <script src="{{ asset('vendor/plugins/flot/plugins/jquery.flot.pie.js') }}"></script>
    <script>
        $(function() {

            //-------------
            //- DONUT CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var donutChartCanvasAwal = $('#donutChartAwal').get(0).getContext('2d')
            var donutData = {
                labels: [
                    'Fitness 3',
                    'Fitness 2',
                    'Fitness 1',
                    'Fitness 0',
                    'Fitness -1',
                ],
                datasets: [{
                    data: [
                        {{ $totalFitnessPopulasiAwal[0] }},
                        {{ $totalFitnessPopulasiAwal[1] }},
                        {{ $totalFitnessPopulasiAwal[2] }},
                        {{ $totalFitnessPopulasiAwal[3] }},
                        {{ $totalFitnessPopulasiAwal[4] }}
                    ],
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc'],
                }]
            }
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(donutChartCanvasAwal, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })

        })


        $(function() {

            //-------------
            //- DONUT CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var donutChartCanvasAkhir = $('#donutChartAkhir').get(0).getContext('2d')
            var donutData = {
                labels: [
                    'Fitness 3',
                    'Fitness 2',
                    'Fitness 1',
                    'Fitness 0',
                    'Fitness -1',
                ],
                datasets: [{
                    data: [
                        {{ $totalFitnessPopulasiAkhir[0] }},
                        {{ $totalFitnessPopulasiAkhir[1] }},
                        {{ $totalFitnessPopulasiAkhir[2] }},
                        {{ $totalFitnessPopulasiAkhir[3] }},
                        {{ $totalFitnessPopulasiAkhir[4] }}
                    ],
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc'],
                }]
            }
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(donutChartCanvasAkhir, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })

        })
    </script>

@endsection
