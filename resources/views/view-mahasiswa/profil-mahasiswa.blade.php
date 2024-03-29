@extends('layouts.app')

@section('content')
    <div class="container mt-3 test">

        <h1 class="text-center mt-4 mb-4 test"> <b>BEASISWA SARIRAYA JAPAN 2022</b> </h1>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="text-center">
            @if (Auth::user()->picture == null)
                @if ($getPeriodeAktif->status_adm == null && $getTanggalSekarang > $getPeriodeAktif->ta_adm->format('Y-m-d'))
                    <div class="alert alert-danger" role="alert">
                        <strong>Anda Terdiskualifikasi! </strong>Tahap Administrasi Telah Ditutup dan
                        Anda belum melakukan
                        Upload Foto!.
                    </div>
                @else
                    <div class="alert alert-warning" role="alert">
                        <strong>Wajib melakukan Upload Foto Profil</strong>, untuk melanjutkan ke
                        Halaman Anda!
                        <p class="mb-0">
                            <strong>Jika Profil Kosong</strong> hingga Waktu Pengubahan berakhir, maka
                            Anda akan<strong>
                                Terdiskualifikasi!</strong>
                        </p>
                    </div>
                @endif
            @endif
            @if (Route::has('register') && $getTanggalSekarang <= $getPeriodeAktif->ta_adm)
                <div class="alert alert-info" role="alert">
                    <strong>Foto & Data Diri</strong> dapat diubah sampai :
                    <strong>{{ \Carbon\Carbon::parse($getPeriodeAktif->ta_adm)->isoFormat('dddd, D MMMM Y - 23:59') }}</strong>
                </div>
            @endif
            <div class="alert alert-info rounded py-3 mb-3">
                <p class="mb-2">Tahap saat ini:</p>
                <div class="mb-3">
                    @if ($getPeriodeAktif->status_adm == null && $getTanggalSekarang < $getPeriodeAktif->tm_adm->format('Y-m-d'))
                        <a href="/tahap-administrasi" class="btn btn-secondary">Tahap Administrasi
                            Belum Dimulai.
                        </a>
                    @elseif (
                        $getPeriodeAktif->status_adm == null &&
                            $getTanggalSekarang >= $getPeriodeAktif->tm_adm->format('Y-m-d') &&
                            $getTanggalSekarang <= $getPeriodeAktif->ta_adm->format('Y-m-d'))
                        <a href="/tahap-administrasi" class="btn btn-primary">Tahap Administrasi Dimulai
                        </a>
                    @elseif ($getPeriodeAktif->status_adm == null && $getTanggalSekarang > $getPeriodeAktif->ta_adm->format('Y-m-d'))
                        <a href="/tahap-administrasi" class="btn btn-secondary">Tahap Administrasi
                            Ditutup
                        </a>
                    @elseif ($getPeriodeAktif->status_adm == 'Selesai' && $getTanggalSekarang < $getPeriodeAktif->tm_wwn->format('Y-m-d'))
                        <a href="/tahap-administrasi" class="btn btn-primary">Lihat Pengumuman
                            Administrasi
                        </a>
                    @elseif (
                        $getPeriodeAktif->status_adm == 'Selesai' &&
                            $getPeriodeAktif->status_wwn == null &&
                            $getTanggalSekarang >= $getPeriodeAktif->tm_wwn->format('Y-m-d') &&
                            $getTanggalSekarang <= $getPeriodeAktif->ta_wwn->format('Y-m-d'))
                        <a href="/tahap-wawancara" class="btn btn-primary">Tahap Wawancara Dimulai
                        </a>
                    @elseif (
                        $getPeriodeAktif->status_adm == 'Selesai' &&
                            $getPeriodeAktif->status_wwn == null &&
                            $getTanggalSekarang > $getPeriodeAktif->ta_wwn->format('Y-m-d'))
                        <a href="/tahap-wawancara" class="btn btn-secondary">Tahap Wawancara Ditutup
                        </a>
                    @elseif ($getPeriodeAktif->status_wwn == 'Selesai' && $getTanggalSekarang < $getPeriodeAktif->tm_png->format('Y-m-d'))
                        <a href="/tahap-wawancara" class="btn btn-primary">Lihat Pengumuman
                            Wawancara
                        </a>
                    @elseif (
                        $getPeriodeAktif->status_wwn == 'Selesai' &&
                            $getPeriodeAktif->status_png == null &&
                            $getTanggalSekarang >= $getPeriodeAktif->tm_png->format('Y-m-d') &&
                            $getTanggalSekarang <= $getPeriodeAktif->ta_png->format('Y-m-d'))
                        <a href="/tahap-penugasan" class="btn btn-primary">Tahap Penugasan Dimulai
                        </a>
                    @elseif (
                        $getPeriodeAktif->status_wwn == 'Selesai' &&
                            $getPeriodeAktif->status_png == null &&
                            $getTanggalSekarang > $getPeriodeAktif->ta_png->format('Y-m-d'))
                        <a href="/tahap-penugasan" class="btn btn-primary">Tahap Penugasan Ditutup
                        </a>
                    @elseif ($getPeriodeAktif->status_wwn == 'Selesai' && $getPeriodeAktif->status_png == 'Selesai')
                        <a href="/tahap-penugasan" class="btn btn-primary">Lihat Pengumuman Final
                        </a>
                    @endif
                </div>
                @if (isset($getAdministrasiUser))
                    <div>
                        Nomor Pendaftaran Anda: <span
                            class="font-weight-bold">{{ $getAdministrasiUser->no_pendaftaran }}</span>
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
                <div class="alert alert-secondary myshadow kotakprofil pb-0">
                    <div class="mb-3 pt-1 mx-auto rounded-top-md">
                        <span class="h5">Riwayat Pengajuan Beasiswa:</span>
                        @if (isset($getRiwayatUser) && $getRiwayatUser->count() == 0)
                            <p class="mt-3">Tidak ada riwayat.</p>
                        @endif
                        <!-- Table row -->
                    </div>
                    <div class="row">
                        <div class="col-12">
                            @if (isset($getRiwayatUser))
                                @foreach ($getRiwayatUser as $riwayatUser)
                                    <div class="d-flex mb-3 rounded py-2 px-3"
                                        style="background-color:#ebedf1; overflow-x: auto; white-space: nowrap;">
                                        <div class="h6 pt-2 mt-1 mr-5 font-weight-bold">
                                            {{ ucfirst($riwayatUser->periode->name) }}</th>
                                        </div>
                                        <div class="h6 pt-2 mt-1 mr-2">Administrasi :</div>
                                        <div
                                            class="mr-5 h6 pt-2 mt-1  {{ $riwayatUser->status_adm == 'lolos' ? 'text-success' : '' }} {{ $riwayatUser->status_adm == 'gagal' ? 'text-danger' : '' }} {{ $riwayatUser->status_adm == null ? 'text-secondary' : '' }}">
                                            {{ !isset($riwayatUser->status_adm) ? 'Telah Submit' : '' }}
                                            {{ ucfirst($riwayatUser->status_adm) }}
                                        </div>
                                        <div class="h6 pt-2 mt-1 mr-2">Wawancara :</div>
                                        <div
                                            class="mr-5 h6 pt-2 mt-1 
                                {{ !isset($riwayatUser->wawancara->status_wwn) ? 'text-secondary' : '' }}
                            {{ isset($riwayatUser->wawancara->status_wwn) && $riwayatUser->wawancara->status_wwn == 'lolos' ? 'text-success' : '' }}
                            {{ isset($riwayatUser->wawancara->status_wwn) && $riwayatUser->wawancara->status_wwn == 'gagal' ? 'text-danger' : '' }}">
                                            {{ !isset($riwayatUser->wawancara->status_wwn) ? '-' : '' }}
                                            {{ isset($riwayatUser->wawancara->status_wwn) && $riwayatUser->wawancara->status_wwn == 'lolos' ? 'Lolos' : '' }}
                                            {{ isset($riwayatUser->wawancara->status_wwn) && $riwayatUser->wawancara->status_wwn == 'gagal' ? 'Gagal' : '' }}
                                        </div>
                                        <div class="h6 pt-2 mt-1 mr-2">Final :</div>
                                        <div
                                            class="mr-5 h6 pt-2 mt-1 
                            {{ !isset($riwayatUser->wawancara->penugasan->status_png) ? 'text-secondary' : '' }}
                            {{ isset($riwayatUser->wawancara->penugasan->status_png) && $riwayatUser->wawancara->penugasan->status_png == 'lolos' ? 'text-success' : '' }}
                            {{ isset($riwayatUser->wawancara->penugasan->status_png) && $riwayatUser->wawancara->penugasan->status_png == 'gagal' ? 'text-danger' : '' }}">
                                            {{ !isset($riwayatUser->wawancara->penugasan->status_png) ? '-' : '' }}
                                            {{ isset($riwayatUser->wawancara->penugasan->status_png) && $riwayatUser->wawancara->penugasan->status_png == 'lolos' ? 'Lolos' : '' }}
                                            {{ isset($riwayatUser->wawancara->penugasan->status_png) && $riwayatUser->wawancara->penugasan->status_png == 'gagal' ? 'Gagal' : '' }}
                                        </div>
                                        {{-- <a class="btn btn-primary btn-sm m-2 px-3 rounded" href="#">
                            Detail
                        </a>
                        <a class="btn btn-info btn-sm m-2 px-3 rounded" href="#">
                            Edit
                        </a> --}}
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>

        <!-- Main content -->
        <div class="row">
            <div class="col-lg-4 pr-xl-0">
                <div class="alert alert-secondary myshadow mb-3 kotakprofil">
                    <div class="mb-3 pt-1 mx-auto rounded-top-md">
                        <span class="h5 ">Foto</span>
                        @if (Route::has('register') && $getTanggalSekarang <= $getPeriodeAktif->ta_adm)
                            <span>
                                <button type="button" id="tombolEditFoto"
                                    class="float-left btn btn-sm btn-primary float-right" data-toggle="modal"
                                    data-target="#editFotoModal">
                                    Upload Foto
                                </button>
                            </span>
                        @endif
                    </div>
                    <!-- /.card-header -->
                    @error('Foto')
                        <div class="alert alert-danger mb-2 text-danger font-weight-bold" role="alert">{{ $message }}
                        </div>
                    @enderror
                    <div class="alert   d-flex mx-auto flex-column pt-2 pb-0">
                        <div class="mx-auto mb-2">
                            <img src="{{ asset('pictures') . '/' }}{{ Auth::user()->picture == '' ? 'noimg.png' : Auth::user()->picture }}"
                                class="rounded" alt="User Image" height="280px" width="210px">
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

            <div class="col-lg-8">
                <div class="alert alert-secondary rounded-md myshadow mb-3">
                    <div class="mb-3 pt-1 mx-auto rounded-top-md">
                        <span class="h5 ">Data Diri</span>
                        @if (Route::has('register') && $getTanggalSekarang <= $getPeriodeAktif->ta_adm)
                            <span>
                                <button id="tombolEditProfil" type="button"
                                    class="float-right btn btn-sm btn-primary float-right" data-toggle="modal"
                                    data-target="#editProfil">
                                    Ubah Data
                                </button>
                            </span>
                        @endif
                    </div><!-- /.card-header -->
                    <!-- Table row -->
                    <div class="row px-0 m-0">
                        <div class="col-12 alert table-responsive p-0 pr-3 m-0">
                            <table class="table p-0 m-0">
                                <tbody>
                                    <tr style="margin-top: 0;">
                                        <th style="padding-left: 0;" style="width: 28%;">Nama</td>
                                        <th style="width: 2%">:</td>
                                        <th style="width: 68%">{{ Auth::user()->name }}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding-left: 0;">Email Address</th>
                                        <th>:</th>
                                        <th>{{ Auth::user()->email }}</th>
                                    </tr>
                                    <tr>
                                        <th style="padding-left: 0;">Perguruan Tinggi</th>
                                        <th>:</th>
                                        <th>{{ Auth::user()->univ->nama_universitas }}</th>
                                    </tr>
                                    <tr>
                                        <th style="padding-left: 0;">Program Studi</th>
                                        <th>:</th>
                                        <th>{{ Auth::user()->prodi->nama_prodi }}</th>
                                    </tr>
                                    <tr>
                                        <th style="padding-left: 0;">NIM</th>
                                        <th>:</th>
                                        <th>{{ Auth::user()->nim }}</th>
                                    </tr>
                                    <tr>
                                        <td style="padding-left: 0;">Email Terverifikasi</td>
                                        <td>:</td>
                                        <td>{{ Auth::user()->email_verified_at == '' ? '' : Auth::user()->email_verified_at->translatedFormat('l, d F Y - H:i:s') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left: 0;">Akun Dibuat</td>
                                        <td>:</td>
                                        <td>{{ Auth::user()->created_at == '' ? '' : Auth::user()->created_at->translatedFormat('l, d F Y - H:i:s') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left: 0;">Akun Diperbarui</td>
                                        <td>:</td>
                                        <td>{{ Auth::user()->updated_at == '' ? '' : Auth::user()->updated_at->translatedFormat('l, d F Y - H:i:s') }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>

    @if (Route::has('register') && $getTanggalSekarang <= $getPeriodeAktif->ta_adm)
        {{-- MODAL UPLOAD FOTO --}}
        <div class="modal fade" id="editFotoModal" tabindex="-1" role="dialog" aria-labelledby="editFotoModal"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('upload.foto') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="modal-header">
                            <h5 class="modal-title" id="editFotoModal">Upload File Pas Foto 3x4</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body pb-0 pt-2">
                            <div class="card-body rounded-bottom-md py-0">
                                <div class="mb-3 text-center alert alert-info p-1">
                                    <small>Format Pas Foto: <span class="font-weight-bold"> .jpg, .png, </span>atau <span
                                            class="font-weight-bold">.jpeg</span></small><br>
                                    <small>Maksimal ukuran file: <span class="font-weight-bold">512KB
                                        </span></small>
                                </div>
                                <img class="img-preview mb-3 d-flex mx-auto" alt="" width="210px"
                                    height="280px" style="max-width: 210px; max-height:280px">
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="Foto" name="Foto"
                                            accept="image/jpg, image/jpeg, image/png" onchange="previewImage()"
                                            value="{{ old('Foto') }}">
                                        <label class="custom-file-label" for="Foto">Pilih
                                            File</label>
                                    </div>
                                </div>
                            </div>
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- MODAL EDIT PROFIL --}}
        <div class="modal fade" id="editProfil" tabindex="-1" role="dialog" aria-labelledby="editProfil"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content p-3">
                    <form method="POST" action="{{ route('update.myuser') }}">
                        @csrf
                        <div class="modal-header pt-0 mb-3">
                            <h5 class="modal-title" id="editFotoModal">Formulir Ubah Data Anda</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="row mb-3">
                            <label for="name"
                                class="col-md-4 col-form-label text-md-right">{{ __('Nama Lengkap') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name', Auth::user()->name) }}" autocomplete="name" autofocus>

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
                                <input id="nim" type="text"
                                    class="form-control @error('nim') is-invalid @enderror" name="nim"
                                    value="{{ old('nim', Auth::user()->nim) }}" autocomplete="nim" autofocus>

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
                                <select id="univ_id" name="univ_id" class="form-control select"
                                    data-live-search="true" onchange="univLainnya(this);">
                                    <option value="0" disabled selected>--- Pilih ---
                                    </option>
                                    <option {{ old('univ_id') == 'other' ? 'selected' : '' }} value="other">--- Isi
                                        yang
                                        Lain
                                        ---
                                    </option>
                                    @foreach ($getAllUniv as $univ)
                                        <option {{ old('univ_id', Auth::user()->univ_id) == $univ->id ? 'selected' : '' }}
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
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('Password Baru (Opsional)') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    autocomplete="new-password" placeholder="Isi untuk mengubah password.">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-right">{{ __('Konfirmasi Password Baru') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" autocomplete="new-password"
                                    placeholder="Tulis kembali password baru.">
                            </div>
                        </div>

                        <div class="modal-footer p-0 pt-3">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <script>
        function previewImage() {
            const image = document.querySelector('#Foto');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>

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
