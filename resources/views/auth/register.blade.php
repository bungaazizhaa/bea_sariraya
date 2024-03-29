<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Beasiswa Sariraya</title>
    <meta name="description"
        content="Bergabung dan Daftarkan diri Anda pada Program Beasiswa Sariraya yang diadakan oleh perusahaan Sariraya Co., Ltd.">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/images') }}"> --}}
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- SelectPicker -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js" defer></script>
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

            <div class="col-12 pl-lg-0 col-lg-7 text-lg-left text-center my-md-auto mt-3">

                <a href="/" class="d-lg-none mt-3 text-center">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="" width="35%">
                </a>
                <div class="welcom mt-lg-4 mt-3 mt-lg-0 mb-lg-5 w-100 px-3 mx-1">
                    <p>Program Beasiswa Sariraya Japan {{ ucfirst($getPeriodeAktif->name) }}</p>
                    <p class="h2">{{ isset($getPeriodeAktif) ? 'Sedang Berlangsung.' : 'Belum Dibuka.' }}
                </div>
            </div>

            <div class="col-12 col-lg-5 my-0 mt-4 pt-1">
                <div class="card regis mx-lg-3 ml-lg-4 mt-lg-3 mb-lg-3 mt-2 mb-5">
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="text-center">
                                <p class="h4 mb-4">Register</p>
                            </div>
                            <div class="form-group">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus
                                    placeholder="Nama Lengkap">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input id="nim" type="text"
                                    class="form-control @error('nim') is-invalid @enderror" name="nim"
                                    value="{{ old('nim') }}" required autocomplete="nim" autofocus
                                    placeholder="NIM">

                                @error('nim')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col {{ old('Input_Universitas') == null ? 'col-12' : 'col-4 pr-0' }}"
                                        id="col_univ_id">
                                        <select id="univ_id" name="univ_id" class="form-control selectpicker"
                                            onchange="univLainnya(this);" title="Asal Perguruan Tinggi"
                                            data-live-search="true" required>
                                            {{-- <option disabled selected>Asal Perguruan Tinggi
                                            </option> --}}
                                            <option style="max-width:330px; color:#3588da!important"
                                                {{ old('univ_id') == 'other' ? 'selected' : '' }} value="other">
                                                + Tambahkan Pilihan Baru...
                                            </option>
                                            @foreach ($getAllUniv as $univ)
                                                <option style="max-width:330px;"
                                                    {{ old('univ_id') == $univ->id ? 'selected' : '' }}
                                                    value="{{ $univ->id }}">
                                                    {{ $univ->nama_universitas }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('univ_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-8" id="input_Input_Universitas"
                                        style="display: {{ old('Input_Universitas') == null ? 'none' : 'block' }};">
                                        <input id="Input_Universitas" type="text"
                                            class="form-control @error('Input_Universitas') is-invalid @enderror"
                                            name="Input_Universitas" value="{{ old('Input_Universitas') }}"
                                            autocomplete="Input_Universitas" autofocus placeholder="Perguruan Tinggi">

                                        @error('Input_Universitas')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <select id="prodi_id" name="prodi_id" class="form-control selectpicker"
                                    title="Program Studi" data-live-search="true" required>
                                    {{-- <option value="" disabled selected>Program Studi
                                    </option> --}}
                                    @foreach ($getAllProdi as $prodi)
                                        <option {{ old('prodi_id') == $prodi->id ? 'selected' : '' }}
                                            value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('prodi_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password" placeholder="Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="Konfirmasi Password">
                            </div>
                            <div class="text-center">
                                <div class="button-submit">
                                    <button type="submit" class="btn tombol mb-3 buttonSubmit">Register</button>
                                </div>
                                <p class="font-weight-normal mb-0">Sudah punya akun ? <a
                                        href="{{ route('login') }}">Login
                                        disini.</a></p>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <script>
        function univLainnya(that) {
            if (that.value == "other") {
                document.getElementById("input_Input_Universitas").style.display = "block";
                document.getElementById("Input_Universitas").required = true;
                document.getElementById("Input_Universitas").focus();
                document.getElementById("col_univ_id").classList.remove("col-12");
                document.getElementById("col_univ_id").classList.add("col-4");
                document.getElementById("col_univ_id").classList.add("pr-0");
            } else {
                document.getElementById("col_univ_id").classList.remove("pr-0");
                document.getElementById("col_univ_id").classList.remove("col-4");
                document.getElementById("col_univ_id").classList.add("col-12");
                document.getElementById("input_Input_Universitas").style.display = "none";
                document.getElementById("Input_Universitas").value = null;
                document.getElementById("Input_Universitas").required = false;

            }
        }
    </script>

    <script>
        $(".buttonSubmit").click(function() {
            $(this).html(
                '  <span class="spinner-border spinner-border-sm my-1" role="status" aria-hidden="true"></span> Tunggu...'
            );
            var isValid = true;
            $('input').filter('[required]:visible').each(function() {
                if ($(this).val() === '')
                    isValid = false;
            });

            if (isValid === true) {
                $(this).closest('form').submit();
                $(this).prop("disabled", true);
            } else {
                setTimeout(() => {
                    $(this).prop("disabled", false);
                    $(this).html("Register");
                }, 100);
            }
        });
    </script>
</body>

</html>
