<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Beasiswa Sariraya</title>
    {{-- ICON WEBSITE --}}
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

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

<body style="background-color: #212921">

    <div class="banner-regist" style="background-image: url('{{ asset('assets/images/berhasil.jpg') }}')"></div>
    <div class="container">
        <div class="logo2 d-none d-md-block">
            <img src="{{ asset('assets/images/logo.png') }}" alt="">
        </div>

        <div class="logo d-none d-md-block">
            <img src="{{ asset('assets/images/awardee.png') }}" alt="">
        </div>
        {{-- <img src="{{ asset('assets/images/berhasil.jpg') }}" alt=""> --}}
        @include('sweetalert::alert')
        <div class="text-center col-12 text-lg-left pt-md-4 ">
            <center>
                <div class="mt-4 text-left d-md-none">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="" width="30%">
                </div>
                <div class="pt-0 pt-sm-3 pt-md-5 d-flex justify-content-around flex-column">
                    <div class="text-white mt-3 mt-sm-0 d-flex justify-content-around flex-column "
                        style="min-height: 80vh">
                        <h1 class="mt-1 h3 mb-lg-4"> <b>BEASISWA SARIRAYA JAPAN
                                {{ strtoupper($getPeriodeAktif->name) }}</b> </h1>

                        {{-- <h1 class="mt-3 h3">Pengumuman Akhir</h1> --}}

                        <div class="alert alert-success mt-4 teksalert mx-md-5" role="alert">
                            <h5>Selamat <strong>{{ ucfirst(Auth::user()->name) }}</strong> !</h5>
                            <h5>Anda Diterima Pada
                                Program
                                Beasiswa Sariraya Japan {{ ucfirst($getPeriodeAktif->name) }}</h5>
                        </div>

                        <div>
                            <p class="pt-2 pt-lg-5 mb-2 pt-md-2">Berikut adalah link untuk masuk ke Grup WhatsApp :</p>
                            <a href="{{ url($getPeriodeAktif->group_wa) }}"
                                class="btn btn-success mb-4 mb-md-5 mt-2">Grup
                                WhatsApp</a>
                        </div>
                        <div>
                            <p class="mt-lg-5 mt-3">Jika ada kendala, silahkan hubungi Admin.</p>
                            @auth
                                <a href="{{ url('/my-profile') }}" class="btn btn-sm btn-outline-light mb-4"><i
                                        class="fa-solid fa-angle-left"></i>
                                    Kembali ke
                                    Profil Anda</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </center>
        </div>
    </div>
</body>

</html>
