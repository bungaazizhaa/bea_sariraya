<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('assets/images/bunga2.png') }}" type="image/x-icon">

    <!-- Scripts -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin-lte') }}/plugins/fontawesome-free/css/all.min.css">
    <script src="https://kit.fontawesome.com/637f4baacf.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">

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

    <!-- SelectPicker -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js" defer></script>

    {{-- Jangan Dihapus --}}
    <script src="{{ asset('assets/js/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('assets/js/countdown.min.js') }}"></script>

</head>

<body class=" d-flex flex-column test" style="min-height: calc(100vh - 60px);">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container d-flex justify-content-between">
                <a class="logo" href="/">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="" width="80px">
                </a>
                <!--
                <a class="navbar-brand me-auto" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>


                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item mr-0 mr-md-4 pr-md-0 test"><a class="nav-link  pr-3 pr-md-2"
                                href="{{ url('/my-profile') }}">Profil</a>
                        </li>
                        {{-- <li class="nav-item mb-1" id="waktu">
                            <p class="text-center m-0 p-0 mt-2">Waktu Sekarang</p>
                            <p class="text-center m-0 p-0 mt-0" id="tgl">Hari, 00 Bulan 0000 - 00:00:00</p>
                        </li> --}}

                        {{-- Jangan Dihapus --}}
                        {{-- <script>
                            (function myClock() {
                                moment.locale('id');
                                var Tanggal = moment().format('dddd, DD MMMM YYYY - HH:mm:ss');
                                var eTgl = document.getElementById('tgl');
                                eTgl.innerHTML = Tanggal;
                                requestAnimationFrame(myClock);
                            })();
                        </script> --}}
                    </ul>

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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="pb-0 m-0">
            @include('sweetalert::alert')
            @yield('content')
        </main>

    </div>

    <!-- Footer -->
    <footer class="pt-3 pt-3 pb-1 border-top bg-dark mt-auto">
        <div class="text-center bg-dark text-white">
            <p>&copy; Sariraya 2022</p>
        </div>
    </footer>


    <script>
        $(window).on('load', function() {
            @if (old('name') || old('univ_id') || old('univ_id_manual') || old('nim'))
                $('#tombolEditProfil').click();
            @endif
        });
    </script>

    <script>
        $(window).on('load', function() {
            @if (old('Foto'))
                $('#tombolEditFoto').click();
            @endif
        });
    </script>


</body>

</html>
