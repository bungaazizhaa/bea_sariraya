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
    <div class="banner-regist" style="background-image: url('{{ asset('assets/images/berhasil.jpg') }}')"> </div>

    <div class="container">
        <div class="logo2">
            <img src="{{ asset('assets/images/logo.png') }}" alt="">
        </div>
    </div>
    <div class="container">

        {{-- <img src="{{ asset('assets/images/berhasil.jpg') }}" alt=""> --}}
        @include('sweetalert::alert')
        <div class="container">
            <div class="text-center col-12 pl-lg-0 col-lg-12 text-lg-left text-center my-auto">
                <center>
                    <div class="pengumuman">
                        <h1 class="mt-4 test"> <b>BEASISWA SARIRAYA JAPAN
                                {{ strtoupper($getPeriodeAktif->name) }}</b> </h1>

                        <h1 class="mt-3 h2">Pengumuman Akhir</h1>

                        <div class="alert alert-success mt-4 teksalert" role="alert">
                            <strong>SELAMAT ! ANDA DITERIMA PADA PROGRAM <br>
                                BEASISWA SARIRAYA JAPAN {{ strtoupper($getPeriodeAktif->name) }}</strong>
                        </div>

                        <p class="h5 pt-2 pt-md-2">Berikut adalah link untuk masuk ke Grup WhatsApp :</p>
                        <a href="{{ url($getPeriodeAktif->group_wa) }}" class="btn btn-success mb-3 mt-2">Grup
                            WhatsApp</a>
                        <p>Atau klik link berikut <span><a
                                    href="{{ $getPeriodeAktif->group_wa }}">{{ $getPeriodeAktif->group_wa }}</a></span>
                        </p>
                        <br>
                        <p>Jika ada kendala, silahkan hubungi Admin.</p>
                        @auth
                            <a href="{{ url('/my-profile') }}" class="btn btn-outline-light mb-4 mt-2"><i
                                    class="fa-solid fa-angle-left"></i>
                                Kembali ke
                                Profil Anda</a>
                        @endauth
                    </div>
                </center>
            </div>
            <div class="logo">
                <img src="{{ asset('assets/images/awardee.png') }}" alt="">
            </div>
        </div>


</body>

</html>
