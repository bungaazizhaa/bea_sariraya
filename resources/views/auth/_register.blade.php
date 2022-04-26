@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Nama Lengkap') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="nim" class="col-md-4 col-form-label text-md-right">{{ __('NIM') }}</label>

                                <div class="col-md-6">
                                    <input id="nim" type="text" class="form-control @error('nim') is-invalid @enderror"
                                        name="nim" value="{{ old('nim') }}" required autocomplete="nim" autofocus>

                                    @error('nim')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="univ_id"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Asal Perguruan Tinggi') }}</label>

                                <div class="col-md-6">
                                    <select id="univ_id" name="univ_id" class="form-control selectpicker"
                                        data-style="btn btn-outline-secondary" onchange="univLainnya(this);"
                                        data-live-search="true" required>
                                        <option disabled selected>--- Pilih ---
                                        </option>
                                        <option {{ old('univ_id') == 'other' ? 'selected' : '' }} value="other">---
                                            Isi yang Lainnya
                                            ---
                                        </option>
                                        @foreach ($getAllUniv as $univ)
                                            <option {{ old('univ_id') == $univ->id ? 'selected' : '' }}
                                                value="{{ $univ->id }}">
                                                {{ $univ->id . '. ' . $univ->nama_universitas }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('univ_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div id="inputuniv" style="display: {{ old('univ_id_manual') == null ? 'none' : 'block' }};">
                                <div class="row mb-3">

                                    <label for="univ_id_manual"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Masukkan Perguruan Tinggi') }}</label>

                                    <div class="col-md-6">
                                        <input id="univ_id_manual" type="text"
                                            class="form-control @error('univ_id_manual') is-invalid @enderror"
                                            name="univ_id_manual" value="{{ old('univ_id_manual') }}"
                                            autocomplete="univ_id_manual" autofocus>

                                        @error('univ_id_manual')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="prodi_id"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Program Studi') }}</label>

                                <div class="col-md-6">
                                    <select id="prodi_id" name="prodi_id" class="form-control selectpicker"
                                        data-style="btn btn-outline-secondary" data-live-search="true" required>
                                        <option value="" disabled selected>--- Pilih ---
                                        </option>
                                        @foreach ($getAllProdi as $prodi)
                                            <option {{ old('prodi_id') == $prodi->id ? 'selected' : '' }}
                                                value="{{ $prodi->id }}">{{ $prodi->id . '. ' . $prodi->nama_prodi }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('prodi_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function univLainnya(that) {
            if (that.value == "other") {
                document.getElementById("inputuniv").style.display = "block";
                document.getElementById("univ_id_manual").required = true;
                document.getElementById("univ_id_manual").focus();
            } else {
                document.getElementById("inputuniv").style.display = "none";
                document.getElementById("univ_id_manual").value = null;
                document.getElementById("univ_id_manual").required = false;

            }
        }
    </script>
@endsection
