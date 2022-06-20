<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tahap Administrasi</title>
    <link rel="icon" href="{{ asset('assets/images/bunga2.png') }}" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    {{-- Bootstrap 4 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
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

    <script src="{{ asset('assets/js/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('assets/js/countdown.min.js') }}"></script>
</head>

<body>
    <div class="test">

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
                        <ul class="navbar-nav ml-md-auto ml-0 test">

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



        <noscript>
            <h2 class="text-center">JavaScript is disabled!
                Please enable JavaScript in your web browser!</h2>

            <style type="text/css">
                #main-content {
                    display: none;
                }
            </style>
        </noscript>
        @include('sweetalert::alert')
        <div id="main-content" class="container-fluid ">
            <h1 class="text-center mt-3 test"> <b>BEASISWA SARIRAYA JAPAN 2022</b> </h1>
            <h1 class="text-center mt-3 test">Tahap Administrasi</h1>


            <form id="admForm" method="POST" action="{{ route('update.administrasi') }}"
                enctype="multipart/form-data">
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
                    <div class="col-md-8 alert alert-info text-center" role="alert">
                        Halaman ini ditutup dalam waktu
                        <span id="countdownAdm" class="font-weight-bold text-nowrap"></span>
                    </div>

                    <script>
                        function submitAdm() {
                            $("#admForm").submit();
                        }
                        countdown.setLabels(
                            ' Milidetik| Detik| Menit| Jam| Hari| Minggu| Bulan| Tahun| Dekade| Abad| Ribu',
                            ' Milidetik| Detik| Menit| Jam| Hari| Minggu| Bulan| Tahun| Dekade| Abad| Ribu',
                            ', ',
                            ', ',
                            'Sekarang!');
                        var ta_adm = '{{ $getPeriodeAktif->ta_adm }}';
                        var then = moment(ta_adm, 'YYYY-MM-DD').add(1, 'days').locale('id');
                        (function timerLoop() {
                            $("#countdownAdm").text(countdown(then).toString());
                            if (countdown(then).toString() === 'Sekarang!') {
                                cancelAnimationFrame(timerLoop);
                                setTimeout(submitAdm, 990)
                            } else {
                                requestAnimationFrame(timerLoop);
                            }
                        })();
                    </script>
                    {{-- ============== DATA DIRI ============== --}}
                    <div class="col-md-8 mb-3 px-0">
                        <div class="alert alert-info pb-0 ">
                            <table
                                class="table table-borderless table-responsive d-block d-md-flex justify-content-center text-nowrap">
                                <tbody>
                                    @if (isset($getAdministrasiUser))
                                        <tr style="height:10px;">
                                            <td>Nomor Pendaftaran</td>
                                            <td>:</td>
                                            <td>{{ $getAdministrasiUser->no_pendaftaran }}</td>
                                        </tr>
                                    @endif
                                    <tr style="height:10px;">
                                        <td>Nama</td>
                                        <td>:</td>
                                        <td>{{ Auth::user()->name }}</td>
                                    </tr>
                                    <tr style="height:10px;">
                                        <td>NIM</td>
                                        <td>:</td>
                                        <td>{{ Auth::user()->nim }}</td>
                                    </tr>
                                    <tr style="height:10px;">
                                        <td>Perguruan Tinggi</td>
                                        <td>:</td>
                                        <td>{{ Auth::user()->univ->nama_universitas }}</td>
                                    </tr>
                                    <tr style="height:10px;">
                                        <td>Program Studi</td>
                                        <td>:</td>
                                        <td>{{ Auth::user()->prodi->nama_prodi }}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-8 mb-5 px-0">
                        <div class="card">
                            <div class="card-header h4">
                                <b>Data Diri</b>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3 datadiri">
                                    <label for="tempat_lahir"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Tempat Lahir') }}</label>

                                    <div class="col-md-6">
                                        <input id="tempat_lahir" type="text"
                                            class="form-control editable {{ isset($getAdministrasiUser->tempat_lahir) ? 'font-weight-bold' : '' }} @error('tempat_lahir') is-invalid @enderror"
                                            name="tempat_lahir" spellcheck="false" disabled
                                            value="{{ old('tempat_lahir', isset($getAdministrasiUser) ? $getAdministrasiUser->tempat_lahir : '') }}"
                                            autocomplete="tempat_lahir" placeholder="Nama Kota Atau Kabupaten">

                                        @error('tempat_lahir')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3 datadiri">
                                    <label for="tanggal_lahir"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Tanggal Lahir') }}</label>

                                    <div class="col-md-6">
                                        <input autocomplete="off" id="tanggal_lahir" type="text"
                                            class="form-control editable {{ isset($getAdministrasiUser->tanggal_lahir) ? 'font-weight-bold' : '' }} datepicker @error('tanggal_lahir') is-invalid @enderror"
                                            name="tanggal_lahir" spellcheck="false" disabled
                                            value="{{ old('tanggal_lahir', isset($getAdministrasiUser->tanggal_lahir) ? $getAdministrasiUser->tanggal_lahir->format('Y-m-d') : '') }}"
                                            autocomplete="tanggal_lahir" placeholder="YYYY-MM-DD">
                                        @error('tanggal_lahir')
                                            <strong class="text-danger small font-weight-bold"
                                                role="alert">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3 datadiri">
                                    <label for="semester"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Semester') }}</label>

                                    <div class="col-md-6">
                                        <input id="semester" type="text" spellcheck="false"
                                            class="form-control editable {{ isset($getAdministrasiUser->semester) ? 'font-weight-bold' : '' }} @error('semester') is-invalid @enderror"
                                            name="semester" disabled
                                            value="{{ old('semester', isset($getAdministrasiUser) ? $getAdministrasiUser->semester : '') }}"
                                            autocomplete="semester" placeholder="Min Semester 6">

                                        @error('semester')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3 datadiri">
                                    <label for="ipk"
                                        class="col-md-4 col-form-label text-md-right">{{ __('IPK') }}</label>

                                    <div class="col-md-6">
                                        <input id="ipk" type="text"
                                            class="form-control editable {{ isset($getAdministrasiUser->ipk) ? 'font-weight-bold' : '' }} @error('ipk') is-invalid @enderror"
                                            name="ipk" spellcheck="false" disabled
                                            value="{{ old('ipk', isset($getAdministrasiUser) ? $getAdministrasiUser->ipk : '') }}"
                                            autocomplete="ipk" placeholder="Misal, 3.70">

                                        @error('ipk')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3 datadiri">
                                    <label for="keahlian"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Keahlian') }}</label>

                                    <div class="col-md-6">
                                        <input id="keahlian" type="text" spellcheck="false"
                                            class="form-control editable {{ isset($getAdministrasiUser->keahlian) ? 'font-weight-bold' : '' }} @error('keahlian') is-invalid @enderror"
                                            name="keahlian" disabled
                                            value="{{ old('keahlian', isset($getAdministrasiUser) ? $getAdministrasiUser->keahlian : '') }}"
                                            autocomplete="keahlian" placeholder="Misal, Web Developer">

                                        @error('keahlian')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3 datadiri">
                                    <label for="alamat"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Alamat') }}</label>

                                    <div class="col-md-6">
                                        <input id="alamat" type="text" spellcheck="false"
                                            class="form-control editable {{ isset($getAdministrasiUser->alamat) ? 'font-weight-bold' : '' }} @error('alamat') is-invalid @enderror"
                                            name="alamat" disabled
                                            value="{{ old('alamat', isset($getAdministrasiUser) ? $getAdministrasiUser->alamat : '') }}"
                                            autocomplete="alamat" placeholder="Alamat Tempat Tinggal">

                                        @error('alamat')
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
                                <b>Upload Berkas</b>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-info text-center">
                                    Format yang diizinkan: <span class="font-weight-bold">.jpeg, .png, .jpg,
                                        .pdf.</span><br>Ukuran Maksimal Setiap File: <span class="font-weight-bold">
                                        5MB</span>
                                </div>
                                <div class="row mb-3">
                                    <label for="file_cv" class="col-md-4 col-form-label text-md-right">File CV</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <div class="custom-file berkas">
                                                <input type="file"
                                                    class="custom-file-input editable {{ isset($getAdministrasiUser->file_cv) ? 'font-weight-bold' : '' }}"
                                                    disabled id="file_cv" name="file_cv"
                                                    accept="application/pdf, image/jpg, image/jpeg, image/png"
                                                    value="{{ old('file_cv', isset($getAdministrasiUser) ? $getAdministrasiUser->file_cv : '') }}">
                                                <label class="custom-file-label" for="file_cv">...</label>
                                            </div>
                                        </div>
                                        @error('file_cv')
                                            <div class="text-danger small" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                @if (isset($getAdministrasiUser->file_cv))
                                    <div class="row mb-3">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <a class="btn btn-sm btn-outline-primary" target="_blank"
                                                    href={{ asset($getPeriodeAktif->name . '/' . $getAdministrasiUser->user->id . '/' . $getAdministrasiUser->file_cv) }}>Lihat
                                                    CV Tersimpan</a>
                                                <a style="cursor: pointer;"
                                                    onclick="window.location.href='{{ route('fileadm.destroy', 'file_cv') }}';"
                                                    class="btn-sm btn-light border border-danger text-danger ml-3">Hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="row mb-3">
                                    <label for="file_esai" class="col-md-4 col-form-label text-md-right">File
                                        Esai</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input editable {{ isset($getAdministrasiUser->file_esai) ? 'font-weight-bold' : '' }}"
                                                    disabled id="file_esai" name="file_esai" accept="application/pdf"
                                                    value="{{ old('file_esai', isset($getAdministrasiUser) ? $getAdministrasiUser->file_esai : '') }}">
                                                <label class="custom-file-label" for="file_esai">...</label>
                                            </div>
                                        </div>
                                        @error('file_esai')
                                            <div class="text-danger small" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                @if (isset($getAdministrasiUser->file_esai))
                                    <div class="row mb-3">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <a class="btn btn-sm btn-outline-primary" target="_blank"
                                                    href={{ asset($getPeriodeAktif->name . '/' . $getAdministrasiUser->user->id . '/' . $getAdministrasiUser->file_esai) }}>Lihat
                                                    Esai Tersimpan</a>
                                                <a style="cursor: pointer;"
                                                    onclick="window.location.href='{{ route('fileadm.destroy', 'file_esai') }}';"
                                                    class="btn-sm btn-light border border-danger text-danger ml-3">Hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="row mb-3">
                                    <label for="file_portofolio" class="col-md-4 col-form-label text-md-right">File
                                        Portofolio (Optional)</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input editable {{ isset($getAdministrasiUser->file_portofolio) ? 'font-weight-bold' : '' }}"
                                                    disabled id="file_portofolio" name="file_portofolio"
                                                    accept="application/pdf, image/jpg, image/jpeg, image/png"
                                                    value="{{ old('file_portofolio', isset($getAdministrasiUser) ? $getAdministrasiUser->file_portofolio : '') }}">
                                                <label class="custom-file-label" for="file_portofolio">...</label>
                                            </div>
                                        </div>
                                        @error('file_portofolio')
                                            <div class="text-danger small" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                @if (isset($getAdministrasiUser->file_portofolio))
                                    <div class="row mb-3">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <a class="btn btn-sm btn-outline-primary" target="_blank"
                                                    href={{ asset($getPeriodeAktif->name . '/' . $getAdministrasiUser->user->id . '/' . $getAdministrasiUser->file_portofolio) }}>Lihat
                                                    Portofilio Tersimpan</a>
                                                <a style="cursor: pointer;"
                                                    onclick="window.location.href='{{ route('fileadm.destroy', 'file_portofolio') }}';"
                                                    class="btn-sm btn-light border border-danger text-danger ml-3">Hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="row mb-3">
                                    <label for="file_ktm" class="col-md-4 col-form-label text-md-right">File
                                        KTM</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input editable {{ isset($getAdministrasiUser->file_ktm) ? 'font-weight-bold' : '' }}"
                                                    disabled id="file_ktm" name="file_ktm"
                                                    accept="application/pdf, image/jpg, image/jpeg, image/png"
                                                    value="{{ old('file_ktm', isset($getAdministrasiUser) ? $getAdministrasiUser->file_ktm : '') }}">
                                                <label class="custom-file-label" for="file_ktm">...</label>
                                            </div>
                                        </div>
                                        @error('file_ktm')
                                            <div class="text-danger small" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                @if (isset($getAdministrasiUser->file_ktm))
                                    <div class="row mb-3">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <a class="btn btn-sm btn-outline-primary" target="_blank"
                                                    href={{ asset($getPeriodeAktif->name . '/' . $getAdministrasiUser->user->id . '/' . $getAdministrasiUser->file_ktm) }}>Lihat
                                                    KTM Tersimpan</a>
                                                <a style="cursor: pointer;"
                                                    onclick="window.location.href='{{ route('fileadm.destroy', 'file_ktm') }}';"
                                                    class="btn-sm btn-light border border-danger text-danger ml-3">Hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="row mb-3">
                                    <label for="file_transkrip" class="col-md-4 col-form-label text-md-right">File
                                        Transkrip</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input editable {{ isset($getAdministrasiUser->file_transkrip) ? 'font-weight-bold' : '' }}"
                                                    disabled id="file_transkrip" name="file_transkrip"
                                                    accept="application/pdf, image/jpg, image/jpeg, image/png"
                                                    value="{{ old('file_transkrip', isset($getAdministrasiUser) ? $getAdministrasiUser->file_transkrip : '') }}">
                                                <label class="custom-file-label" for="file_transkrip">...</label>
                                            </div>
                                        </div>
                                        @error('file_transkrip')
                                            <div class="text-danger small" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                @if (isset($getAdministrasiUser->file_transkrip))
                                    <div class="row mb-3">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <a class="btn btn-sm btn-outline-primary" target="_blank"
                                                    href={{ asset($getPeriodeAktif->name . '/' . $getAdministrasiUser->user->id . '/' . $getAdministrasiUser->file_transkrip) }}>Lihat
                                                    Transkrip Tersimpan</a>
                                                <a style="cursor: pointer;"
                                                    onclick="window.location.href='{{ route('fileadm.destroy', 'file_transkrip') }}';"
                                                    class="btn-sm btn-light border border-danger text-danger ml-3">Hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>

                    {{-- ============== KONTAK ============== --}}
                    <div class="col-md-8 mb-5 px-0">
                        <div class="card">
                            <div class="card-header h4">
                                <b>Kontak</b>
                            </div>
                            <div class="card-body">


                                <div class="row mb-3 datadiri">
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

                                <div class="row mb-3 datadiri">
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
                                <div class="row mb-3 datadiri">
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

                        @if (isset($getAdministrasiUser))
                            <div class=" text-center">
                                <button type="button" id="tombolEdit" class="btn btn-xl m-3 btn-secondary"
                                    onclick="izinkanEdit();">Ubah Data</button>
                                <div id="tombolSimpan" style="display: none;">
                                    <button type="submit" class="btn btn-xl m-3 btn-primary">
                                        Simpan
                                        Perubahan
                                    </button>
                                </div>
                            </div>
                        @else
                            <div class="text-center mt-4">
                                <br>
                                <button type="submit" class="btn btn-success">Submit</button>
                                <br><br><small>Anda dapat mengubahnya kembali<br>(jika dan hanya jika waktu masih
                                    tersedia).</small>
                            </div>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <footer class="pt-3 pt-3 pb-1 border-top bg-dark">
            <div class="text-center bg-dark text-white">
                <p>&copy; Sariraya 2022</p>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
                integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
                integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
        </script>

        {{-- Browse Show Name --}}
        <script type="text/javascript">
            $('.custom-file input').change(function(e) {
                var files = [];
                for (var i = 0; i < $(this)[0].files.length; i++) {
                    files.push($(this)[0].files[i].name);
                }
                $(this).next('.custom-file-label').html(files.join(', '));
            });
        </script>

        <script>
            $(document).ready(function() {
                today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date()
                    .getDate());
                $('.datepicker').datepicker({
                    format: 'yyyy-mm-dd',
                    uiLibrary: 'bootstrap4',
                    iconsLibrary: 'fontawesome',
                    showRightIcon: false,
                    maxDate: today,
                    modal: true,
                    autoclose: true,
                    footer: true
                });
            });
        </script>

        @if (!isset($getAdministrasiUser))
            <script>
                $(document).ready(function() {});
                document.querySelectorAll('.editable').forEach(b => b.removeAttribute('disabled'));
            </script>
        @endif

        <script>
            function izinkanEdit() {
                var $tombolSimpan = $("#tombolSimpan");
                var $tombolEdit = document.getElementById("tombolEdit");
                document.querySelectorAll('.editable').forEach(b => b.toggleAttribute('disabled'));
                $tombolSimpan.css("display", $tombolSimpan.css("display") === 'none' ? 'inline' : 'none');
                $tombolEdit.innerHTML = ($tombolEdit.innerHTML ===
                    'Ubah Data' ? 'Batalkan' : 'Ubah Data');
                if ($tombolEdit.innerHTML === 'Ubah Data') {
                    location.reload();
                }
            }
        </script>

        @if (count($errors) > 0 && isset($getAdministrasiUser))
            <script type="text/javascript">
                $(document).ready(function() {
                    izinkanEdit();
                });
            </script>
        @endif

    </div>
</body>

</html>
