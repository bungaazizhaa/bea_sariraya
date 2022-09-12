<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Beasiswa Sariraya</title>
    <meta name="description"
        content="Masuk kedalam Sistem Informasi Penerimaan Beasiswa Sariraya Japan untuk melihat informasi lebih lengkap.">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    {{-- ICON WEBSITE --}}
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin-lte') }}/plugins/fontawesome-free/css/all.min.css">
    <script src="https://kit.fontawesome.com/637f4baacf.js" crossorigin="anonymous"></script>
    <style>
        body {
            min-width: 100vw;
            min-height: 100vh;
        }
    </style>
</head>

<body style="background-color: #24272b">

    <div class="banner-regist" style="background-image: url('{{ asset('assets/images/bg.png') }}')"> </div>

    <div class="container">
        <a class="logo-img mt-1 d-none d-lg-block" href="/">
            <img class=" mt-0 mt-lg-4" src="{{ asset('assets/images/logo.png') }}" alt="">
        </a>

        <div class="logo d-none d-lg-block">
            <img src="{{ asset('assets/images/awardee.png') }}" alt="">
        </div>
    </div>
    <div class="container">
        <!-- Banner -->
        <!-- Akhir Banner -->
        {{-- <img src="{{ asset('assets/images/bg.png') }}" alt=""> --}}
        <div class="row d-flex justify-content-center" style="min-height: 90vh">

            <div class="col-12 pl-lg-0 col-lg-7 text-lg-left text-center my-md-auto my-0">

                <div class="text-left d-lg-none mt-3 text-center">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="" width="40%">
                </div>
                <div class="welcom mt-lg-5 mt-3 mt-lg-0 mb-lg-5 w-100 px-3 mx-1">
                    <p>Pendaftaran Beasiswa Sariraya Japan 2022</p>
                    <h1>{{ isset($getPeriodeAktif) ? 'Sudah Dibuka' : 'Belum Dibuka' }}
                    </h1>
                </div>
            </div>
            <div class="col-12 col-lg-5 my-md-auto mt-3">
                <div class="card regis mx-lg-3 ml-lg-4 mt-lg-3 mb-lg-3 my-md-4">
                    <div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="text-center">
                                    <p class="h4 mb-4">Login</p>
                                </div>
                                <div class="form-group">
                                    <input id="email" type="email" style="padding: 20px"
                                        class="form-control rounded-pill @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" placeholder="Email" required
                                        autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-2">
                                    <input id="password" type="password" style="padding: 20px"
                                        class="form-control rounded-pill @error('password') is-invalid @enderror"
                                        name="password" placeholder="Password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                @if (Route::has('password.request'))
                                    <div class="d-flex">
                                        <small class="ml-auto"><span><a class="text-secondary"
                                                    href="{{ route('password.request') }}">Lupa
                                                    Password <i
                                                        class="fa-solid fa-circle-question"></i></a></span></small>
                                    </div>
                                @endif
                                <center>
                                    <div class="button-submit my-3">
                                        <button type="submit" class="btn tombol px-4">Login</button>
                                    </div>
                                    @if (Route::has('register'))
                                        <p class="font-weight-normal mt-3 mb-0">Belum punya akun ? <a
                                                href="{{ route('register') }}">Register
                                                disini.</a></p>
                                    @endif
                                </center>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Akhir Banner -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

</body>

</html>
