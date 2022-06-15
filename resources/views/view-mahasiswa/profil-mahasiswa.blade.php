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
                @if (!Route::has('register') && $getTanggalSekarang > $getPeriodeAktif->ta_adm)
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
                    @elseif ($getPeriodeAktif->status_adm == null && $getTanggalSekarang >= $getPeriodeAktif->tm_adm->format('Y-m-d') && $getTanggalSekarang <= $getPeriodeAktif->ta_adm->format('Y-m-d'))
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
                    @elseif ($getPeriodeAktif->status_adm == 'Selesai' && $getPeriodeAktif->status_wwn == null && $getTanggalSekarang >= $getPeriodeAktif->tm_wwn->format('Y-m-d') && $getTanggalSekarang <= $getPeriodeAktif->ta_wwn->format('Y-m-d'))
                        <a href="/tahap-wawancara" class="btn btn-primary">Tahap Wawancara Dimulai
                        </a>
                    @elseif ($getPeriodeAktif->status_adm == 'Selesai' && $getPeriodeAktif->status_wwn == null && $getTanggalSekarang > $getPeriodeAktif->ta_wwn->format('Y-m-d'))
                        <a href="/tahap-wawancara" class="btn btn-secondary">Tahap Wawancara Ditutup
                        </a>
                    @elseif ($getPeriodeAktif->status_wwn == 'Selesai' && $getTanggalSekarang < $getPeriodeAktif->tm_png->format('Y-m-d'))
                        <a href="/tahap-wawancara" class="btn btn-primary">Lihat Pengumuman
                            Wawancara
                        </a>
                    @elseif ($getPeriodeAktif->status_wwn == 'Selesai' && $getPeriodeAktif->status_png == null)
                        <a href="/tahap-penugasan" class="btn btn-primary">Tahap Penugasan
                        </a>
                    @elseif ($getPeriodeAktif->status_wwn == 'Selesai' && $getPeriodeAktif->status_png == 'Selesai')
                        <a href="/tahap-penugasan" class="btn btn-primary">Lihat Pengumuman Final
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="row">
            <div class="col-lg-4 pr-md-0">
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
                    <div class="alert   d-flex mx-auto flex-column pt-2 pb-0">
                        <div class="mx-auto mb-2">
                            <img src="/pictures/{{ Auth::user()->picture == '' ? 'noimg.png' : Auth::user()->picture }}"
                                class="rounded" alt="User Image" height="280px" width="210px">
                        </div>
                        @error('Foto')
                            <div class="alert alert-danger mb-2" role="alert">{{ $message }}</div>
                        @enderror
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
                    <div class="row px-3">
                        <div class="col-12 alert table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <th style="width: 30%">Nama</td>
                                        <th style="width: 2%">:</td>
                                        <th style="width: 68%">{{ Auth::user()->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email Address</th>
                                        <th>:</th>
                                        <th>{{ Auth::user()->email }}</th>
                                    </tr>
                                    <tr>
                                        <th>Perguruan Tinggi</th>
                                        <th>:</th>
                                        <th>{{ Auth::user()->univ->nama_universitas }}</th>
                                    </tr>
                                    <tr>
                                        <th>Program Studi</th>
                                        <th>:</th>
                                        <th>{{ Auth::user()->prodi->nama_prodi }}</th>
                                    </tr>
                                    <tr>
                                        <td>NIM</td>
                                        <td>:</td>
                                        <td>{{ Auth::user()->nim }}</td>
                                    </tr>
                                    {{-- <tr>
                                                        <td>ID User</td>
                                                        <td>:</td>
                                                        <td>{{ Auth::user()->id }}</td>
                                </tr> --}}
                                    <tr>
                                        <td>Email Terverifikasi</td>
                                        <td>:</td>
                                        <td>{{ Auth::user()->email_verified_at == '' ? '' : Auth::user()->email_verified_at->translatedFormat('l, d F Y - H:i:s') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Akun Dibuat</td>
                                        <td>:</td>
                                        <td>{{ Auth::user()->created_at == '' ? '' : Auth::user()->created_at->translatedFormat('l, d F Y - H:i:s') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Akun Diperbarui</td>
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
                        <div class="modal-body">
                            <div class="card-body rounded-bottom-md">
                                <img class="img-preview mb-2 d-flex mx-auto" alt="" width="210px" height="280px"
                                    style="max-width: 210px; max-height:280px">
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="Foto" name="Foto"
                                            onchange="previewImage()" value="{{ old('Foto') }}">
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
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save changes</button>
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
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name', Auth::user()->name) }}" autocomplete="name"
                                    autofocus>

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
                                    name="nim" value="{{ old('nim', Auth::user()->nim) }}" autocomplete="nim" autofocus>

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
                                <select id="univ_id" name="univ_id" class="form-control select" data-live-search="true"
                                    onchange="univLainnya(this);">
                                    <option value="0" disabled selected>--- Pilih ---
                                    </option>
                                    <option {{ old('univ_id') == 'other' ? 'selected' : '' }} value="other">--- Isi yang
                                        Lain
                                        ---
                                    </option>
                                    @foreach ($getAllUniv as $univ)
                                        <option
                                            {{ old('univ_id', Auth::user()->univ_id) == $univ->id ? 'selected' : '' }}
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
