@extends('master.master')

@section('title', 'SPP | Edit Data Penjadwalan')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Data Penjadwalan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('view-data-algoritma-memetika') }}">
                                    Algoritma Neuro Fuzzy</a>
                            </li>
                            <li class="breadcrumb-item active"><a
                                    href="{{ route('view-data-penjadwalan-algoritma-memetika', ['tanggal_pembuatan' => $dataPenjadwalan[0]->tanggal_pembuatan_jadwal]) }}">Lihat
                                    Data Algoritma Neuro Fuzzy</a>
                            </li>
                            <li class="breadcrumb-item active">{{ $dataPegawai[0]->nama_pegawai }}</li>
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
                        <h3 class="card-title">Data Penjadwalan Algoritma Neuro Fuzzy</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form
                        action="{{ route('edit-data-penjadwalan-algoritma-neuro-fuzzy-proses', ['id_penjadwalan_neuro_fuzzy' => $dataPenjadwalan[0]->id_penjadwalan_neuro_fuzzy]) }}"
                        method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="card-body">
                            <input type="hidden" class="form-control" id="inputNamaPegawai" placeholder="Nama Pegawai"
                                name="inputIdPenjadwalan" value="{{ $dataPenjadwalan[0]->id_penjadwalan_neuro_fuzzy }}"
                                readonly>
                            <div class="form-group">
                                <label for="inputIdPegawai">Nama Pegawai</label>
                                <input type="text" class="form-control" id="inputIdPegawai" placeholder="Nama Pegawai"
                                    name="inputIdPegawai" value="{{ $dataPegawai[0]->nama_pegawai }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Daftar Piket</label>
                                <select class="form-control select2bs4" style="width: 100%;" name="inputIdPiket">
                                    @foreach ($dataPiket as $dataPiketBaru)
                                        <option value="{{ $dataPiketBaru->id_piket }}"
                                            {{ (old('inputIdPiket') ?? $dataPenjadwalan[0]->id_piket) == $dataPiketBaru->id_piket ? 'selected' : '' }}>
                                            {{ $dataPiketBaru->nama_piket }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="inputTanggalPenjadwalan">Tanggal Penjadwalan</label>
                                <input type="date" class="form-control" id="inputTanggalPenjadwalan"
                                    placeholder="Nama Pegawai" name="inputTanggalPenjadwalan"
                                    value="{{ $dataPenjadwalan[0]->tanggal_penjadwalan }}" readonly>
                            </div>

                            <input type="hidden" class="form-control" id="inputTanggalBuatPenjadwalan"
                                placeholder="Tanggal Pembuatan Jadwal" name="inputTanggalBuatPenjadwalan"
                                value="{{ $dataPenjadwalan[0]->tanggal_pembuatan_jadwal }}" readonly>
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
