@extends('master.master')

@section('title', 'SPP | Proses Algoritma Neuro Fuzzy')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Hasil Algoritma Neuro Fuzzy</h1>
                        <h1>Bulan {{ date('F Y', strtotime($dataPenjadwalan[0]['dataPiket'][0]['tanggalPenjadwalan'])) }}
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            {{-- <li class="breadcrumb-item"><a href="{{ route('piket-view-data') }}">Data Piket</a></li> --}}
                            <li class="breadcrumb-item active">Algoritma Neuro Fuzzy</li>
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
                        <h3 class="card-title p-3">Hasil Proses Algoritma Neuro Fuzzy</h3>
                        <ul class="nav nav-pills ml-auto p-2">
                            <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Hasil</a>
                            </li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
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
                                                {{-- {{  }} --}}
                                                <td>
                                                    <a
                                                        href="{{ route('edit-data-penjadwalan-algoritma-neuro-fuzzy', ['id_penjadwalan_neuro_fuzzy' => $dataPenjadwalan[$i]['dataPiket'][$j]['idPenjadwalanNeuroFuzzy'], 'tanggal_piket' => $j + 1]) }}">
                                                        @if (date('l', strtotime($dataPenjadwalan[$i]['dataPiket'][$j]['tanggalPenjadwalan'])) === 'Sunday')

                                                            Libur
                                                        @elseif ($dataPenjadwalan[$i]['dataPiket'][$j]['kodePiket'] ===
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

@endsection
