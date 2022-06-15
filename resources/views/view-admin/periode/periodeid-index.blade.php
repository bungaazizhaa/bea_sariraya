@extends('view-admin.layouts.app')
@section('titlepage')
    <title>Periode {{ ucfirst($periodeOpenned->name) }} Beasiswa Sariraya</title>
@endsection
@section('title')
    <h4 class="m-0 p-0">Periode {{ ucfirst($periodeOpenned->name) }}</h4>
@endsection
@section('content')
    <!-- Main content -->
    <div class="container px-4">
        <div class="row">
            <div class="col mb-3">
                <div
                    class="{{ $periodeOpenned->status == 'aktif' ? 'bg-success' : 'bg-secondary' }} rounded myshadow d-flex h-100">
                    <p class="m-3 h5">
                        Status
                        : {{ ucfirst($periodeOpenned->status) }}
                    </p>
                </div>
            </div>
            <div class="ml-2 mb-3 mr-2">
                <button type="button" data-toggle="modal" data-target="#editPeriode"
                    class="rounded myshadow d-flex justify-content-center align-items-center btn-warning my-0 p-3"><i
                        class="fa-solid fa-gear"></i>&nbsp; Pengaturan
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div
                    class="{{ $periodeOpenned->status_adm == 'Selesai' ? 'bg-selesai' : 'bg-secondary' }} p-3 rounded myshadow mb-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="h4 mb-0 font-weight-bold">
                                Tahap Administrasi
                            </p>
                            <p class="mb-0">
                                ({{ isset($periodeOpenned->status_adm) ? 'Selesai' : 'Belum Selesai' }})
                        </div>
                        <div class="mt-2">
                            @if ($periodeOpenned->status_adm == 'Selesai')
                                <span class="btn" style="width: 64px">
                                    <i class="fa-regular text-primary fa-circle-check fa-2xl"></i>
                                </span>
                            @else
                                <span class="btn" style="width: 64px">
                                    <i class="fa-regular text-warning fa-clock fa-2xl"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                    </p>
                    <hr style="border-color:#ffffff88">
                    <p class="mb-1">Tanggal Mulai :</p>
                    <p><strong>{{ $periodeOpenned->tm_adm->translatedFormat('d F Y') }}</strong></p>
                    <p class="mb-1 mt-2">Tanggal Akhir :</p>
                    <p><strong>{{ $periodeOpenned->ta_adm->translatedFormat('d F Y') }}</strong></p>
                    <p class="mb-1 mt-2">Tanggal Pengumuman :</p>
                    <p class="mb-0">
                        <strong>{{ $periodeOpenned->tp_adm->translatedFormat('d F Y') }}</strong>
                    </p>
                    <hr style="border-color:#ffffff88">
                    <div id="footer-tahap" class="d-flex" style="height:38px">
                        @if ($getTanggalSekarang > $periodeOpenned->ta_adm->format('Y-m-d'))
                            <a href="/{{ $periodeOpenned->name }}/nilai-administrasi"
                                class="btn btn-outline-light text-truncate"><i class="fa-solid fa-list-check"></i>&nbsp;
                                Nilai
                                Administrasi</a>
                        @endif
                        @if ($getTanggalSekarang >= $periodeOpenned->tp_adm->format('Y-m-d'))
                            <button class="btn btn-outline-light ml-auto" data-toggle="modal" data-target="#umumkanAdm"><i
                                    class="fa-solid fa-check"></i>&nbsp; Umumkan</button>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div
                    class="{{ $periodeOpenned->status_wwn == 'Selesai' ? 'bg-selesai' : 'bg-secondary' }} p-3 rounded myshadow mb-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="h4 mb-0 font-weight-bold">
                                Tahap Wawancara
                            </p>
                            <p class="mb-0">
                                ({{ isset($periodeOpenned->status_wwn) ? 'Selesai' : 'Belum Selesai' }})
                        </div>
                        <div class="mt-2">
                            @if ($periodeOpenned->status_wwn == 'Selesai')
                                <span class="btn" style="width: 64px">
                                    <i class="fa-regular text-primary fa-circle-check fa-2xl"></i>
                                </span>
                            @else
                                <span class="btn" style="width: 64px">
                                    <i class="fa-regular text-warning fa-clock fa-2xl"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                    </p>
                    <hr style="border-color:#ffffff88">
                    <p class="mb-1">Tanggal Mulai :</p>
                    <p><strong>{{ $periodeOpenned->tm_wwn->translatedFormat('d F Y') }}</strong></p>
                    <p class="mb-1 mt-2">Tanggal Akhir :</p>
                    <p><strong>{{ $periodeOpenned->ta_wwn->translatedFormat('d F Y') }}</strong></p>
                    <p class="mb-1 mt-2">Tanggal Pengumuman :</p>
                    <p class="mb-0">
                        <strong>{{ $periodeOpenned->tp_wwn->translatedFormat('d F Y') }}</strong>
                    </p>
                    <hr style="border-color:#ffffff88">
                    <div id="footer-tahap" class="d-flex" style="height:38px">
                        @if ($getTanggalSekarang >= $periodeOpenned->tm_wwn->format('Y-m-d'))
                            <a href="/{{ $periodeOpenned->name }}/nilai-wawancara"
                                class="btn btn-outline-light text-truncate"><i class="fa-solid fa-list-check"></i>&nbsp;
                                Nilai Wawancara</a>
                        @endif
                        @if ($getTanggalSekarang >= $periodeOpenned->tp_wwn->format('Y-m-d'))
                            <button class="btn btn-outline-light ml-auto" data-toggle="modal" data-target="#umumkanWwn"><i
                                    class="fa-solid fa-check"></i>&nbsp; Umumkan</button>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div
                    class="{{ $periodeOpenned->status_png == 'Selesai' ? 'bg-selesai' : 'bg-secondary' }} p-3 rounded myshadow mb-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="h4 mb-0 font-weight-bold">
                                Tahap Penugasan
                            </p>
                            <p class="mb-0">
                                ({{ isset($periodeOpenned->status_png) ? 'Selesai' : 'Belum Selesai' }})
                        </div>
                        <div class="mt-2">
                            @if ($periodeOpenned->status_png == 'Selesai')
                                <span class="btn" style="width: 64px">
                                    <i class="fa-regular text-primary fa-circle-check fa-2xl"></i>
                                </span>
                            @else
                                <span class="btn" style="width: 64px">
                                    <i class="fa-regular text-warning fa-clock fa-2xl"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                    </p>
                    <hr style="border-color:#ffffff88">
                    <p class="mb-1">Tanggal Mulai :</p>
                    <p><strong>{{ $periodeOpenned->tm_png->translatedFormat('d F Y') }}</strong></p>
                    <p class="mb-1 mt-2">Tanggal Akhir :</p>
                    <p><strong>{{ $periodeOpenned->ta_png->translatedFormat('d F Y') }}</strong></p>
                    <p class="mb-1 mt-2">Tanggal Pengumuman :</p>
                    <p class="mb-0">
                        <strong>{{ $periodeOpenned->tp_png->translatedFormat('d F Y') }}</strong>
                    </p>
                    <hr style="border-color:#ffffff88">
                    <div id="footer-tahap" class="d-flex" style="height:38px">
                        @if ($getTanggalSekarang > $periodeOpenned->ta_png)
                            <a href="/{{ $periodeOpenned->name }}/nilai-penugasan"
                                class="btn btn-outline-light text-truncate"><i class="fa-solid fa-list-check"></i>&nbsp;
                                Nilai
                                Penugasan</a>
                        @endif
                        @if ($getTanggalSekarang >= $periodeOpenned->tp_png->format('Y-m-d'))
                            <button class="btn btn-outline-light ml-auto" data-toggle="modal" data-target="#umumkanPng"><i
                                    class="fa-solid fa-check"></i>&nbsp; Umumkan</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Input Group WA --}}
        <div class="row">
            <div class="col-12 mb-3">
                <form id="groupwaForm" method="POST"
                    action="{{ route('groupwaupdate.periode', $periodeOpenned->name) }}">
                    @csrf
                    <div
                        class="rounded myshadow {{ isset($periodeOpenned->group_wa) ? 'bg-selesai' : 'bg-secondary' }} h-100">
                        <div class="row p-3 p-md-2">
                            <div class="col">
                                <p class="h5 pl-md-2 pt-1">Grup WhatsApp :</p>
                            </div>
                            <div class="col-md-8">
                                <input autocomplete="off" type="text" id="group_wa" name="group_wa" spellcheck="false"
                                    class="form-control my-2 my-md-0" placeholder="Pastikan dimulai dari 'https://...'"
                                    value="{{ $periodeOpenned->group_wa }}">
                                <small>Isi berupa Link atau tautan dari Grup WhatsApp yang nantinya akan ditampilkan pada
                                    halaman
                                    Pengumuman Akhir di Akun Peserta Beasiswa.</small>
                            </div>

                            <div class="col-md-2">
                                <button type="submit" class="rounded myshadow btn float-right btn-dark"><i
                                        class="fa-solid fa-floppy-disk"> </i> Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        {{-- Input Teknis Wwn --}}
        <div class="row">
            <div class="col-12 mb-3">
                <form id="tekniswwnForm" method="POST"
                    action="{{ route('tekniswwnupdate.periode', $periodeOpenned->name) }}">
                    @csrf
                    <div
                        class="rounded myshadow {{ isset($periodeOpenned->teknis_wwn) ? 'bg-selesai' : 'bg-secondary' }} h-100">
                        <div class="row p-3 p-md-2">
                            <div class="col">
                                <p class="h5 pl-md-2 pt-1">Teknis Wawancara :</p>
                            </div>
                            <div class="col-md-8">
                                <style>
                                    .note-editable {
                                        color: #0C5B80 !important;
                                        background-color: #D1ECF1 !important;
                                        margin: 1.25rem !important;
                                        border-radius: 0.25rem !important;
                                        border: 1px solid #BEE5EB !important;
                                        font-family: Montserrat !important;
                                        padding-bottom: 0 !important;
                                    }
                                </style>
                                <textarea autocomplete="off" id="summernote" name="teknis_wwn" spellcheck="false" class="my-2 my-md-0 mb-0"
                                    style="margin-bottom: 0!important;">{!! $periodeOpenned->teknis_wwn !!}</textarea>
                                <small>Isi berupa Tata cara melakukan wawancara yang nantinya akan
                                    ditampilkan pada halaman
                                    Pengumuman Lolos Wawancara di Akun Peserta Beasiswa.</small>
                            </div>

                            <div class="col-md-2">
                                <button type="submit" class="rounded myshadow btn float-right btn-dark"><i
                                        class="fa-solid fa-floppy-disk"> </i> Simpan
                                </button>
                                <a href="/preview-tekniswwn" target="_blank"
                                    class="rounded myshadow btn float-right btn-outline-primary mr-3 mr-md-0 mt-0 mt-md-3"><i
                                        class="fa-solid fa-eye"></i> Preview
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <script>
            $(document).ready(function() {
                $('#summernote').summernote({
                    placeholder: '<p style="text-align: center; padding: 1.25rem;"><b>Teknis Wawancara...</b></p>',
                    tabsize: 2,
                    minHeight: 100,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link']],
                        ['view', ['fullscreen', 'codeview', 'help']]
                    ],
                    spellCheck: false,
                    disableGrammar: false,
                    // airMode: true,

                });
            });
        </script>

        <div class="row">
            <div class="col-12">
                <div class="card rounded">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-12">
                                <h3 class="card-title mt-2">Pendaftar {{ ucfirst($periodeOpenned->name) }}</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tableperiodeuser" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    {{-- <th>Foto</th> --}}
                                    <th>Nama</th>
                                    <th>Nomor</th>
                                    <th>Email</th>
                                    <th>Status Adm</th>
                                    {{-- <th>Update Adm</th> --}}
                                    <th>Status Wwn</th>
                                    {{-- <th>Update Wwn</th> --}}
                                    <th>Status Png</th>
                                    {{-- <th>Update Png</th> --}}
                                    <th>Keahlian</th>
                                    <th>Jadwal Wawancara</th>
                                    <th>Perguruan Tinggi</th>
                                    <th>Program Studi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @if ($getAdministrasiUser->count())
                                    @foreach ($getAdministrasiUser as $userAdm)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            {{-- <td><img src="/pictures/{{ $userAdm->user->picture == '' ? 'noimg.png' : $userAdm->user->picture }}"
                                                    class="rounded" alt="User Image" height="120px" width="90px">
                                            </td> --}}
                                            <td><a class="text-light"
                                                    href="{{ route('pengguna.show', $userAdm->id) }}">{{ $userAdm->name }}</a>
                                            </td>
                                            <td>{{ $userAdm->no_pendaftaran }}</td>
                                            <td>{{ $userAdm->email }}</td>
                                            <td>
                                                <form target="_blank" id="editFormNilaiAdm{{ $userAdm->no_pendaftaran }}"
                                                    action="{{ route('nilai.adm', $periodeOpenned->name) }}">
                                                    <input type="text" hidden aria-label="Recipient's username"
                                                        name="search" value="{{ $userAdm->no_pendaftaran }}" autofocus>
                                                    <div style="cursor: pointer;"
                                                        onclick="document.getElementById('editFormNilaiAdm{{ $userAdm->no_pendaftaran }}').submit();"
                                                        class="badge py-2 px-3 rounded-pill
                                                        {{ isset($userAdm->status_adm) && isset($userAdm->jadwal_wwn) && $userAdm->status_adm == 'lolos' ? 'badge-success' : '' }}
                                                        {{ isset($userAdm->status_adm) && $userAdm->status_adm == 'gagal' ? 'badge-danger' : '' }}
                                                        {{ !isset($userAdm->status_adm) || !isset($userAdm->jadwal_wwn) ? 'badge-secondary' : '' }}">
                                                        {{ isset($userAdm->status_adm) ? ucfirst($userAdm->status_adm) . '_Adm' : 'Unset' }}
                                                    </div>
                                                </form>
                                                {{-- <td>{{ $userAdm->updated_at->translatedFormat('d F Y H:i') }}</td> --}}
                                            <td>
                                                <form target="_blank" id="editFormNilaiWwn{{ $userAdm->no_pendaftaran }}"
                                                    action="{{ route('nilai.wwn', $periodeOpenned->name) }}">
                                                    <input type="text" hidden aria-label="Recipient's username"
                                                        name="search" value="{{ $userAdm->no_pendaftaran }}" autofocus>
                                                    <div style="cursor: pointer;"
                                                        onclick="document.getElementById('editFormNilaiWwn{{ $userAdm->no_pendaftaran }}').submit();"
                                                        class="badge py-2 px-3 rounded-pill
                                                    {{ isset($userAdm->status_wwn) && isset($userAdm->soal) && $userAdm->status_wwn == 'lolos' ? 'badge-success' : '' }}
                                                    {{ isset($userAdm->status_wwn) && $userAdm->status_wwn == 'gagal' ? 'badge-danger' : '' }}
                                                    {{ !isset($userAdm->status_wwn) || !isset($userAdm->soal) ? 'badge-secondary' : '' }}">
                                                        {{ isset($userAdm->status_wwn) ? ucfirst($userAdm->status_wwn) . '_Wwn' : 'Unset' }}
                                                    </div>
                                                </form>
                                            </td>
                                            <td>
                                                <form target="_blank" id="editFormNilaiPng{{ $userAdm->no_pendaftaran }}"
                                                    action="{{ route('nilai.png', $periodeOpenned->name) }}">
                                                    <input type="text" hidden aria-label="Recipient's username"
                                                        name="search" value="{{ $userAdm->no_pendaftaran }}" autofocus>
                                                    <div style="cursor: pointer;"
                                                        onclick="document.getElementById('editFormNilaiPng{{ $userAdm->no_pendaftaran }}').submit();"
                                                        class="badge py-2 px-3 rounded-pill
                                                    {{ isset($userAdm->status_png) && $userAdm->status_png == 'lolos' ? 'badge-success' : '' }}
                                                    {{ isset($userAdm->status_png) && $userAdm->status_png == 'gagal' ? 'badge-danger' : '' }}
                                                    {{ !isset($userAdm->status_png) ? 'badge-secondary' : '' }}">
                                                        {{ isset($userAdm->status_png) ? ucfirst($userAdm->status_png) . '_Png' : 'Unset' }}
                                                    </div>
                                                </form>
                                            </td>
                                            <td>{{ isset($userAdm->keahlian) ? $userAdm->keahlian : '-' }}</td>
                                            <td>{{ isset($userAdm->jadwal_wwn) ? $userAdm->jadwal_wwn->translatedFormat('d M Y - H:i') . ' WIB' : '-' }}
                                            </td>
                                            <td>{{ $userAdm->nama_universitas }}</td>
                                            <td>{{ $userAdm->nama_prodi }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->


        {{-- ======== MODAL EDIT PERIODE ======== --}}
        <!-- Modal -->
        <div class="modal fade" id="editPeriode" tabindex="-1" role="dialog" aria-labelledby="editPeriodeLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form id="periodeForm" method="POST" action="{{ route('update.periode', $periodeOpenned->name) }}">
                        @csrf
                        <div class="modal-header h4 text-center">
                            <p class="mb-0 w-100">Form Edit Periode</p>
                        </div>
                        <div class="modal-body pb-0">
                            <div class="row">
                                <div class="col-12">
                                    <div class="bg-secondary py-md-1 pb-3 px-3 rounded myshadow mb-3">
                                        <div class="row">
                                            <label for="id_periode" class="col col-form-label text-md-right">ID
                                                Periode
                                                :</label>
                                            <div class="col-12 col-md-10 mb-1">
                                                <input autocomplete="off" spellcheck="false" id="id_periode"
                                                    name="id_periode"
                                                    value="{{ old('id_periode', $periodeOpenned->id_periode) }}"
                                                    class="form-control">
                                                @error('id_periode')
                                                    <span class="small text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="name" class="col col-form-label text-md-right">Nama Periode
                                                :</label>
                                            <div class="col-12 col-md-10">
                                                <input autocomplete="off" spellcheck="false" id="name" name="name"
                                                    value="{{ old('name', $periodeOpenned->name) }}"
                                                    class="form-control">
                                                @error('name')
                                                    <span class="small text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="bg-secondary py-md-1 pb-3 px-3 rounded mb-3">
                                        <div class="row">
                                            <label for="status" class="col col-form-label">Status
                                                :</label>
                                            <div class="col-12 col-md-10">
                                                <select id="status" name="status" class="form-control selectpicker"
                                                    style="background-color: #eeeeee!important; color:black!important;"
                                                    title="Status Periode" required>
                                                    <option
                                                        {{ old('status', $periodeOpenned->status) == 'aktif' ? 'selected' : '' }}
                                                        value="aktif">Aktif</option>
                                                    <option
                                                        {{ old('status', $periodeOpenned->status) == 'nonaktif' ? 'selected' : '' }}
                                                        value="nonaktif">Nonaktif
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="bg-secondary p-3 rounded mb-3">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <p class="h5 mb-0 font-weight-bold">
                                                    Tahap Administrasi
                                                </p>
                                            </div>
                                        </div>
                                        </p>
                                        <hr style="border-color:#ffffff88">
                                        <p class="mb-1">Tanggal Mulai :</p>
                                        <input autocomplete="off" spellcheck="false" id="tm_adm" type="tm_adm"
                                            class="datepicker"
                                            class="form-control @error('tm_adm') is-invalid @enderror" name="tm_adm"
                                            value="{{ old('tm_adm', $periodeOpenned->tm_adm->format('d F Y')) }}"
                                            required autofocus>

                                        @error('tm_adm')
                                            <div class="small text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                        <p class="mb-1 mt-2">Tanggal Akhir :</p>
                                        <input autocomplete="off" spellcheck="false" id="ta_adm" type="ta_adm"
                                            class="datepicker"
                                            class="form-control @error('ta_adm') is-invalid @enderror" name="ta_adm"
                                            value="{{ old('ta_adm', $periodeOpenned->ta_adm->format('d F Y')) }}"
                                            required autofocus>

                                        @error('ta_adm')
                                            <div class="small text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                        <p class="mb-1 mt-2">Tanggal Pengumuman :</p>
                                        <input autocomplete="off" spellcheck="false" id="tp_adm" type="tp_adm"
                                            class="datepicker"
                                            class="form-control @error('tp_adm') is-invalid @enderror" name="tp_adm"
                                            value="{{ old('tp_adm', $periodeOpenned->tp_adm->format('d F Y')) }}"
                                            required autofocus>

                                        @error('tp_adm')
                                            <div class="small text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                        <p class="mb-1 mt-2">Status Administrasi :</p>
                                        <select id="status_adm" name="status_adm" class="form-control selectpicker"
                                            title="Status Administrasi" required>
                                            <option
                                                {{ old('status_adm', $periodeOpenned->status_adm) == 'Selesai' ? 'selected' : '' }}
                                                value="Selesai">Selesai</option>
                                            <option
                                                {{ old('status_adm', $periodeOpenned->status_adm) == null ? 'selected' : '' }}
                                                value="">Belum Selesai
                                            </option>
                                        </select>
                                        @error('status_adm')
                                            <div class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="bg-secondary p-3 rounded mb-3">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <p class="h5 mb-0 font-weight-bold">
                                                    Tahap Wawancara
                                                </p>
                                            </div>
                                        </div>
                                        </p>
                                        <hr style="border-color:#ffffff88">
                                        <p class="mb-1">Tanggal Mulai :</p>
                                        <input autocomplete="off" spellcheck="false" id="tm_wwn" type="tm_wwn"
                                            class="datepicker"
                                            class="form-control @error('tm_wwn') is-invalid @enderror" name="tm_wwn"
                                            value="{{ old('tm_wwn', $periodeOpenned->tm_wwn->format('d F Y')) }}"
                                            required autofocus>

                                        @error('tm_wwn')
                                            <div class="small text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                        <p class="mb-1 mt-2">Tanggal Akhir :</p>
                                        <input autocomplete="off" spellcheck="false" id="ta_wwn" type="ta_wwn"
                                            class="datepicker"
                                            class="form-control @error('ta_wwn') is-invalid @enderror" name="ta_wwn"
                                            value="{{ old('ta_wwn', $periodeOpenned->ta_wwn->format('d F Y')) }}"
                                            required autofocus>

                                        @error('ta_wwn')
                                            <div class="small text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                        <p class="mb-1 mt-2">Tanggal Pengumuman :</p>
                                        <input autocomplete="off" spellcheck="false" id="tp_wwn" type="tp_wwn"
                                            class="datepicker"
                                            class="form-control @error('tp_wwn') is-invalid @enderror" name="tp_wwn"
                                            value="{{ old('tp_wwn', $periodeOpenned->tp_wwn->format('d F Y')) }}"
                                            required autofocus>

                                        @error('tp_wwn')
                                            <div class="small text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                        <p class="mb-1 mt-2">Status Wawancara :</p>
                                        <select id="status_wwn" name="status_wwn" class="form-control selectpicker"
                                            title="Status Wawancara" required>
                                            <option
                                                {{ old('status_wwn', $periodeOpenned->status_wwn) == 'Selesai' ? 'selected' : '' }}
                                                value="Selesai">Selesai</option>
                                            <option
                                                {{ old('status_wwn', $periodeOpenned->status_wwn) == null ? 'selected' : '' }}
                                                value="">Belum Selesai
                                            </option>
                                        </select>
                                        @error('status_wwn')
                                            <div class="small text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="bg-secondary p-3 rounded mb-3">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <p class="h5 mb-0 font-weight-bold">
                                                    Tahap Penugasan
                                                </p>
                                            </div>
                                        </div>
                                        </p>
                                        <hr style="border-color:#ffffff88">
                                        <p class="mb-1">Tanggal Mulai :</p>
                                        <input autocomplete="off" spellcheck="false" id="tm_png" type="tm_png"
                                            class="datepicker"
                                            class="form-control @error('tm_png') is-invalid @enderror" name="tm_png"
                                            value="{{ old('tm_png', $periodeOpenned->tm_png->format('d F Y')) }}"
                                            required autofocus>

                                        @error('tm_png')
                                            <div class="small text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                        <p class="mb-1 mt-2">Tanggal Akhir :</p>
                                        <input autocomplete="off" spellcheck="false" id="ta_png" type="ta_png"
                                            class="datepicker"
                                            class="form-control @error('ta_png') is-invalid @enderror" name="ta_png"
                                            value="{{ old('ta_png', $periodeOpenned->ta_png->format('d F Y')) }}"
                                            required autofocus>

                                        @error('ta_png')
                                            <div class="small text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                        <p class="mb-1 mt-2">Tanggal Pengumuman :</p>
                                        <input autocomplete="off" spellcheck="false" id="tp_png" type="tp_png"
                                            class="datepicker"
                                            class="form-control @error('tp_png') is-invalid @enderror" name="tp_png"
                                            value="{{ old('tp_png', $periodeOpenned->tp_png->format('d F Y')) }}"
                                            required autofocus>

                                        @error('tp_png')
                                            <div class="small text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                        <p class="mb-1 mt-2">Status Penugasan :</p>
                                        <select id="status_png" name="status_png" class="form-control selectpicker"
                                            title="Status Penugasan" required>
                                            <option
                                                {{ old('status_png', $periodeOpenned->status_png) == 'Selesai' ? 'selected' : '' }}
                                                value="Selesai">Selesai</option>
                                            <option
                                                {{ old('status_png', $periodeOpenned->status_png) == null ? 'selected' : '' }}
                                                value="">Belum Selesai
                                            </option>
                                        </select>
                                        @error('status_png')
                                            <div class="small text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        {{-- ======== MODAL UMUMKAN ADMINISTRASI ======== --}}
        <!-- Modal -->
        <div class="modal fade" id="umumkanAdm" tabindex="-1" role="dialog" aria-labelledby="umumkanAdmLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form id="pengumumanAdmForm" method="POST"
                        action="{{ route('umumkan.adm', $periodeOpenned->name) }}">
                        @csrf
                        <div class="modal-header h4 text-center">
                            <div class="modal-title w-100">Umumkan Tahap Administrasi</div>
                        </div>
                        <div class="modal-body pb-0">
                            <div class="row">
                                <div class="col-12">
                                    <div class="bg-dark py-md-1 pb-3 px-3 mb-3">
                                        <p class="p-3 h5 bg-success mt-3">Daftar Mahasiswa yang
                                            Menerima Pengumuman
                                            Lolos :
                                        </p>
                                        {{-- <hr style="border-color:#ffffff"> --}}
                                        <table class="table table-responsive table-borderless text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Nama</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Jadwal Wawancara</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($getAllAdmLolos != null || $getAllAdmGagal != null)
                                                    <?php $i = 1; ?>
                                                    @foreach ($getAllAdmLolos as $userAdmLolos)
                                                        <tr>
                                                            <th scope="row">{{ $i++ }}</th>
                                                            <td style="cursor: pointer;"
                                                                onclick="document.getElementById('editFormNilaiAdm{{ $userAdmLolos->no_pendaftaran }}').submit();">
                                                                {{ $userAdmLolos->name }}</td>
                                                            <td>{{ $userAdmLolos->email }}</td>
                                                            <td>{{ isset($userAdmLolos->jadwal_wwn) ? $userAdmLolos->jadwal_wwn->translatedFormat('d F Y - H:i') : '' }}
                                                                WIB
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <div>
                                                        Peserta Lolos / Gagal Belum Ada.
                                                    </div>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="bg-dark py-md-1 pb-3 px-3 mb-3">
                                        <p class="p-3 h5 bg-danger mt-3">Daftar Mahasiswa yang Menerima
                                            Pengumuman
                                            Gagal :
                                        </p>
                                        {{-- <hr style="border-color:#ffffff"> --}}
                                        <table class="table table-responsive table-borderless text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Nama</th>
                                                    <th scope="col">Email</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                @foreach ($getAllAdmGagal as $userAdmGagal)
                                                    <tr>
                                                        <th scope="row">{{ $i++ }}</th>
                                                        <td>{{ $userAdmGagal->name }}</td>
                                                        <td>{{ $userAdmGagal->email }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                {{--  --}}
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
                            @if (isset($periodeOpenned->status_adm))
                                Telah Diumumkan pada
                                {{ isset($periodeOpenned->ts_adm) ? $periodeOpenned->ts_adm->translatedFormat('d F Y - H:i') : '' }}.
                            @else
                                <div class="text-right">
                                    <p class="m-0 p-0 small">Tandai Tahap Administrasi Telah Selesai.</p>
                                    <p class="m-0 p-0 small">& Kirim Pengumuman.</p>
                                </div>
                                <button type="submit" class="btn btn-primary">Selesai & Kirim</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- ======== MODAL UMUMKAN WAWANCARA ======== --}}
        <!-- Modal -->
        <div class="modal fade" id="umumkanWwn" tabindex="-1" role="dialog" aria-labelledby="umumkanWwnLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form id="pengumumanWwnForm" method="POST"
                        action="{{ route('umumkan.wwn', $periodeOpenned->name) }}">
                        @csrf
                        <div class="modal-body pb-0">
                            <div class="row">
                                <div class="col-12">
                                    <div class="bg-dark py-md-1 pb-3 px-3 mb-3">
                                        <p class="p-3 h5 bg-success mt-3">Daftar Mahasiswa yang
                                            Menerima Pengumuman
                                            Lolos :
                                        </p>
                                        {{-- <hr style="border-color:#ffffff"> --}}
                                        <table class="table table-responsive table-borderless text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Nama</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Soal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                @if ($getAllWwnLolos != null || $getAllWwnGagal != null)
                                                    @foreach ($getAllWwnLolos as $userWwnLolos)
                                                        <tr>
                                                            <th scope="row">{{ $i++ }}</th>
                                                            <td style="cursor: pointer;"
                                                                onclick="document.getElementById('editFormNilaiWwn{{ $userWwnLolos->no_pendaftaran }}').submit();">
                                                                {{ $userWwnLolos->name }}
                                                            </td>
                                                            <td>{{ $userWwnLolos->email }}
                                                            </td>
                                                            <td>{{ isset($userWwnLolos->soal) ? $userWwnLolos->soal : '' }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <div>
                                                        Peserta Lolos / Gagal Belum Ada.
                                                    </div>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="bg-dark py-md-1 pb-3 px-3 mb-3">
                                        <p class="p-3 h5 bg-danger mt-3">Daftar Mahasiswa yang Menerima
                                            Pengumuman
                                            Gagal :
                                        </p>
                                        {{-- <hr style="border-color:#ffffff"> --}}
                                        <table class="table table-responsive table-borderless text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Nama</th>
                                                    <th scope="col">Email</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                @foreach ($getAllWwnGagal as $userWwnGagal)
                                                    <tr>
                                                        <th scope="row">{{ $i++ }}</th>
                                                        <td>{{ $userWwnGagal->name }}
                                                        </td>
                                                        <td>{{ $userWwnGagal->email }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                {{--  --}}
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
                            @if (isset($periodeOpenned->status_wwn))
                                Telah Diumumkan pada
                                {{ isset($periodeOpenned->ts_wwn) ? $periodeOpenned->ts_wwn->translatedFormat('d F Y - H:i') : '' }}.
                            @else
                                <div class="text-right">
                                    <p class="m-0 p-0 small">Tandai Tahap Wawancara Telah Selesai.</p>
                                    <p class="m-0 p-0 small">& Kirim Pengumuman.</p>
                                </div>
                                <button type="submit" class="btn btn-primary">Selesai & Kirim</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ======== MODAL UMUMKAN AKHIR ======== --}}
        <!-- Modal -->
        <div class="modal fade" id="umumkanPng" tabindex="-1" role="dialog" aria-labelledby="umumkanPngLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form id="pengumumanPngForm" method="POST"
                        action="{{ route('umumkan.png', $periodeOpenned->name) }}">
                        @csrf
                        <div class="modal-body pb-0">
                            <div class="row">
                                <div class="col-12">
                                    <div class="bg-dark py-md-1 pb-3 px-3 mb-3">
                                        <p class="p-3 h5 bg-success mt-3">Daftar Mahasiswa yang
                                            Menerima Pengumuman
                                            Lolos :
                                        </p>
                                        {{-- <hr style="border-color:#ffffff"> --}}
                                        <table class="table table-responsive table-borderless text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Nama</th>
                                                    <th scope="col">Email</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                @if ($getAllPngLolos != null || $getAllPngGagal != null)
                                                    @foreach ($getAllPngLolos as $userPngLolos)
                                                        <tr>
                                                            <th scope="row">{{ $i++ }}</th>
                                                            <td style="cursor: pointer;"
                                                                onclick="document.getElementById('editFormNilaiPng{{ $userPngLolos->no_pendaftaran }}').submit();">
                                                                {{ $userPngLolos->name }}
                                                            </td>
                                                            <td>{{ $userPngLolos->email }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <div>
                                                        Peserta Lolos / Gagal Belum Ada.
                                                    </div>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="bg-dark py-md-1 pb-3 px-3 mb-3">
                                        <p class="p-3 h5 bg-danger mt-3">Daftar Mahasiswa yang Menerima
                                            Pengumuman
                                            Gagal :
                                        </p>
                                        {{-- <hr style="border-color:#ffffff"> --}}
                                        <table class="table table-responsive table-borderless text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Nama</th>
                                                    <th scope="col">Email</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                @if ($getAllPngLolos != null || $getAllPngGagal != null)
                                                    @foreach ($getAllPngGagal as $userPngGagal)
                                                        <tr>
                                                            <th scope="row">{{ $i++ }}</th>
                                                            <td>{{ $userPngGagal->name }}
                                                            </td>
                                                            <td>{{ $userPngGagal->email }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                {{--  --}}
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
                            @if (isset($periodeOpenned->status_png))
                                Telah Diumumkan pada
                                {{ isset($periodeOpenned->ts_png) ? $periodeOpenned->ts_png->translatedFormat('d F Y - H:i') : '' }}.
                            @else
                                <div class="text-right">
                                    <p class="m-0 p-0 small">Tandai Tahap Penugasan Telah Selesai.</p>
                                    <p class="m-0 p-0 small">& Kirim Pengumuman.</p>
                                </div>
                                <button type="submit" class="btn btn-primary">Selesai & Kirim</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            $('.datepicker').each(function() {
                $(this).datepicker({
                    format: 'dd mmmm yyyy',
                    uiLibrary: 'bootstrap4',
                    iconsLibrary: 'fontawesome',
                    showRightIcon: true,
                    todayHighlight: true,
                    autoclose: true,
                });
            });
        </script>
        <!-- Page specific script -->
        <script>
            $(function() {
                $("#tableperiodeuser").DataTable({
                    // "dom": 'Blfrtip',
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "info": true,
                    "stateSave": true,
                    "paging": true,
                    "lengthMenu": [
                        [5, 10, 25, 50, -1],
                        [5, 10, 25, 50, "All"]
                    ],
                    "buttons": ["pageLength", "excel", "pdf", {
                        extend: 'print',
                        text: 'Print',
                        exportOptions: {
                            columns: ':visible',
                            page: 'current'
                        }
                    }, "colvis"],
                }).buttons().container().appendTo('#tableperiodeuser_wrapper .col-md-6:eq(0)');
            });
        </script>
    @endsection
