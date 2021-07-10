@extends('master.master')

@section('title', 'SPP | Lihat Data Pegawai Edit')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Lihat Data Pegawai Edit</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('pegawai-view-data')}}">Data Pegawai</a></li>
                            <li class="breadcrumb-item active">Lihat Data Pegawai Edit</li>
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
                                <h3>150</h3>

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
                <h5 class="mt-4 mb-2">Silahkan Pilih data yang akan diedit</h5>
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
                                        @for ($i = 0; $i <= 10; $i++)
                                        <tr>
                                            <td>Amelia</td>
                                            <td>Dokter</td>
                                            <td>Perempuan</td>
                                            <td>
                                                <a href="{{route('pegawai-edit-data-by-id')}}"><i class="fas fa-edit"></i></a>
                                                <a href="#"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>

                                        @endfor
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
