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
    <div id="main-content" class="container ">
        <h1 class="text-center mt-5">Tahap Administrasi</h1>

        <form id="admForm" method="POST" action="{{ route('update.administrasi') }}">
            @csrf
            @if (isset($getAdministrasiUser))
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
                <div class="col-md-8 mb-5 px-0">
                    <div class="card">
                        <div class="card-header h4">
                            Data Diri
                        </div>
                        <div class="card-body">

                            @if (isset($getAdministrasiUser))
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
                                        autocomplete="tempat_lahir" placeholder="Nama Kota Atau Kabupaten">

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
                                        value="{{ old('tanggal_lahir',isset($getAdministrasiUser) ? $getAdministrasiUser->tanggal_lahir->format('Y-m-d') : '') }}"
                                        autocomplete="tanggal_lahir" placeholder="YYYY-MM-DD">
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
                                        autocomplete="semester" placeholder="Antara 6 sampai 14">

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
                                        autocomplete="ipk" placeholder="Misal, 3.70">

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
                                        autocomplete="keahlian" placeholder="Misal, Web Developer">

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

                            {{--  --}}

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

                            {{--  --}}

                        </div>
                    </div>

                    @if (isset($getAdministrasiUser))
                        <div class="fixed-bottom text-center">
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
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
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
            document.getElementById("tempat_lahir").focus();
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
</body>

</html>
