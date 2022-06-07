<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Beasiswa Sariraya</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>

    <!-- CSS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/images') }}">

    {{-- Font Awesome --}}
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container d-flex justify-content-between">
            <a class="logoo" href="#">
                <img src="{{ asset('assets/images/logo.png') }}" alt="" width="80px">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto my-2 my-md-0">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto ml-md-0 test">

                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register') && isset($getPeriodeAktif) ? !$getPeriodeAktif->status_adm == 'Selesai' : '')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
            </div>
        </div>
    </nav>
    <!-- Akhir Navbar -->
    @include('sweetalert::alert')
    <div class="container">
        <center>
            <h1 class="text-center mt-5 test"> <b>BEASISWA SARIRAYA JAPAN 2022</b> </h1>

            <h1 class="text-center mt-3 h2">Pengumuman Tahap Administrasi</h1>

            <div class="alert alert-danger text-center mt-4 teksalert" role="alert">
                <strong>MAAF ! ANDA TIDAK LOLOS TAHAP ADMINISTRASI <br>
                    BEASISWA SARIRAYA JAPAN 2022</strong>
            </div>

            <h4>Jangan patah semangat dan terus mencoba ! <br>
                “Karena kegagalan adalah keberhasilan yang tertunda”</h4>
            <div class="salam">
                <p>Salam, panitia Beasiswa Sariraya Japan 2022</p>
                <p>Terimakasih sudah berpartisipasi.</p>
            </div>

            @auth
            <a href="{{ url('/home') }}" class="btn-sm text-gray-700 dark:text-gray-500 underline">Kembali ke Home</a>
            @endauth
    </div>
    </center>




    <!-- Footer -->
    <footer class="pt-3 pt-3 pb-1 border-top bg-dark footer1">
        <div class="text-center bg-dark text-white">
            <p>&copy; Sariraya 2022</p>
        </div>
    </footer>
</body>

</html>