<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tahap Penugasan</title>
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

    <!-- CSS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

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
            <h1 class="text-center mt-3 test"> <b>BEASISWA SARIRAYA JAPAN {{ strtoupper($getPeriodeAktif->name) }}</b>
            </h1>
            <h1 class="text-center mt-3 test">Tahap Penugasan</h1>
            <hr class="container" style="width:65vw;" />
            @if (isset($getPenugasanUser))
                <p class="text-center mb-1">Data Anda disimpan pada : <span
                        class="text-nowrap">{{ $getPenugasanUser->updated_at->diffForHumans() }}</span>
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
                    function submitPng() {
                        $("#pngForm").submit();
                    }
                    countdown.setLabels(
                        ' Milidetik| Detik| Menit| Jam| Hari| Minggu| Bulan| Tahun| Dekade| Abad| Ribu',
                        ' Milidetik| Detik| Menit| Jam| Hari| Minggu| Bulan| Tahun| Dekade| Abad| Ribu',
                        ', ',
                        ', ',
                        'Sekarang!');
                    var ta_png = '{{ $getPeriodeAktif->ta_png }}';
                    var then = moment(ta_png, 'YYYY-MM-DD').add(1, 'days').locale('id');
                    (function timerLoop() {
                        $("#countdownAdm").text(countdown(then).toString());
                        if (countdown(then).toString() === 'Sekarang!') {
                            cancelAnimationFrame(timerLoop);
                            setTimeout(submitPng, 990)
                        } else {
                            requestAnimationFrame(timerLoop);
                        }
                    })();
                </script>
                {{-- ============== DATA DIRI ============== --}}
                <div class="col-md-8 mb-5 px-0">
                    <div class="card">
                        <div class="card-header h4">
                            Data Diri
                        </div>
                        <div class="card-body">

                            @if (isset($getPenugasanUser))
                                <div class="row mb-3">
                                    <label for="no_pendaftaran"
                                        class="col-md-4 col-form-label text-md-right">{{ __('No Pendaftaran') }}</label>

                                    <div class="col-md-6">
                                        {{-- <input id="no_pendaftaran" type="hidden"
                                        class="form-control @error('no_pendaftaran') is-invalid @enderror"
                                        name="no_pendaftaran"
                                        value="{{ old('no_pendaftaran', strtoupper($getPeriodeAktif->id . uniqid())) }}"
                                    autocomplete="no_pendaftaran" > --}}
                                        <input id="no_pendaftaran" type="text" disabled
                                            class="form-control @error('no_pendaftaran') is-invalid @enderror"
                                            name="no_pendaftaran"
                                            value="{{ $getPenugasanUser->wawancara->administrasi->no_pendaftaran }}"
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
                        </div>
                    </div>
                </div>

                {{-- ============== JAWABAN TUGAS ============== --}}
                <div class="col-md-8 mb-5 px-0">
                    <div class="card">
                        <div class="card-header h4">
                            Tugas Anda!
                        </div>
                        <div class="card-body">
                            <form id="pngForm" method="POST" action="{{ route('update.penugasan') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label for="field_jawaban"
                                        class="col-12 col-form-label">{{ __('Soal :') }}</label>

                                    <div class="col-12">
                                        <strong>{{ $getPenugasanUser->soal }}</strong>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="field_jawaban"
                                        class="col-12 col-form-label">{{ __('Kolom Jawaban :') }}</label>

                                    <div class="col-12">
                                        <textarea id="field_jawaban" type="text" disabled onkeyup="textAreaAdjust(this)" style="overflow:hidden; font-size:15pt"
                                            class="form-control editable @error('field_jawaban') is-invalid @enderror" name="field_jawaban"
                                            autocomplete="field_jawaban" placeholder="Isi disini jika Jawaban Tugas berupa Uraian Kata.">{{ old('field_jawaban', $getAdministrasiUser->wawancara->penugasan->field_jawaban) }}</textarea>

                                        @error('field_jawaban')
                                            <div class="text-danger small" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>

                                    <script>
                                        function textAreaAdjust(element) {
                                            element.style.height = "1px";
                                            element.style.height = (25 + element.scrollHeight) + "px";
                                        }
                                        $(document).ready(function() {
                                            var element = document.getElementById("field_jawaban");
                                            textAreaAdjust(element);
                                        });
                                    </script>
                                </div>

                                <div class="row mb-3">
                                    <label for="file_jawaban" class="col-12 col-form-label">Unggah
                                        File :</label>
                                    <div class="col-12">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input editable" disabled
                                                    id="file_jawaban" name="file_jawaban"
                                                    value="{{ old('file_jawaban', $getPenugasanUser->file_jawaban) }}">
                                                <label class="custom-file-label" for="file_jawaban">Pilih File</label>
                                            </div>
                                        </div>
                                        @error('file_jawaban')
                                            <div class="text-danger small" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </form>
                            @if (isset($getPenugasanUser->file_jawaban))
                                <div class="row mb-3">
                                    <label for="file_jawaban" class="col-12 col-form-label">File Tugas Tersimpan
                                        :</label>
                                    <div class="col-12">
                                        <div class="input-group">
                                            <a class="btn btn-primary" target="_blank"
                                                href={{ asset($getPeriodeAktif->name . '/' . $getAdministrasiUser->user->id . '/' . $getPenugasanUser->file_jawaban) }}>View</a>
                                            <form id="deleteFj" method="post" class="ml-3"
                                                action="{{ route('filejawaban.destroy', $getPenugasanUser->id) }}">
                                                @csrf
                                                <button form="deleteFj" type="submit"
                                                    class="btn btn-outline-danger">Delete
                                                    File</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <script type="text/javascript">
                                $('.custom-file input').change(function(e) {
                                    var files = [];
                                    for (var i = 0; i < $(this)[0].files.length; i++) {
                                        files.push($(this)[0].files[i].name);
                                    }
                                    $(this).next('.custom-file-label').html(files.join(', '));
                                });
                            </script>
                        </div>
                        <div class=" text-center w-25 mx-auto">
                            <button type="button" id="tombolEdit" class="btn btn-xl m-3 btn-secondary"
                                onclick="izinkanEdit();">Ubah Jawaban Tugas</button>
                            <div id="tombolSimpan" style="display: none;">
                                <button form="pngForm" type="submit" class="btn btn-xl m-3 btn-primary">
                                    Simpan
                                    Perubahan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="pt-3 pt-3 pb-1 border-top bg-dark mt-auto">
            <div class="text-center bg-dark text-white">
                <p>&copy; Sariraya 2022</p>
            </div>
        </footer>
</body>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

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

@if (!isset($getPenugasanUser))
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
            'Ubah Jawaban Tugas' ? 'Batalkan' : 'Ubah Jawaban Tugas');
        if ($tombolEdit.innerHTML === 'Ubah Jawaban Tugas') {
            location.reload();
        }
    }
</script>

@if (count($errors) > 0 && isset($getPenugasanUser))
    <script type="text/javascript">
        $(document).ready(function() {
            izinkanEdit();
        });
    </script>
@endif
</body>

</html>
