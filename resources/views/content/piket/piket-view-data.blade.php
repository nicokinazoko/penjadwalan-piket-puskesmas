@extends('master.master')

@section('title', 'SPP | Lihat Data Piket')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Lihat Data Piket</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('piket-view-data') }}">Data Piket</a></li>
                            <li class="breadcrumb-item active">Lihat Data Piket</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">


                <!-- =========================================================== -->
                <h5 class="mt-4 mb-2">Jumlah Data Piket yang Sudah Ada</h5>
                <div class="row">
                    <div class="col-lg-3 col-4">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>53<sup style="font-size: 20px">%</sup></h3>

                                <p>Data Piket</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-clipboard-list"></i>
                            </div>
                            <a href="{{ route('piket-input-data') }}" class="small-box-footer">Input Data<i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <!-- =========================================================== -->
                <h5 class="mt-4 mb-2">Data Piket yang Sudah Ada</h5>
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
                                            <th>Kode Piket</th>
                                            <th>Nama Piket</th>
                                            <th colspan="2">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for ($i = 0; $i <= 10; $i++)
                                            <tr>
                                                <td>Amelia</td>
                                                <td>Dokter</td>
                                                <td>
                                                    <a href="{{ route('piket-edit-data') }}"><i
                                                            class="fas fa-edit"></i></a>
                                                </td>
                                                <td>
                                                    <a href="#"><i class="fas fa-trash-alt"></i></a>
                                                </td>
                                            </tr>

                                        @endfor
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Kode Piket</th>
                                            <th>Nama Piket</th>
                                            <th colspan="2">Aksi</th>
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
