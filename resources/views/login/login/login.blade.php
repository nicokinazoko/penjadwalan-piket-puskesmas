@extends('login.master.master-login')
@section('login-title', 'SIM Posyandu | Login')
@section('login-content')
    <div class="login-box">
        <!-- /.login-logo -->
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
                @if (session()->has('message'))
                    <div class="alert alert-danger" role="danger">
                        <center>
                            <h4 class="alert-heading">Peringatan!</h4>
                            {{ session()->get('message') }}
                        </center>
                    </div>
                @else
                    <p class="login-box-msg">Silahkan login terlebih dahulu</p>
                @endif


                <form action="{{ route('login-proccess') }}" method="POST">
                    @csrf
                    @error('usernameLogin')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" name="usernameLogin">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user-nurse"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="passwordLogin">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </form>

                <p class="mb-1">
                    <a href="{{ route('forgot-password') }}">Saya Lupa Password Saya</a>
                </p>
                <p class="mb-0">
                    <a href="{{ route('register') }}" class="text-center">Daftar Baru</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

@endsection
