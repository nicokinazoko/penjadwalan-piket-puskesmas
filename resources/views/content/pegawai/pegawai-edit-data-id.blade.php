@extends('master.master')

@section('title', 'SPP | Edit Data Pegawai')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Input Data Pegawai</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('pegawai-view-data') }}">Data Pegawai</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="{{ route('pegawai-view-data') }}">Data Pegawai</a>
                            </li>
                            <li class="breadcrumb-item active">Input Data Pegawai</li>
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
                        <h3 class="card-title">Data Pegawai</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="GET" action="{{ route('pegawai-input-data-proses') }}">
                        @csrf
                        <div class="card-body">
                            {{-- ini belum coba input id nya --}}
                            <input type="hidden" class="form-control" id="inputNamaPegawai" placeholder="Nama Pegawai"
                                name="inputNamaPegawai">
                            <div class="form-group">
                                <label for="inputNamaPegawai">Nama Pegawai</label>
                                <input type="text" class="form-control" id="inputNamaPegawai" placeholder="Nama Pegawai"
                                    name="inputNamaPegawai" value="{{ $pegawaiCari[0]->nama_pegawai }}">
                            </div>

                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select class="form-control select2bs4" style="width: 100%;" name="inputJenisKelaminPegawai"
                                    value="{{ $pegawaiCari[0]->id_jenis_kelamin }}">
                                    @foreach ($jenisKelamin as $dataJenisKelamin)
                                        <option value="{{ $dataJenisKelamin->nama_jenis_kelamin }}"
                                            {{ (old('inputJenisKelaminPegawai') ?? $pegawaiCari[0]->id_jenis_kelamin) == $dataJenisKelamin->id_jenis_kelamin ? 'selected' : '' }}>
                                            {{ $dataJenisKelamin->nama_jenis_kelamin }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jabatan Pegawai</label>
                                <select class="form-control select2bs4" style="width: 100%;" name="inputJabatanPegawai">
                                    @foreach ($jabatan as $dataJabatan)
                                        <option value="{{ $dataJabatan->id_jabatan }}"
                                            {{ (old('inputJabatanPegawai') ?? $pegawaiCari[0]->id_jabatan) == $dataJabatan->id_jabatan ? 'selected' : '' }}>
                                            {{ $dataJabatan->nama_jabatan }}
                                        </option>
                                    @endforeach

                                </select>
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
@endsection
