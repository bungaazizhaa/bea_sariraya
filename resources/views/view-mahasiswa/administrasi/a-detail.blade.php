<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tahap Administrasi</title>
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
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/images') }}">

    <!-- SelectPicker -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js" defer></script>

    {{-- Font Awesome --}}
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    {{-- Date Picker --}}
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript" defer></script>

    {{-- Jangan Dihapus --}}
    <script src="{{ asset('assets/js/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('assets/js/countdown.min.js') }}"></script>

</head>

<body>
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
    <div class="container ">

        <div class="alert alert-warning text-center mt-4" role="alert">
            <strong>Waktu Pengisian Administrasi Sudah Ditutup.</strong>
        </div>
        <div class="alert alert-info text-center" role="alert">
            Hasil Seleksi Administrasi akan diumumkan pada hari
            <strong
                class="text-nowrap">{{ \Carbon\Carbon::parse($tglpengumuman)->isoFormat('dddd, D MMMM Y') }}</strong>
            di
            Jam Kerja.
        </div>
        <h1 class="text-center mt-4 test"> <b>BEASISWA SARIRAYA JAPAN 2022</b> </h1>
        <h1 class="text-center mt-3 test">Tahap Administrasi</h1>


        <form id="admForm" method="POST" action="{{ route('update.administrasi') }}" enctype="multipart/form-data">
            @csrf
            @if (isset($getAdministrasiUser))
                <hr class="container" style="width:65vw;" />
                <p class="text-center mb-1">Data Anda disimpan pada : <span
                        class="text-nowrap">{{ $getAdministrasiUser->updated_at->diffForHumans() }}</span>
                </p>
            @endif
            <input id="user_id" hidden type="text" class="form-control @error('user_id') is-invalid @enderror"
                user_id="user_id" value="{{ Auth::user()->id }}" autocomplete="user_id">

            <input id="periode_id" hidden type="text" class="form-control @error('periode_id') is-invalid @enderror"
                periode_id="periode_id" value="{{ $getPeriodeAktif->id }}" autocomplete="periode_id">


            <div class="row d-flex justify-content-center my-5 mx-1">
                {{-- ============== DATA DIRI ============== --}}
                <div class="col-md-8 mb-5 px-0">
                    <div class="card">
                        <div class="card-header h4">
                            Data Diri
                        </div>
                        <div class="card-body">

                            @if (isset($getAdministrasiUser))
                                <div class="row mb-3">
                                    <label for="no_pendaftaran"
                                        class="col-md-4 col-form-label text-md-right datadirii">{{ __('No Pendaftaran') }}</label>

                                    <div class="col-md-6">
                                        {{-- <input id="no_pendaftaran" type="hidden"
                                        class="form-control @error('no_pendaftaran') is-invalid @enderror"
                                        name="no_pendaftaran"
                                        value="{{ old('no_pendaftaran', strtoupper($getPeriodeAktif->id . uniqid())) }}"
                                autocomplete="no_pendaftaran" > --}}
                                        <input id="no_pendaftaran" type="text" disabled
                                            class="form-control @error('no_pendaftaran') is-invalid @enderror"
                                            name="no_pendaftaran" value="{{ $getAdministrasiUser->no_pendaftaran }}"
                                            autocomplete="no_pendaftaran">

                                        @error('no_pendaftaran')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            @endif

                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>

                                <div class="col-md-6">

                                    <input id="name" type="text" disabled
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name', Auth::user()->name) }}" autocomplete="name">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="nim"
                                    class="col-md-4 col-form-label text-md-right">{{ __('NIM') }}</label>

                                <div class="col-md-6">
                                    <input id="nim" type="text" disabled
                                        class="form-control @error('nim') is-invalid @enderror" name="nim"
                                        value="{{ old('nim', Auth::user()->nim) }}" autocomplete="nim">

                                    @error('nim')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="univ_id"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Perguruan Tinggi') }}</label>

                                <div class="col-md-6">
                                    <input id="univ_id" type="text" disabled
                                        class="form-control @error('univ_id') is-invalid @enderror" name="univ_id"
                                        value="{{ old('univ_id', Auth::user()->univ->nama_universitas) }}"
                                        autocomplete="univ_id">

                                    @error('univ_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="prodi_id"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Program Studi') }}</label>

                                <div class="col-md-6">
                                    <input id="prodi_id" type="text" disabled
                                        class="form-control @error('prodi_id') is-invalid @enderror" name="prodi_id"
                                        value="{{ old('prodi_id', Auth::user()->prodi->nama_prodi) }}"
                                        autocomplete="prodi_id">

                                    @error('prodi_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="tempat_lahir"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Tempat Lahir') }}</label>

                                <div class="col-md-6">
                                    <input id="tempat_lahir" type="text"
                                        class="form-control editable @error('tempat_lahir') is-invalid @enderror"
                                        name="tempat_lahir" spellcheck="false" disabled
                                        value="{{ old('tempat_lahir', isset($getAdministrasiUser) ? $getAdministrasiUser->tempat_lahir : '') }}"
                                        autocomplete="tempat_lahir" required>

                                    @error('tempat_lahir')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="tanggal_lahir"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Tanggal Lahir') }}</label>

                                <div class="col-md-6">
                                    <input id="tanggal_lahir" type="text"
                                        class="form-control editable datepicker @error('tanggal_lahir') is-invalid @enderror"
                                        name="tanggal_lahir" spellcheck="false" disabled
                                        value="{{ old('tanggal_lahir', isset($getAdministrasiUser) ? $getAdministrasiUser->tanggal_lahir : '') }}"
                                        autocomplete="tanggal_lahir" required>
                                    @error('tanggal_lahir')
                                        <strong class="text-danger small font-weight-bold"
                                            role="alert">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="semester"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Semester') }}</label>

                                <div class="col-md-6">
                                    <input id="semester" type="text" spellcheck="false"
                                        class="form-control editable @error('semester') is-invalid @enderror"
                                        name="semester" disabled
                                        value="{{ old('semester', isset($getAdministrasiUser) ? $getAdministrasiUser->semester : '') }}"
                                        autocomplete="semester" required>

                                    @error('semester')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="ipk"
                                    class="col-md-4 col-form-label text-md-right">{{ __('IPK') }}</label>

                                <div class="col-md-6">
                                    <input id="ipk" type="text"
                                        class="form-control editable @error('ipk') is-invalid @enderror" name="ipk"
                                        spellcheck="false" disabled
                                        value="{{ old('ipk', isset($getAdministrasiUser) ? $getAdministrasiUser->ipk : '') }}"
                                        autocomplete="ipk" required>

                                    @error('ipk')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="keahlian"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Keahlian') }}</label>

                                <div class="col-md-6">
                                    <input id="keahlian" type="text" spellcheck="false"
                                        class="form-control editable @error('keahlian') is-invalid @enderror"
                                        name="keahlian" disabled
                                        value="{{ old('keahlian', isset($getAdministrasiUser) ? $getAdministrasiUser->keahlian : '') }}"
                                        autocomplete="keahlian" required>

                                    @error('keahlian')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ============== UPLOAD BERKAS ============== --}}
                <div class="col-md-8 mb-5 px-0">
                    <div class="card">
                        <div class="card-header h4">
                            Upload Berkas
                        </div>
                        <div class="card-body">

                            <div class="row mb-3">
                                <label for="file_cv"
                                    class="col-md-4 col-form-label text-md-right">{{ __('File CV') }}</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        @if (isset($getAdministrasiUser->file_cv))
                                            <a class="btn btn-outline-primary" target="_blank"
                                                href={{ asset($getPeriodeAktif->name . '/' . $getAdministrasiUser->user->id . '/' . $getAdministrasiUser->file_cv) }}>Lihat
                                                CV Tersimpan</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="file_esai"
                                    class="col-md-4 col-form-label text-md-right">{{ __('FileEsai') }}</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        @if (isset($getAdministrasiUser->file_esai))
                                            <a class="btn btn-outline-primary" target="_blank"
                                                href={{ asset($getPeriodeAktif->name . '/' . $getAdministrasiUser->user->id . '/' . $getAdministrasiUser->file_esai) }}>Lihat
                                                Esai Tersimpan</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="file_portofolio"
                                    class="col-md-4 col-form-label text-md-right">{{ __('File Portofolio') }}</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        @if (isset($getAdministrasiUser->file_portofolio))
                                            <a class="btn btn-outline-primary" target="_blank"
                                                href={{ asset($getPeriodeAktif->name . '/' . $getAdministrasiUser->user->id . '/' . $getAdministrasiUser->file_portofolio) }}>Lihat
                                                Portofilio Tersimpan</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="file_ktm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('File KTM') }}</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        @if (isset($getAdministrasiUser->file_ktm))
                                            <a class="btn btn-outline-primary" target="_blank"
                                                href={{ asset($getPeriodeAktif->name . '/' . $getAdministrasiUser->user->id . '/' . $getAdministrasiUser->file_ktm) }}>Lihat
                                                KTM Tersimpan</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="file_transkrip"
                                    class="col-md-4 col-form-label text-md-right">{{ __('File Transkrip') }}</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        @if (isset($getAdministrasiUser->file_transkrip))
                                            <a class="btn btn-outline-primary" target="_blank"
                                                href={{ asset($getPeriodeAktif->name . '/' . $getAdministrasiUser->user->id . '/' . $getAdministrasiUser->file_transkrip) }}>Lihat
                                                Transkrip Tersimpan</a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- ============== KONTAK ============== --}}
                <div class="col-md-8 mb-5 px-0">
                    <div class="card">
                        <div class="card-header h4">
                            Kontak
                        </div>
                        <div class="card-body">

                            <div class="row mb-3">
                                <label for="no_wa"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Nomor WhatsApp') }}</label>

                                <div class="col-md-6">
                                    <input id="no_wa" type="text" spellcheck="false"
                                        class="form-control editable {{ isset($getAdministrasiUser->no_wa) ? 'font-weight-bold' : '' }} @error('no_wa') is-invalid @enderror"
                                        name="no_wa" disabled
                                        value="{{ old('no_wa', isset($getAdministrasiUser) ? $getAdministrasiUser->no_wa : '') }}"
                                        autocomplete="no_wa" placeholder="">

                                    @error('no_wa')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="instagram"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Instagram') }}</label>

                                <div class="col-md-6">
                                    <input id="instagram" type="text" spellcheck="false"
                                        class="form-control editable {{ isset($getAdministrasiUser->instagram) ? 'font-weight-bold' : '' }} @error('instagram') is-invalid @enderror"
                                        name="instagram" disabled
                                        value="{{ old('instagram', isset($getAdministrasiUser) ? $getAdministrasiUser->instagram : '') }}"
                                        autocomplete="instagram" placeholder="">

                                    @error('instagram')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="facebook"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Facebook') }}</label>

                                <div class="col-md-6">
                                    <input id="facebook" type="text" spellcheck="false"
                                        class="form-control editable {{ isset($getAdministrasiUser->facebook) ? 'font-weight-bold' : '' }} @error('facebook') is-invalid @enderror"
                                        name="facebook" disabled
                                        value="{{ old('facebook', isset($getAdministrasiUser) ? $getAdministrasiUser->facebook : '') }}"
                                        autocomplete="facebook" placeholder="">

                                    @error('facebook')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <script>
        $('document').ready(function() {
            $('input:not([value!=""])').val('-');
        });
    </script>

    <!-- Footer -->
    <footer class="pt-3 pt-3 pb-1 border-top bg-dark">
        <div class="text-center bg-dark text-white">
            <p>&copy; Sariraya 2022</p>
        </div>
    </footer>
</body>

</html>
