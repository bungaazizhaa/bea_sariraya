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
        @foreach ($administrasiOpenned as $admUser)
            <h1 class="text-center mt-3 h2">Detail Mahasiswa & <span class="text-nowrap">Penilaian
                    Administrasi</span></h1>
            @if (isset($admUser))
                <p class="text-center text-muted mb-1">Data terakhir disimpan <span
                        class="text-nowrap text-white">{{ $admUser->updated_at->diffForHumans() }}</span>
                </p>
            @endif
            <input id="user_id" hidden type="text" class="form-control" user_id="user_id"
                value="{{ $admUser->user_id }}">

            <input id="periode_id" hidden type="text" class="form-control" periode_id="periode_id"
                value="{{ $periodeOpenned->id_periode }}">


            <div class="row d-flex justify-content-center my-5 mx-1">
                <div class="col-md-9">
                    <div class="row mb-0">
                        <div class="d-flex justify-content-center" style="width: 100%">
                            <div class="col-md-8 px-0 ml-auto">
                                <div class="float-right">
                                    {{ $administrasiOpenned->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ============== PENDAFTAR ============== --}}
                <div class="col-md-9 mb-3 px-0">
                    <div class="card">
                        <div
                            class="card-header h4 {{ isset($admUser->wawancara->jadwal_wwn) && $admUser->status_adm == 'lolos' ? 'bg-success' : '' }} {{ $admUser->status_adm == 'gagal' ? 'bg-danger' : '' }}">
                            Pendaftar

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 text-center text-md-left px-3">
                                    <div>
                                        <img src="/pictures/{{ $admUser->user->picture == '' ? 'noimg.png' : $admUser->user->picture }}"
                                            class="rounded" alt="User Image" height="200px"
                                            width="150px">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <label for="nama"
                                            class="col-md-4 col-form-label text-md-right h5"
                                            style="font-size:16px">
                                            Nama</label>

                                        <div class="col-md-8 mb-3">
                                            <input id="nama" type="text" disabled class="form-control"
                                                name="nama" value="{{ $admUser->user->name }}">
                                        </div>
                                        <label for="univ"
                                            class="col-md-4 col-form-label text-md-right h5"
                                            style="font-size:16px">
                                            Perguruan Tinggi</label>

                                        <div class="col-md-8 mb-3">
                                            <input id="univ" type="text" disabled class="form-control"
                                                name="univ"
                                                value="{{ $admUser->user->univ->nama_universitas }}">
                                        </div>
                                        <label for="prodi"
                                            class="col-md-4 col-form-label text-md-right h5"
                                            style="font-size:16px">
                                            Program Studi</label>

                                        <div class="col-md-8 mb-3">
                                            <input id="prodi" type="text" disabled
                                                class="form-control" name="prodi"
                                                value="{{ $admUser->user->prodi->nama_prodi }}">
                                        </div>
                                        <label for="prodi"
                                            class="col-md-4 col-form-label text-md-right h5"
                                            style="font-size:16px">
                                            Email</label>

                                        <div class="col-md-8">
                                            <input id="prodi" type="text" disabled
                                                class="form-control" name="prodi"
                                                value="{{ $admUser->user->email }}">
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
                            @if (isset($admUser))
                                <div class="row mb-3">
                                    <label for="no_pendaftaran"
                                        class="col-md-4 col-form-label text-md-right">{{ __('No Pendaftaran') }}</label>

                                    <div class="col-md-6">
                                        <input id="no_pendaftaran" type="text" disabled
                                            class="form-control" name="no_pendaftaran"
                                            value="{{ $admUser->no_pendaftaran }}">
                                    </div>
                                </div>
                            @endif

                            <div class="row mb-3">
                                <label for="nim"
                                    class="col-md-4 col-form-label text-md-right">{{ __('NIM') }}</label>

                                <div class="col-md-6">
                                    <input id="nim" type="text" disabled class="form-control"
                                        name="nim" value="{{ $admUser->user->nim }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="tempat_lahir"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Tempat Lahir') }}</label>

                                <div class="col-md-6">
                                    <input id="tempat_lahir" type="text" class="form-control"
                                        name="tempat_lahir" spellcheck="false" disabled
                                        value="{{ isset($admUser) ? $admUser->tempat_lahir : '' }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="tanggal_lahir"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Tanggal Lahir') }}</label>

                                <div class="col-md-6">
                                    <input id="tanggal_lahir" type="text" class="form-control"
                                        name="tanggal_lahir" spellcheck="false" disabled
                                        value="{{ $admUser->tanggal_lahir->isoFormat('D MMMM YYYY') }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="semester"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Semester') }}</label>

                                <div class="col-md-6">
                                    <input id="semester" type="text" spellcheck="false"
                                        class="form-control" name="semester" disabled
                                        value="{{ $admUser->semester }}">

                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="ipk"
                                    class="col-md-4 col-form-label text-md-right">{{ __('IPK') }}</label>

                                <div class="col-md-6">
                                    <input id="ipk" type="text" class="form-control" name="ipk"
                                        spellcheck="false" disabled value="{{ $admUser->ipk }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="keahlian"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Keahlian') }}</label>

                                <div class="col-md-6">
                                    <input id="keahlian" type="text" spellcheck="false"
                                        class="form-control" name="keahlian" disabled
                                        value="{{ $admUser->keahlian }}">

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

                    {{-- {{ route('updatenilai.adm', $admUser->user_id, $admUser->periode_id) }} --}}
                    {{-- /update-nilai-administrasi/{{ $admUser->user_id }}/{{ $admUser->periode_id }} --}}
                    <div class="card">
                        <form method="POST" action="{{ route('updatenilai.adm', $admUser->id) }}">
                            @csrf
                            <div class="card-header h4">
                                Penilaian
                            </div>
                            <div class="card-body">

                                <div class="row mb-3">
                                    <label for="name"
                                        class="col-md-4 col-form-label text-md-right">Status User di
                                        Administrasi</label>
                                    <div class="col-md-8">
                                        <select id="status_adm" name="status_adm"
                                            onchange="lolos(this);" class="form-control selectpicker"
                                            title="Status Administrasi">
                                            <option class="bg-success h4 p-3 rounded"
                                                style="height: 60px!important; text-align:center;"
                                                {{ old('status_adm', $admUser->status_adm) == 'lolos' ? 'selected' : '' }}
                                                value="lolos">Lolos Administrasi</option>
                                            <option class="bg-danger h4 p-3 rounded"
                                                style="height: 60px!important; text-align:center;"
                                                {{ old('status_adm', $admUser->status_adm) == 'gagal' ? 'selected' : '' }}
                                                value="gagal">Gagal Administrasi
                                            </option>
                                        </select>

                                        @error('status_adm')
                                            <div class="small text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div id="kolomwwn"
                                    style="display: {{ old('jadwal_wwn', $admUser->status_adm) === 'lolos' ? 'block' : 'none' }};">
                                    <div class="row mb-3">
                                        <label for="name"
                                            class="col-md-4 col-form-label text-md-right">Jadwal
                                            Wawancara</label>
                                        <div id="tombolKalender" class="col-md-8">
                                            <input autocomplete="off" id="jadwal_wwn" type="jadwal_wwn"
                                                class="datepicker"
                                                class="form-control @error('jadwal_wwn') is-invalid @enderror"
                                                name="jadwal_wwn"
                                                value="{{ old('jadwal_wwn',isset($admUser->wawancara->jadwal_wwn) ? $admUser->wawancara->jadwal_wwn->format('Y-m-d H:i') : '') }}">

                                            @error('jadwal_wwn')
                                                <div class="small text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="catatan"
                                        class="col-md-4 col-form-label text-md-right">Catatan</label>
                                    <div class="col-md-8">
                                        <textarea id="catatan" name="catatan" class="form-control selectpicker"
                                            title="Status Administrasi">{{ old('catatan', $admUser->catatan) }}</textarea>
                                    </div>

                                    @error('catatan')
                                        <div class="small text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit"
                                    class="btn btn-success text-nowrap float-right">Simpan
                                    Perubahan</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-9">
                        <div class="row mb-0">
                            <div class="d-flex justify-content-center" style="width: 100%">
                                <div class="col-md-8 px-0 mr-auto">
                                    <div class="">
                                        {{ $administrasiOpenned->links() }}
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
                document.getElementById("kolomwwn").style.display = "block";
                document.getElementById("jadwal_wwn").required = true;
                // document.getElementById("jadwal_wwn").focus();
            } else {
                document.getElementById("kolomwwn").style.display = "none";
                document.getElementById("Input_Universitas").value = null;
                document.getElementById("Input_Universitas").required = false;

            }
        }
    </script>
@endsection
