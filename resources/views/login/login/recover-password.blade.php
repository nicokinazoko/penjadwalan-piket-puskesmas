@extends('login.master.master-login')
@section('login-title', 'SIM Posyandu | Lupa Password')
@section('login-content')
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="../../index2.html" class="h1">
                    <b>
                        SIM Posyandu
                    </b>
                    Puskesmas Kebumen III
                </a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Jika lupa Password, silahkan menghubungi <strong>Kader</strong>.
                    <br><br> Silahkan klik Login untuk mencoba lagi
                </p>
                <p class="mt-3 mb-1">
                    <a href="{{ route('login') }}">Login</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

@endsection
