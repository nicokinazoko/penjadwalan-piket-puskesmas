@extends('master.master')

@section('title', 'SPP | Lihat Data Pegawai')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Lihat Data Pegawai</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('pegawai-view-data') }}">Data Pegawai</a>
                            </li>
                            <li class="breadcrumb-item active">Lihat Data Pegawai</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">


                <!-- =========================================================== -->
                <h5 class="mt-4 mb-2">Jumlah Data Pegawai yang Sudah Ada</h5>
                <div class="row">
                    <div class="col-lg-3 col-4">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $dataTotal['dataPegawai'] }}</h3>
                                <p>Data Pegawai</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-nurse"></i>
                            </div>
                            <a href="{{ route('pegawai-input-data') }}" class="small-box-footer">Input Data <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <!-- =========================================================== -->
                <h5 class="mt-4 mb-2">Data Pegawai yang Sudah Ada</h5>
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">DataTable with default features</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama Pegawai</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Jabatan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pegawai as $dataPegawai)
                                            <tr>
                                                <td>{{ $dataPegawai->nama_pegawai }}</td>
                                                <td>{{ $dataPegawai->nama_jenis_kelamin }}</td>
                                                <td>{{ $dataPegawai->nama_jabatan }}</td>
                                                <td>
                                                    <center>
                                                        <a
                                                            href="{{ route('pegawai-edit-data-by-id', ['id_pegawai' => $dataPegawai->id_pegawai]) }}"><i
                                                                class="fas fa-edit"></i></a>
                                                        <a
                                                            href="{{ route('pegawai-delete-data', ['id_pegawai' => $dataPegawai->id_pegawai]) }}"><i
                                                                class="fas fa-trash-alt"></i></a>
                                                    </center>

                                                </td>
                                            </tr>

                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Nama Pegawai</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Jabatan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
            <i class="fas fa-chevron-up"></i>
        </a>
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('addons-scripts')
    @include('layouts.footer.table-data-scripts')
@endsection
