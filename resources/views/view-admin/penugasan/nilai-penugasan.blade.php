@extends('view-admin.layouts.app')
@section('titlepage')
    <title>Dashboard Beasiswa Sariraya</title>
@endsection
@section('title')
    <h4 class="m-0 p-0">Dashboard</h4>
@endsection
@section('content')
    <div class="container-fluid px-lg-4 mx-lg-4">
        <!-- Main content -->
        @foreach ($penugasanOpenned as $pngUser)
            <h1 class="text-center mt-3 h2">Detail Mahasiswa & <span class="text-nowrap">Penilaian
                    Penugasan</span></h1>
            @if (isset($pngUser))
                <p class="text-center text-muted mb-1">Data terakhir disimpan <span
                        class="text-nowrap text-white">{{ $pngUser->updated_at->diffForHumans() }}</span>
                </p>
            @endif
            <input id="user_id" hidden type="text" class="form-control" user_id="user_id"
                value="{{ $pngUser->user_id }}">

            <input id="periode_id" hidden type="text" class="form-control" periode_id="periode_id"
                value="{{ $periodeOpenned->id_periode }}">


            <div class="row d-flex justify-content-center my-5 mx-1">
                <div class="col-md-9">
                    <div class="row mb-0">
                        <div class="d-flex justify-content-center" style="width: 100%">
                            <div class="col-md-8 px-0 ml-auto">
                                <div class="float-right">
                                    {{ $penugasanOpenned->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ============== PENDAFTAR ============== --}}
                <div class="col-md-9 mb-3 px-0">
                    <div class="card">
                        <div
                            class="card-header h4 {{ $pngUser->status_png == 'lolos' ? 'bg-success' : '' }} {{ $pngUser->status_png == 'gagal' ? 'bg-danger' : '' }}">
                            Pendaftar

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 text-center text-md-left px-3">
                                    <div>
                                        <img src="/pictures/{{ $pngUser->wawancara->administrasi->user->picture == ''? 'noimg.png': $pngUser->wawancara->administrasi->user->picture }}"
                                            class="rounded" alt="User Image" height="200px" width="150px">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <label for="nama" class="col-md-4 col-form-label text-md-right h5"
                                            style="font-size:16px">
                                            Nama</label>

                                        <div class="col-md-8 mb-3">
                                            <input id="nama" type="text" disabled class="form-control" name="nama"
                                                value="{{ $pngUser->wawancara->administrasi->user->name }}">
                                        </div>
                                        <label for="univ" class="col-md-4 col-form-label text-md-right h5"
                                            style="font-size:16px">
                                            Perguruan Tinggi</label>

                                        <div class="col-md-8 mb-3">
                                            <input id="univ" type="text" disabled class="form-control" name="univ"
                                                value="{{ $pngUser->wawancara->administrasi->user->univ->nama_universitas }}">
                                        </div>
                                        <label for="prodi" class="col-md-4 col-form-label text-md-right h5"
                                            style="font-size:16px">
                                            Program Studi</label>

                                        <div class="col-md-8 mb-3">
                                            <input id="prodi" type="text" disabled class="form-control" name="prodi"
                                                value="{{ $pngUser->wawancara->administrasi->user->prodi->nama_prodi }}">
                                        </div>
                                        <label for="prodi" class="col-md-4 col-form-label text-md-right h5"
                                            style="font-size:16px">
                                            Email</label>

                                        <div class="col-md-8">
                                            <input id="prodi" type="text" disabled class="form-control" name="prodi"
                                                value="{{ $pngUser->wawancara->administrasi->user->email }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ============== DATA DIRI ============== --}}
                <div class="col-md-9 mb-3 px-0">
                    <div class="card">
                        <div class="card-header h4">
                            Data Diri
                        </div>
                        <div class="card-body">
                            @if (isset($pngUser))
                                <div class="row mb-3">
                                    <label for="no_pendaftaran"
                                        class="col-md-4 col-form-label text-md-right">{{ __('No Pendaftaran') }}</label>

                                    <div class="col-md-6">
                                        <input id="no_pendaftaran" type="text" disabled class="form-control"
                                            name="no_pendaftaran"
                                            value="{{ $pngUser->wawancara->administrasi->no_pendaftaran }}">
                                    </div>
                                </div>
                            @endif

                            <div class="row mb-3">
                                <label for="nim" class="col-md-4 col-form-label text-md-right">{{ __('NIM') }}</label>

                                <div class="col-md-6">
                                    <input id="nim" type="text" disabled class="form-control" name="nim"
                                        value="{{ $pngUser->wawancara->administrasi->user->nim }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="tempat_lahir"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Tempat Lahir') }}</label>

                                <div class="col-md-6">
                                    <input id="tempat_lahir" type="text" class="form-control" name="tempat_lahir"
                                        spellcheck="false" disabled
                                        value="{{ isset($pngUser) ? $pngUser->wawancara->administrasi->tempat_lahir : '' }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="tanggal_lahir"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Tanggal Lahir') }}</label>

                                <div class="col-md-6">
                                    <input id="tanggal_lahir" type="text" class="form-control" name="tanggal_lahir"
                                        spellcheck="false" disabled
                                        value="{{ $pngUser->wawancara->administrasi->tanggal_lahir->isoFormat('D MMMM YYYY') }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="semester"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Semester') }}</label>

                                <div class="col-md-6">
                                    <input id="semester" type="text" spellcheck="false" class="form-control"
                                        name="semester" disabled
                                        value="{{ $pngUser->wawancara->administrasi->semester }}">

                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="ipk" class="col-md-4 col-form-label text-md-right">{{ __('IPK') }}</label>

                                <div class="col-md-6">
                                    <input id="ipk" type="text" class="form-control" name="ipk" spellcheck="false"
                                        disabled value="{{ $pngUser->wawancara->administrasi->ipk }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="keahlian"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Keahlian') }}</label>

                                <div class="col-md-6">
                                    <input id="keahlian" type="text" spellcheck="false" class="form-control"
                                        name="keahlian" disabled
                                        value="{{ $pngUser->wawancara->administrasi->keahlian }}">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ============== UPLOAD BERKAS ============== --}}
                <div class="col-md-9 mb-3 px-0">
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
                <div class="col-md-9 mb-3 px-0">
                    <div class="card">
                        <div class="card-header h4">
                            Kontak
                        </div>
                        <div class="card-body">

                            {{--  --}}

                        </div>
                    </div>
                </div>

                {{-- ============== PENILAIAN ============== --}}
                <div class="col-md-9 mb-3 px-0">

                    {{-- {{ route('updatenilai.adm', $pngUser->user_id, $pngUser->periode_id) }} --}}
                    {{-- /update-nilai-administrasi/{{ $pngUser->user_id }}/{{ $pngUser->periode_id }} --}}
                    <div class="card">
                        <form method="POST" action="{{ route('updatenilai.png', $pngUser->id) }}">
                            @csrf
                            <div class="card-header h4">
                                Penilaian
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">Jadwal
                                        Wawancara :</label>
                                    <div id="tombolKalender" class="col-md-8">
                                        <p class="my-2">
                                            {{ isset($pngUser->wawancara->jadwal_wwn)? $pngUser->wawancara->jadwal_wwn->format('D, d F Y H:i') . ' WIB': '' }}
                                        </p>
                                        <span>
                                            <div class="p">(
                                                {{ $pngUser->wawancara->jadwal_wwn->diffForHumans() }} )</div>
                                        </span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-4 col-form-label text-md-right">Catatan
                                        Administrasi :</label>
                                    <div class="col-md-8">
                                        <p class="my-2">{{ $pngUser->wawancara->administrasi->catatan }}</p>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="catatan wawancara" class="col-md-4 col-form-label text-md-right">Catatan
                                        Wawancara :</label>
                                    <div class="col-md-8">
                                        <p class="my-2">{{ $pngUser->wawancara->catatan }}</p>
                                    </div>

                                    @error('catatan')
                                        <div class="small text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">Soal
                                        Penugasan</label>
                                    <div class="col-md-8">
                                        <input disabled class="form-control @error('soal') is-invalid @enderror" name="soal"
                                            value="{{ isset($pngUser->soal) ? $pngUser->soal : '' }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="field_jawaban" class="col-md-4 col-form-label text-md-right">Jawaban
                                        Penugasan</label>
                                    <div class="col-md-8">
                                        <input disabled class="form-control @error('field_jawaban') is-invalid @enderror"
                                            value="{{ isset($pngUser->field_jawaban) ? $pngUser->field_jawaban : '-' }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">File
                                        Jawaban</label>
                                    <div class="col-md-8">
                                        <a class="btn btn-outline-primary" target="_blank" rel="noopener noreferrer"
                                            href={{ asset($periodeOpenned->name . '/' . $pngUser->wawancara->administrasi->user->id . '/' . $pngUser->file_jawaban) }}>Lihat
                                            File Jawaban</a>

                                        @error('soal')
                                            <div class="small text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="status_png" class="col-md-4 col-form-label text-md-right">Status
                                        Akhir</label>
                                    <div class="col-md-8">
                                        <select id="status_png" name="status_png" onchange="lolos(this);"
                                            class="form-control selectpicker" title="Status Akhir">
                                            <option class="bg-success h4 p-3"
                                                style="height: 60px!important; text-align:center;"
                                                {{ old('status_png', $pngUser->status_png) == 'lolos' ? 'selected' : '' }}
                                                value="lolos">Lolos Beasiswa</option>
                                            <option class="bg-danger h4 p-3"
                                                style="height: 60px!important; text-align:center;"
                                                {{ old('status_png', $pngUser->status_png) == 'gagal' ? 'selected' : '' }}
                                                value="gagal">Gagal Beasiswa
                                            </option>
                                        </select>

                                        @error('status_png')
                                            <div class="small text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="catatan penugasan" class="col-md-4 col-form-label text-md-right">Catatan
                                        Penugasan</label>
                                    <div class="col-md-8">
                                        <textarea spellcheck="false" id="catatan" name="catatan" class="form-control"
                                            title="Status Administrasi">{{ old('catatan', $pngUser->catatan) }}</textarea>
                                    </div>

                                    @error('catatan')
                                        <div class="small text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success text-nowrap float-right">Simpan
                                    Perubahan</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-9">
                        <div class="row mb-0">
                            <div class="d-flex justify-content-center" style="width: 100%">
                                <div class="col-md-8 px-0 mr-auto">
                                    <div class="">
                                        {{ $penugasanOpenned->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        @endforeach
    </div>

    <script>
        var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
        $('.datepicker').datetimepicker({
            format: 'yyyy-mm-dd HH:MM',
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome',
            modal: true,
            footer: true,
            autoclose: false,
            minDate: today,
        });
    </script>

    <script>
        function lolos(that) {
            if (that.value == "lolos") {
                document.getElementById("kolomsoal").style.display = "block";
                // document.getElementById("jadwal_wwn").focus();
            } else {
                document.getElementById("kolomsoal").style.display = "none";
                document.getElementById("soal").value = null;
                document.getElementById("soal").required = false;

            }
        }
    </script>
@endsection
