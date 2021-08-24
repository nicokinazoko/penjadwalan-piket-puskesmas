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
                        <h1>Advanced Form</h1>
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
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Data Algoritma Neuro Fuzzy</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->

                    <form method="POST" action="{{ route('proses-neuro-fuzzy') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputJumlahPopulasi">Jumlah Populasi</label>
                                <input type="text" class="form-control" id="inputJumlahPopulasi"
                                    placeholder="Jumlah Populasi" name="inputJumlahPopulasi">
                            </div>
                            <div class="form-group">
                                <label for="inputMutationRate">Mutation Rate</label>
                                <input type="text" class="form-control" id="inputMutationRate" placeholder="Mutation Rate"
                                    name="inputMutationRate">
                            </div>
                            <div class="form-group">
                                <label for="inputBulanPiket">Bulan Piket</label>
                                <input type="month" class="form-control" id="inputBulanPiket" placeholder="Bulan Piket"
                                    name="inputBulanPiket">
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>


            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection


@section('addons-scripts')
    @include('layouts.footer.form-scripts')
    @include('layouts.footer.table-data-scripts')
@endsection
