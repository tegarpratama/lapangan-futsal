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
        body {
            background-image: url("https://1.bp.blogspot.com/-nIi0jr3Uxso/X6IPalA_OVI/AAAAAAAAFQM/1CFHFgiUEZkIRLm5H6X23d7gmbrc-S0cACLcBGAsYHQ/s2048/InShot_20201104_091746479.jpg");
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            height: 100vh;
        }
    </style>
</head>

<body class="login" id="login">

    <div class="unix-login">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="login-content">
                        <div class="login-form">
                            <h4>Login</h4>

                            @if (session('success'))
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-success text-center mt-2 mb-2" role="alert">
                                            <strong>{{ session('success') }}</strong>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (session('status'))
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-danger text-center mt-2 mb-2" role="alert">
                                            <strong>{{ session('status') }}</strong>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('login.post') }}">
                                @csrf
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input type="email" class="form-control pl-3 @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control pl-3 @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">MASUK</button>
                            </form>

                            <div class="text-center">
                                <a class="text-success" href="{{ route('register.index') }}">Belum mempunyai akun ?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
