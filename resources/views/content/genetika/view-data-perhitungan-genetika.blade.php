@extends('master.master')

@section('title', 'SPP | Lihat Data Perhitungan Algoritma Genetika')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Hasil Algoritma Genetika</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            {{-- <li class="breadcrumb-item"><a href="{{ route('piket-view-data') }}">Data Piket</a></li> --}}
                            <li class="breadcrumb-item active"><a href="{{ route('view-genetika') }}">Algoritma
                                    Genetika</a>
                            </li>
                            <li class="breadcrumb-item active">View Data Perhitungan Algoritma Genetika</li>
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
                            {{-- <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Populasi
                                    Awal</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Populasi
                                    Akhir</a>
                            <li class="nav-item"><a class="nav-link" href="#tab_4" data-toggle="tab">Fitness
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
                                            <th class="text-center">Nilai Fitness 3</th>
                                            <th class="text-center">Nilai Fitness 2</th>
                                            <th class="text-center">Nilai Fitness 1</th>
                                            <th class="text-center">Nilai Fitness 0</th>
                                            <th class="text-center">Nilai Fitness -1</th>
                                            <th class="text-center">Nilai Fitness Kosong</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <tr>
                                            @foreach ($dataPerhitunganGenetika as $dataGenetika)
                                                <td>
                                                    <a
                                                        href="{{ route('view-data-penjadwalan-algoritma-genetika', ['tanggal_pembuatan' => $dataGenetika->tanggal_pembuatan_jadwal]) }}">
                                                        {{ date('d F Y H:i:s', strtotime($dataGenetika->tanggal_pembuatan_jadwal)) }}
                                                    </a>
                                                </td>
                                                <td>{{ $dataGenetika->jumlah_populasi }}</td>
                                                <td>{{ $dataGenetika->jumlah_generasi }}</td>
                                                <td>{{ $dataGenetika->mutation_rate }}</td>
                                                <td>{{ $dataGenetika->crossover_rate }}</td>
                                                <td>{{ $dataGenetika->selisih_waktu }}</td>
                                                <td>{{ $dataGenetika->nilai_fitness_tiga }}</td>
                                                <td>{{ $dataGenetika->nilai_fitness_dua }}</td>
                                                <td>{{ $dataGenetika->nilai_fitness_satu }}</td>
                                                <td>{{ $dataGenetika->nilai_fitness_nol }}</td>
                                                <td>{{ $dataGenetika->nilai_fitness_min_satu }}</td>
                                                <td>{{ $dataGenetika->nilai_fitness_kosong }}</td>
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
                                            <th class="text-center">Nilai Fitness 3</th>
                                            <th class="text-center">Nilai Fitness 2</th>
                                            <th class="text-center">Nilai Fitness 1</th>
                                            <th class="text-center">Nilai Fitness 0</th>
                                            <th class="text-center">Nilai Fitness -1</th>
                                            <th class="text-center">Nilai Fitness Kosong</th>
                                        </tr>

                                    </tfoot>
                                </table>
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
@endsection
