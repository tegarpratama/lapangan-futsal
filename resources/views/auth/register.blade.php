<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">
    <!-- Styles -->
    <link href="{{ asset('assets/back/css/lib/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/back/css/lib/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/back/css/lib/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/back/css/lib/helper.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/back/css/style.css') }}" rel="stylesheet">
    <style>
    </style>
</head>

<body class="bg-primary">
    <div class="unix-login">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-5">
                    <div class="login-content">
                        <div class="login-form">
                            <h4>Regristasi</h4>

                            @if (session('status'))
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-danger text-center mt-2 mb-2" role="alert">
                                            <strong>{{ session('status') }}</strong>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('register.post') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <label>Nama Lengkap</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required>
                                        @error('nama')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6 col-md-6 col-lg-6">
                                        <label>Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-6 col-md-6 col-lg-6">
                                        <label>No. HP</label>
                                        <input type="number" class="form-control @error('telp') is-invalid @enderror" name="telp" value="{{ old('telp') }}" required>
                                        @error('telp')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6 col-md-6 col-lg-6">
                                        <label>Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required>
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-6 col-md-6 col-lg-6">
                                        <label>Konfirmasi Password</label>
                                        <input type="password" class="form-control @error('password_confirm') is-invalid @enderror" name="password_confirm" value="{{ old('password_confirm') }}" required>
                                        @error('password_confirm')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <button class="btn btn-dark submit w-100 mt-4">DAFTAR</button>
                            </form>

                            <div class="text-center mt-3">
                                <a class="text-dark" href="{{ route('login.index') }}">Sudah mempunyai akun ?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
