@extends('master.master')

@section('title', 'SPP | Input Data Piket')
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
                            <li class="breadcrumb-item"><a href="{{ route('piket-view-data') }}">Data Piket</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('piket-edit-data') }}">Edit Data Piket</a></li>
                            <li class="breadcrumb-item active">{{ $piket[0]->nama_piket }}</li>
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
                        <h3 class="card-title">Quick Example</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form>
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputKodePiket">Kode Piket</label>
                                <input type="text" class="form-control" id="inputKodePiket" placeholder="Kode Piket"
                                    name="inputKodePiket" value="{{$piket[0]->kode_piket }}">
                            </div>
                            <div class="form-group">
                                <label for="inputNamaPiket">Nama Piket</label>
                                <input type="text" class="form-control" id="inputNamaPiket" placeholder="Nama Piket"
                                    name="inputNamaPiket" value="{{$piket[0]->nama_piket}}">
                            </div>
                        </div>

                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection


@section('addons-scripts')
    @include('layouts.footer.form-scripts')
@endsection
