<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Beasiswa Sariraya</title>


    {{-- Bootstrap 4 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>

    <!-- CSS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">


    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin-lte') }}/plugins/fontawesome-free/css/all.min.css">
    <script src="https://kit.fontawesome.com/637f4baacf.js" crossorigin="anonymous"></script>

</head>

<body class=" d-flex flex-column" style="min-height: calc(100vh - 60px);">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container d-flex justify-content-between">
            <a class="logoo" href="/">
                <img src="{{ asset('assets/images/logo.png') }}" alt="" width="80px">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto my-2 my-md-0">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto ml-md-0 test">

                        <!-- Authentication Links -->
                        @auth
                            <li class="nav-item mr-0 mr-md-4 pr-md-0 test"><a class="nav-link  pr-3 pr-md-2"
                                    href="{{ url('/my-profile') }}">Profil</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endauth
                    </ul>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Akhir Navbar -->
    @include('sweetalert::alert')
    <div class="container">
        <div>
            <h1 class="mt-4 test text-center"> <b>BEASISWA SARIRAYA JAPAN {{ strtoupper($getPeriodeAktif->name) }}</b>
            </h1>

            <h1 class="mt-3 h2 text-center">Pengumuman Tahap Administrasi</h1>

            <div class="alert alert-success mt-4 teksalert text-center" role="alert">
                <strong>SELAMAT ! ANDA LOLOS TAHAP ADMINISTRASI <br>
                    BEASISWA SARIRAYA JAPAN {{ strtoupper($getPeriodeAktif->name) }}</strong>
            </div>

            <p class="h5 pt-2 pt-md-4 text-center">Berikut adalah jadwal wawancara Anda :</p>
            <p class="h4 pt-3 font-weight-bold text-center">
                {{ \Carbon\Carbon::parse($tanggal_wawancara)->translatedFormat('l, d F Y') }}</p>
            <p class="h4 mb-2 font-weight-bold text-center">
                {{ \Carbon\Carbon::parse($tanggal_wawancara)->translatedFormat('H:i') . ' WIB' }}</p>
            <br>

            <div class="d-flex justify-content-center">
                <div class="alert alert-info pb-0 col-md-6">{!! $getPeriodeAktif->teknis_wwn !!}</div>
            </div>

            <p class="text-center">Jika ada kendala hubungi kontak
                Admin yang tersedia.</p>
            @auth
                <div class="d-flex justify-content-center">
                    <a href="{{ url('/my-profile') }}" class="btn btn-outline-secondary mb-4 mt-2"><i
                            class="fa-solid fa-angle-left"></i>
                        Kembali ke
                        Profil Anda</a>
                </div>
            @endauth
        </div>
    </div>

    <!-- Footer -->
    <footer class="pt-3 pt-3 pb-1 border-top bg-dark mt-auto">
        <div class="text-center bg-dark text-white">
            <p>&copy; Sariraya 2022</p>
        </div>
    </footer>
</body>

</html>
