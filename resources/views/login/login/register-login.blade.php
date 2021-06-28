@extends('login.master.master-login')
@section('login-title', 'SIM Posyandu | Register Akun')
@section('login-content')
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="../../index2.html" class="h1">
                    <b>
                        SIM Posyandu
                    </b>
                    Puskesmas Kebumen III
                </a>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="card-body">
                <p class="login-box-msg">Daftar Akun Baru</p>
                <form action="{{ route('register') }}" method="get">

                    {{-- belum diganti name nya untuk proses --}}
                    <div class="form-group">
                        <label for="usernameRegister">Username</label>
                        <input type="text" class="form-control" id="usernameRegister" placeholder="Masukkan username" name="usernameRegister">
                    </div>

                    <div class="form-group">
                        <label for="namaLengkapRegister">Nama Lengkap</label>
                        <input type="text" class="form-control" id="namalengkapRegister"
                            placeholder="Masukkan Nama Lengkap" name="namaLengkapRegister">
                    </div>

                    <div class="form-group">
                        <label for="nipRegister">NIP</label>
                        <input type="text" class="form-control" id="nipRegister" placeholder="Masukkan NIP" name="nipRegister">
                    </div>

                    <div class="form-group">
                        <label for="passwordRegister">Password</label>
                        <input type="password" class="form-control" id="passwordRegister" placeholder="Masukkan Password" name="passwordRegister">
                    </div>

                    <div class="form-group">
                        <label>Desa Kader</label>
                        <select class="form-control select2" style="width: 100%;" name="desaKaderRegister">
                            <option value="Bumirejo">Bumirejo</option>
                            <option value="Gemesekti">Gemesekti</option>
                            <option value="Jemur">Jemur</option>
                            <option valu="Kebumen">Kebumen</option>
                            <option value="Kutosari">Kutosari</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </form>
                <p class="mb-1">
                    <a href="{{ route('forgot-password') }}">Saya lupa password</a>
                </p>
                <p class="mb-0">
                    <a href="{{ route('login') }}" class="text-center">Saya punya akun</a>
                </p>
            </div>
            <!-- /.card-body -->

        </div>

    </div>
    <!-- /.register-box -->

@endsection
