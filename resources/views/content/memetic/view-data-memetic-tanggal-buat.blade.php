@extends('master.master')

@section('title', 'SPP | Hasil Algoritma Memetika')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Hasil Algoritma Memetika</h1>
                        {{-- <h1>{{print_r($dataPenjadwalan[0]['dataPiket'][31])}}</h1> --}}
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
                            <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Hasil
                                    Akurasi</a>
                            </li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
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
                                        @for ($i = 0; $i < count($dataPenjadwalan); $i++)
                                            <tr>
                                                <td>{{ $dataPenjadwalan[$i]['namaPegawai'] }}</td>
                                                @for ($j = 0; $j < $jumlahHari; $j++)

                                                    <td>
                                                        {{-- {{ route('edit-data-penjadwalan-algoritma-neuro-fuzzy', ['id_penjadwalan_neuro_fuzzy' => $dataPenjadwalan[$i]['dataPiket'][$j]['idPenjadwalanMemetika'], 'tanggal_piket' => $j + 1]) }} --}}

                                                        <a
                                                            href="http://127.0.0.1:8000/algoritma/memetika/edit-data/{{ $j + 1 }}/{{ $dataPenjadwalan[$i]['dataPiket'][$j]['idPenjadwalanMemetika'] }}">
                                                            @if (date('l', strtotime($dataPenjadwalan[$i]['dataPiket'][$j]['tanggalPenjadwalan'])) === 'Sunday')

                                                                Libur
                                                            @elseif ($dataPenjadwalan[$i]['dataPiket'][$j]['kodePiket']
                                                                ===
                                                                '')
                                                                -
                                                            @else
                                                                {{ $dataPenjadwalan[$i]['dataPiket'][$j]['kodePiket'] }}
                                                        </a>
                                                    </td>

                                                @endif
                                                </td>
                                        @endfor


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
                            <div class="tab-pane" id="tab_2">
                                <canvas id="donutChartAwal"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                            <!-- /.tab-pane -->

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
                    'Fitness Kosong'

                ],
                datasets: [{
                    data: [
                        {{ $dataNilaiFitness['dataNilaiFitnessMaksimum'] }},
                        {{ $dataNilaiFitness['dataNilaiFitnessDua'] }},
                        {{ $dataNilaiFitness['dataNilaiFitnessSatu'] }},
                        {{ $dataNilaiFitness['dataNilaiFitnessNol'] }},
                        {{ $dataNilaiFitness['dataNilaiFitnessMinimum'] }},
                        {{ $dataNilaiFitness['dataNilaiFitnessKosong'] }}

                    ],
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
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
    </script>
@endsection
