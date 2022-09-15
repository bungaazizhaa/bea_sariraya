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
        <div class="d-flex justify-content-between mb-3 align-items-stretch">
            <div
                class="{{ $periodeOpenned->status == 'aktif' ? 'bg-success' : 'bg-dark' }}
                    rounded-md myshadow w-100 mr-3 py-1 h-100">
                <p
                    class=" my-2 mx-3 mt-0 h5 {{ $periodeOpenned->status == 'aktif' ? 'text-dark' : 'text-light' }} font-weight-bold">
                    Status: {{ ucfirst($periodeOpenned->status) }}
                </p>
            </div>
            <div>
                <button type="button" data-toggle="modal" data-target="#editPeriode"
                    class="btn btn-warning rounded-md myshadow text-truncate font-weight-bold py-1 px-3 h-100"><i
                        class="fa-solid fa-gear"></i>&nbsp;
                    Pengaturan
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div
                    class="p-3 rounded-md myshadow mb-3 {{ isset($periodeOpenned->status_adm) ? 'bg-selesai' : 'bg-sec-dark' }}">
                    <div
                        class="d-flex justify-content-between {{ $periodeOpenned->status_adm == 'Selesai' ? 'text-success' : '' }}">
                        <div>
                            <p class="h4 mb-0 font-weight-bold">
                                Tahap Administrasi
                            </p>
                            <p class="mb-0">
                                ({{ isset($periodeOpenned->status_adm) ? 'Selesai' : 'Belum Selesai' }})
                        </div>
                        <div class="mt-2">
                            @if ($periodeOpenned->status_adm == 'Selesai')
                                <span class="btn" style="width: 64px; cursor:default;">
                                    <i class="fa-regular text-success fa-circle-check fa-2xl"></i>
                                </span>
                            @else
                                <span class="btn" style="width: 64px; cursor:default;">
                                    <i class="fa-regular text-muted fa-clock fa-2xl"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                    </p>
                    <hr>
                    <p class="mb-0">Tanggal Mulai :</p>
                    <p><strong>{{ $periodeOpenned->tm_adm->translatedFormat('d F Y') }}</strong></p>
                    <p class="mb-0 mt-2">Tanggal Akhir :</p>
                    <p><strong>{{ $periodeOpenned->ta_adm->translatedFormat('d F Y') }}</strong></p>
                    <p class="mb-0 mt-2">Tanggal Pengumuman :</p>
                    <p class="mb-0">
                        <strong>{{ $periodeOpenned->tp_adm->translatedFormat('d F Y') }}</strong>
                    </p>
                    <hr style="border-color:#343A4070;">
                    <div id="footer-tahap" class="d-flex" style="height:38px">
                        @if ($getTanggalSekarang > $periodeOpenned->ta_adm->format('Y-m-d'))
                            <a href="/{{ $periodeOpenned->name }}/nilai-administrasi"
                                class="btn btn-dark rounded-sm text-truncate mr-1"><i
                                    class="fa-solid fa-list-check"></i>&nbsp;
                                Nilai
                                Administrasi</a>
                        @else
                            <div class="btn btn-secondary rounded-sm text-truncate mr-1 disabled"
                                style="cursor: help !important;" data-toggle="tooltip" data-placement="right"
                                title="<strong class='text-danger'>- Tombol Belum Berfungsi -</strong><br>Nilai Formulir Administrasi peserta setelah tanggal <span class='text-nowrap'>{{ $periodeOpenned->ta_adm->translatedFormat('d F Y') }}</span>.">
                                &nbsp;
                                Nilai Administrasi
                                <small class="p-1"><i class="fa-regular fa-circle-question text-white"></i>
                                </small>
                            </div>
                        @endif
                        @if ($getTanggalSekarang >= $periodeOpenned->tp_adm->format('Y-m-d'))
                            <button class="btn btn-dark rounded-sm ml-auto text-truncate" data-toggle="modal"
                                data-target="#umumkanAdm"><i class="fa-regular fa-envelope"></i>&nbsp; Umumkan</button>
                        @else
                            <div class="btn btn-secondary rounded-sm ml-auto text-truncate disabled"
                                style="cursor: help !important;" data-toggle="tooltip" data-placement="left"
                                title="<strong class='text-danger'>- Tombol Belum Berfungsi -</strong><br>Umumkan Tahap ini pada tanggal <span class='text-nowrap'>{{ $periodeOpenned->tp_adm->translatedFormat('d F Y') }}.</span>">
                                &nbsp;
                                Umumkan
                                <small class="p-1"><i class="fa-regular fa-circle-question text-white"></i>
                                </small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div
                    class="p-3 rounded-md myshadow mb-3 {{ isset($periodeOpenned->status_wwn) ? 'bg-selesai' : 'bg-sec-dark' }}">
                    <div
                        class="d-flex justify-content-between {{ $periodeOpenned->status_wwn == 'Selesai' ? 'text-success' : '' }}">
                        <div>
                            <p class="h4 mb-0 font-weight-bold">
                                Tahap Wawancara
                            </p>
                            <p class="mb-0">
                                ({{ isset($periodeOpenned->status_wwn) ? 'Selesai' : 'Belum Selesai' }})
                        </div>
                        <div class="mt-2">
                            @if ($periodeOpenned->status_wwn == 'Selesai')
                                <span class="btn" style="width: 64px; cursor:default;">
                                    <i class="fa-regular text-success fa-circle-check fa-2xl"></i>
                                </span>
                            @else
                                <span class="btn" style="width: 64px; cursor:default;">
                                    <i class="fa-regular text-muted fa-clock fa-2xl"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                    </p>
                    <hr style="border-color:#343A4070;">
                    <p class="mb-0">Tanggal Mulai :</p>
                    <p><strong>{{ $periodeOpenned->tm_wwn->translatedFormat('d F Y') }}</strong></p>
                    <p class="mb-0 mt-2">Tanggal Akhir :</p>
                    <p><strong>{{ $periodeOpenned->ta_wwn->translatedFormat('d F Y') }}</strong></p>
                    <p class="mb-0 mt-2">Tanggal Pengumuman :</p>
                    <p class="mb-0">
                        <strong>{{ $periodeOpenned->tp_wwn->translatedFormat('d F Y') }}</strong>
                    </p>
                    <hr style="border-color:#343A4070;">
                    <div id="footer-tahap" class="d-flex" style="height:38px">
                        @if ($getTanggalSekarang >= $periodeOpenned->tm_wwn->format('Y-m-d'))
                            <a href="/{{ $periodeOpenned->name }}/nilai-wawancara"
                                class="btn btn-dark rounded-sm text-truncate mr-1"><i
                                    class="fa-solid fa-list-check"></i>&nbsp;
                                Nilai Wawancara</a>
                        @else
                            <div class="btn btn-secondary rounded-sm text-truncate mr-1 disabled"
                                style="cursor: help !important;" data-toggle="tooltip" data-placement="right"
                                title="<strong class='text-danger'>- Tombol Belum Berfungsi -</strong><br>Penilaian wawancara dimulai pada tanggal <span class='text-nowrap'>{{ $periodeOpenned->tm_wwn->translatedFormat('d F Y') }}</span>.">
                                &nbsp;
                                Nilai Wawancara
                                <small class="p-1"><i class="fa-regular fa-circle-question text-white"></i>
                                </small>
                            </div>
                        @endif
                        @if ($getTanggalSekarang >= $periodeOpenned->tp_wwn->format('Y-m-d'))
                            <button class="btn btn-dark rounded-sm ml-auto text-truncate" data-toggle="modal"
                                data-target="#umumkanWwn"><i class="fa-regular fa-envelope"></i>&nbsp; Umumkan</button>
                        @else
                            <div class="btn btn-secondary rounded-sm ml-auto text-truncate disabled"
                                style="cursor: help !important;" data-toggle="tooltip" data-placement="left"
                                title="<strong class='text-danger'>- Tombol Belum Berfungsi -</strong><br>Umumkan Tahap ini pada tanggal <span class='text-nowrap'>{{ $periodeOpenned->tp_wwn->translatedFormat('d F Y') }}.</span>">
                                &nbsp;
                                Umumkan
                                <small class="p-1"><i class="fa-regular fa-circle-question text-white"></i>
                                </small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div
                    class="p-3 rounded-md myshadow mb-3 {{ isset($periodeOpenned->status_png) ? 'bg-selesai' : 'bg-sec-dark' }}">
                    <div
                        class="d-flex justify-content-between {{ $periodeOpenned->status_png == 'Selesai' ? 'text-success' : '' }}">
                        <div>
                            <p class="h4 mb-0 font-weight-bold">
                                Tahap Penugasan
                            </p>
                            <p class="mb-0">
                                ({{ isset($periodeOpenned->status_png) ? 'Selesai' : 'Belum Selesai' }})
                        </div>
                        <div class="mt-2">
                            @if ($periodeOpenned->status_png == 'Selesai')
                                <span class="btn" style="width: 64px; cursor:default;">
                                    <i class="fa-regular text-success fa-circle-check fa-2xl"></i>
                                </span>
                            @else
                                <span class="btn" style="width: 64px; cursor:default;">
                                    <i class="fa-regular text-muted fa-clock fa-2xl"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                    </p>
                    <hr style="border-color:#343A4070;">
                    <p class="mb-0">Tanggal Mulai :</p>
                    <p><strong>{{ $periodeOpenned->tm_png->translatedFormat('d F Y') }}</strong></p>
                    <p class="mb-0 mt-2">Tanggal Akhir :</p>
                    <p><strong>{{ $periodeOpenned->ta_png->translatedFormat('d F Y') }}</strong></p>
                    <p class="mb-0 mt-2">Tanggal Pengumuman :</p>
                    <p class="mb-0">
                        <strong>{{ $periodeOpenned->tp_png->translatedFormat('d F Y') }}</strong>
                    </p>
                    <hr style="border-color:#343A4070;">
                    <div id="footer-tahap" class="d-flex" style="height:38px">
                        @if ($getTanggalSekarang > $periodeOpenned->ta_png)
                            <a href="/{{ $periodeOpenned->name }}/nilai-penugasan"
                                class="btn btn-dark rounded-sm text-truncate mr-1"><i
                                    class="fa-solid fa-list-check"></i>&nbsp;
                                Nilai
                                Penugasan</a>
                        @else
                            <div class="btn btn-secondary rounded-sm text-truncate mr-1 disabled"
                                style="cursor: help !important;" data-toggle="tooltip" data-placement="right"
                                title="<strong class='text-danger'>- Tombol Belum Berfungsi -</strong><br>Nilai tugas peserta setelah tanggal <span class='text-nowrap'>{{ $periodeOpenned->ta_png->translatedFormat('d F Y') }}</span>.">
                                &nbsp;
                                Nilai Penugasan
                                <small class="p-1"><i class="fa-regular fa-circle-question text-white"></i>
                                </small>
                            </div>
                        @endif
                        @if ($getTanggalSekarang >= $periodeOpenned->tp_png->format('Y-m-d'))
                            <button class="btn btn-dark rounded-sm ml-auto text-truncate" data-toggle="modal"
                                data-target="#umumkanPng"><i class="fa-regular fa-envelope"></i>&nbsp;
                                Umumkan</button>
                        @else
                            <div class="btn btn-secondary rounded-sm ml-auto text-truncate disabled"
                                style="cursor: help !important;" data-toggle="tooltip" data-placement="left"
                                title="<strong class='text-danger'>- Tombol Belum Berfungsi -</strong><br>Umumkan Tahap ini pada tanggal <span class='text-nowrap'>{{ $periodeOpenned->tp_png->translatedFormat('d F Y') }}.</span>">
                                &nbsp;
                                Umumkan
                                <small class="p-1"><i class="fa-regular fa-circle-question text-white"></i>
                                </small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>


        {{-- Input Teknis Wawancara --}}
        <div class="row">
            <div id="accordion" class="col-lg-8 rounded-md">
                <div class="card w-100 myshadow rounded-md bg-dark">
                    <div class="card-header bg-dark rounded-md" id="headingOne" data-toggle="collapse"
                        style="cursor: pointer;" data-target="#collapseOne" aria-expanded="true"
                        aria-controls="collapseOne">
                        <h5 class="mb-0 font-weight-bold {{ isset($periodeOpenned->teknis_wwn) ? 'text-success' : '' }}">
                            {!! isset($periodeOpenned->teknis_wwn)
                                ? '<i class="fa-regular fa-circle-check text-success"></i>&nbsp; '
                                : '<i class="fa-regular fa-circle-xmark text-danger"></i>&nbsp; ' !!}Teknis
                            Wawancara
                        </h5>
                    </div>
                    <small class="mytooltip" style="cursor: help !important;" data-toggle="tooltip"
                        data-placement="left"
                        title="<strong class='text-info'>- Informasi -</strong><br>Deskripsikan tata cara melakukan wawancara. Ini akan ditampilkan pada halaman Pengumuman Lolos Administrasi. <br><span class='text-info'>Contoh: Link Meeting, Pakaian, Aturan, dsb.</span><br>"><i
                            class="fa-regular fa-circle-question text-muted"></i></small>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body bg-dark rounded-md pt-2 border-top" style="border-color: #303030!important">
                            <form id="tekniswwnForm" method="POST"
                                action="{{ route('tekniswwnupdate.periode', $periodeOpenned->name) }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <textarea autocomplete="off" id="summernote" name="teknis_wwn" spellcheck="false">{!! $periodeOpenned->teknis_wwn !!}</textarea>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit"
                                            class="rounded-md myshadow btn float-right ml-3 btn-outline-primary"><i
                                                class="fa-solid fa-floppy-disk"> </i> Simpan
                                        </button>
                                        <a href="/preview-tekniswwn" target="_blank"
                                            class="rounded-md myshadow btn float-right btn-outline-light"><i
                                                class="fa-solid fa-eye"></i> Preview
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="accordion2" class="col-lg-4 rounded-md">
                <div class="card w-100 myshadow rounded-md bg-dark">
                    <div class="card-header bg-dark rounded-md" id="headingOne" data-toggle="collapse"
                        style="cursor: pointer;" data-target="#collapseWA" aria-expanded="true"
                        aria-controls="collapseWA">
                        <h5 class="mb-0 font-weight-bold {{ isset($periodeOpenned->group_wa) ? 'text-success' : '' }}">
                            {!! isset($periodeOpenned->group_wa)
                                ? '<i class="fa-regular fa-circle-check text-success"></i>&nbsp; '
                                : '<i class="fa-regular fa-circle-xmark text-danger"></i>&nbsp; ' !!}Grup WhatsApp
                        </h5>
                    </div>
                    <small class="mytooltip" style="cursor: help !important;" data-toggle="tooltip"
                        data-placement="left"
                        title="<strong class='text-info'>- Informasi -</strong><br>Isi kolom dengan Link Grup WhatsApp. Link ini akan tampil di halaman Pengumuman Akhir Peserta Beasiswa."><i
                            class="fa-regular fa-circle-question text-muted"></i></small>
                    <div id="collapseWA" class="collapse" aria-labelledby="headingOne" data-parent="#accordion2">
                        <div class="card-body bg-dark rounded-md pt-2 border-top" style="border-color: #303030!important">
                            <form id="groupwaForm" method="POST"
                                action="{{ route('groupwaupdate.periode', $periodeOpenned->name) }}">
                                @csrf
                                <textarea autocomplete="off" type="text" id="group_wa" name="group_wa" spellcheck="false" class="form-control"
                                    placeholder="Pastikan dimulai dari 'https://...'" rows="4">{{ $periodeOpenned->group_wa }}</textarea>

                                <button type="submit"
                                    class="rounded-md myshadow btn float-right btn-outline-primary mt-3"><i
                                        class="fa-solid fa-floppy-disk"> </i> Simpan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card rounded-md">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-12">
                                <p class="h5 pt-1 font-weight-bold mb-0"><i class="fa-solid fa-users"></i>&nbsp;
                                    Pendaftar
                                    {{ ucfirst($periodeOpenned->name) }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <small class="mytooltip" style="cursor: help !important;" data-toggle="tooltip"
                        data-placement="left"
                        title="<strong class='text-info'>- Informasi -</strong><br>Peserta yang telah submit Formulir Administrasi akan muncul di tabel ini dan terdaftar sebagai peserta Beasiswa Periode {{ ucfirst($periodeOpenned->name) }}."><i
                            class="fa-regular fa-circle-question text-muted"></i></small>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tableperiodeuser" class="table table-striped table-borderless table-dark rounded">
                            <thead class="text-secondary">
                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Nomor</th>
                                    <th>Email</th>
                                    <th>Status Adm</th>
                                    <th>Status Wwn</th>
                                    <th>Status Png</th>
                                    <th>Catatan Adm</th>
                                    <th>Catatan Wwn</th>
                                    <th>Catatan Png</th>
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
                                            <td>{{ $userAdm->nim }}</td>

                                            <td><a class="text-light"
                                                    href="{{ route('pengguna.show', $userAdm->iduser) }}">{{ $userAdm->name }}</a>
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
                                            </td>

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
                                            <td>{{ isset($userAdm->catatanadm) ? $userAdm->catatanadm : '-' }}</td>
                                            <td>{{ isset($userAdm->catatanwwn) ? $userAdm->catatanwwn : '-' }}
                                            </td>
                                            <td>{{ isset($userAdm->catatanpng) ? $userAdm->catatanpng : '-' }}
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
                <div class="modal-content rounded-md">
                    <form id="periodeForm" method="POST" action="{{ route('update.periode', $periodeOpenned->name) }}">
                        @csrf
                        <div class="modal-header h4 text-center">
                            <p class="mb-0 w-100">Form Edit Periode</p>
                        </div>
                        <div class="modal-body pb-0">
                            <div class="row">
                                <div class="col-12">
                                    <div class="bg-secondary py-md-1 pb-3 px-3 rounded-md myshadow mb-3">
                                        <div class="row">
                                            <label for="id_periode" class="col col-form-label text-lg-right">ID
                                                Periode
                                                :</label>
                                            <div class="col-12 col-lg-10 mb-1">
                                                <input autocomplete="off" disabled spellcheck="false" id="id_periode"
                                                    name="id_periode"
                                                    value="{{ old('id_periode', $periodeOpenned->id_periode) }}"
                                                    class="form-control disabled text-muted">
                                                @error('id_periode')
                                                    <span class="small text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="name" class="col col-form-label text-lg-right">Nama Periode
                                                :</label>
                                            <div class="col-12 col-lg-10">
                                                <input autocomplete="off" spellcheck="false" disabled id="name"
                                                    name="name" value="{{ old('name', $periodeOpenned->name) }}"
                                                    class="form-control disabled text-muted">
                                                @error('name')
                                                    <span class="small text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <small class="text-disable text-muted">(ID dan Nama tidak dapat
                                                    diubah.)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="bg-secondary py-md-1 pb-3 px-3 rounded-md mb-3">
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
                                    <div class="bg-secondary p-3 rounded-md mb-3">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <p class="h5 mb-0 font-weight-bold">
                                                    Tahap Administrasi
                                                </p>
                                            </div>
                                        </div>
                                        </p>
                                        <hr style="border-color:#343A4070;">
                                        <p class="mb-1">Tanggal Mulai :</p>
                                        <input autocomplete="off" spellcheck="false" id="tm_adm" type="tm_adm"
                                            class="datepicker" class="form-control @error('tm_adm') is-invalid @enderror"
                                            name="tm_adm"
                                            value="{{ old('tm_adm', $periodeOpenned->tm_adm->format('d F Y')) }}" required
                                            autofocus>

                                        @error('tm_adm')
                                            <div class="small text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                        <p class="mb-1 mt-2">Tanggal Akhir :</p>
                                        <input autocomplete="off" spellcheck="false" id="ta_adm" type="ta_adm"
                                            class="datepicker" class="form-control @error('ta_adm') is-invalid @enderror"
                                            name="ta_adm"
                                            value="{{ old('ta_adm', $periodeOpenned->ta_adm->format('d F Y')) }}" required
                                            autofocus>

                                        @error('ta_adm')
                                            <div class="small text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                        <p class="mb-1 mt-2">Tanggal Pengumuman :</p>
                                        <input autocomplete="off" spellcheck="false" id="tp_adm" type="tp_adm"
                                            class="datepicker" class="form-control @error('tp_adm') is-invalid @enderror"
                                            name="tp_adm"
                                            value="{{ old('tp_adm', $periodeOpenned->tp_adm->format('d F Y')) }}" required
                                            autofocus>

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
                                    <div class="bg-secondary p-3 rounded-md mb-3">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <p class="h5 mb-0 font-weight-bold">
                                                    Tahap Wawancara
                                                </p>
                                            </div>
                                        </div>
                                        </p>
                                        <hr style="border-color:#343A4070;">
                                        <p class="mb-1">Tanggal Mulai :</p>
                                        <input autocomplete="off" spellcheck="false" id="tm_wwn" type="tm_wwn"
                                            class="datepicker" class="form-control @error('tm_wwn') is-invalid @enderror"
                                            name="tm_wwn"
                                            value="{{ old('tm_wwn', $periodeOpenned->tm_wwn->format('d F Y')) }}" required
                                            autofocus>

                                        @error('tm_wwn')
                                            <div class="small text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                        <p class="mb-1 mt-2">Tanggal Akhir :</p>
                                        <input autocomplete="off" spellcheck="false" id="ta_wwn" type="ta_wwn"
                                            class="datepicker" class="form-control @error('ta_wwn') is-invalid @enderror"
                                            name="ta_wwn"
                                            value="{{ old('ta_wwn', $periodeOpenned->ta_wwn->format('d F Y')) }}" required
                                            autofocus>

                                        @error('ta_wwn')
                                            <div class="small text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                        <p class="mb-1 mt-2">Tanggal Pengumuman :</p>
                                        <input autocomplete="off" spellcheck="false" id="tp_wwn" type="tp_wwn"
                                            class="datepicker" class="form-control @error('tp_wwn') is-invalid @enderror"
                                            name="tp_wwn"
                                            value="{{ old('tp_wwn', $periodeOpenned->tp_wwn->format('d F Y')) }}" required
                                            autofocus>

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
                                    <div class="bg-secondary p-3 rounded-md mb-3">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <p class="h5 mb-0 font-weight-bold">
                                                    Tahap Penugasan
                                                </p>
                                            </div>
                                        </div>
                                        </p>
                                        <hr style="border-color:#343A4070;">
                                        <p class="mb-1">Tanggal Mulai :</p>
                                        <input autocomplete="off" spellcheck="false" id="tm_png" type="tm_png"
                                            class="datepicker" class="form-control @error('tm_png') is-invalid @enderror"
                                            name="tm_png"
                                            value="{{ old('tm_png', $periodeOpenned->tm_png->format('d F Y')) }}"
                                            required autofocus>

                                        @error('tm_png')
                                            <div class="small text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                        <p class="mb-1 mt-2">Tanggal Akhir :</p>
                                        <input autocomplete="off" spellcheck="false" id="ta_png" type="ta_png"
                                            class="datepicker" class="form-control @error('ta_png') is-invalid @enderror"
                                            name="ta_png"
                                            value="{{ old('ta_png', $periodeOpenned->ta_png->format('d F Y')) }}"
                                            required autofocus>

                                        @error('ta_png')
                                            <div class="small text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                        <p class="mb-1 mt-2">Tanggal Pengumuman :</p>
                                        <input autocomplete="off" spellcheck="false" id="tp_png" type="tp_png"
                                            class="datepicker" class="form-control @error('tp_png') is-invalid @enderror"
                                            name="tp_png"
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
                            <button type="button" class="btn btn-secondary rounded-sm"
                                data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary rounded-sm">Simpan Perubahan</button>
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
                <div class="modal-content rounded-md">
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
                                                <th scope="col">Kirim Email</th>
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
                                                        @if (isset($periodeOpenned->status_adm))
                                                            <th scope="col">
                                                                <small>
                                                                    {{ isset($userAdmLolos->adm_email_at) ? $userAdmLolos->adm_email_at->diffForHumans() . '. ' : '' }}
                                                                </small>
                                                                <a target="_blank"
                                                                    href="{{ route('umumkanemail.adm', [$periodeOpenned->name, $userAdmLolos->user_id]) }}"
                                                                    class="{{ isset($userAdmLolos->adm_email_at) ? 'small' : 'btn btn-email btn-xs btn-outline-primary' }} font-weight-normal">Kirimkan
                                                                    {{ isset($userAdmLolos->adm_email_at) ? 'Ulang.' : '' }}</a>
                                                            </th>
                                                        @else
                                                            <th scope="col"><button
                                                                    class="btn-email btn btn-xs btn-outline-disabled text-muted"
                                                                    disabled>Status belum Selesai</button>
                                                            </th>
                                                        @endif
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
                                                <th scope="col">Kirim Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($getAllAdmGagal as $userAdmGagal)
                                                <tr>
                                                    <th scope="row">{{ $i++ }}</th>
                                                    <td>{{ $userAdmGagal->name }}</td>
                                                    <td>{{ $userAdmGagal->email }}</td>
                                                    @if (isset($periodeOpenned->status_adm))
                                                        <th scope="col">
                                                            <small>
                                                                {{ isset($userAdmGagal->adm_email_at) ? $userAdmGagal->adm_email_at->diffForHumans() . '. ' : '' }}
                                                            </small>
                                                            <a target="_blank"
                                                                href="{{ route('umumkanemail.adm', [$periodeOpenned->name, $userAdmGagal->user_id]) }}"
                                                                class="{{ isset($userAdmGagal->adm_email_at) ? 'small' : 'btn btn-email btn-xs btn-outline-primary' }} font-weight-normal">Kirimkan
                                                                {{ isset($userAdmGagal->adm_email_at) ? 'Ulang.' : '' }}</a>
                                                        </th>
                                                    @else
                                                        <th scope="col"><button
                                                                class="btn-email btn btn-xs btn-outline-disabled text-muted"
                                                                disabled>Status belum Selesai</button>
                                                        </th>
                                                    @endif
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
                        <button type="button" class="btn btn-secondary rounded-sm mr-auto"
                            data-dismiss="modal">Close</button>
                        @if (isset($periodeOpenned->status_adm))
                            Telah Diumumkan pada
                            {{ isset($periodeOpenned->ts_adm) ? $periodeOpenned->ts_adm->translatedFormat('d F Y - H:i') : '' }}.
                        @else
                            <div class="text-right">
                                <p class="m-0 p-0 small">Atur Status Tahap Administrasi</p>
                                <p class="m-0 p-0 small">menjadi telah Selesai.</p>
                            </div>
                            <form id="pengumumanAdmForm" method="POST"
                                action="{{ route('setselesai.adm', $periodeOpenned->name) }}">
                                @csrf
                                <button type="submit" class="btn btn-primary rounded-sm">Selesai</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{-- ======== MODAL UMUMKAN WAWANCARA ======== --}}
        <!-- Modal -->
        <div class="modal fade" id="umumkanWwn" tabindex="-1" role="dialog" aria-labelledby="umumkanWwnLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content rounded-md">
                    <div class="modal-header h4 text-center">
                        <div class="modal-title w-100">Umumkan Tahap Wawancara</div>
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
                                                <th scope="col">Soal</th>
                                                <th scope="col">Kirim Email</th>
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
                                                        @if (isset($periodeOpenned->status_wwn))
                                                            <th scope="col">
                                                                <small>
                                                                    {{ isset($userWwnLolos->wwn_email_at) ? $userWwnLolos->wwn_email_at->diffForHumans() . '. ' : '' }}
                                                                </small>
                                                                <a target="_blank"
                                                                    href="{{ route('umumkanemail.wwn', [$periodeOpenned->name, $userWwnLolos->user_id]) }}"
                                                                    class="{{ isset($userWwnLolos->wwn_email_at) ? 'small' : 'btn btn-email btn-xs btn-outline-primary' }} font-weight-normal">Kirimkan
                                                                    {{ isset($userWwnLolos->wwn_email_at) ? 'Ulang.' : '' }}</a>
                                                            </th>
                                                        @else
                                                            <th scope="col"><button
                                                                    class="btn-email btn btn-xs btn-outline-disabled text-muted"
                                                                    disabled>Status belum Selesai</button>
                                                            </th>
                                                        @endif
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
                                                <th scope="col">Kirim Email</th>
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
                                                    @if (isset($periodeOpenned->status_wwn))
                                                        <th scope="col">
                                                            <small>
                                                                {{ isset($userWwnGagal->wwn_email_at) ? $userWwnGagal->wwn_email_at->diffForHumans() . '. ' : '' }}
                                                            </small>
                                                            <a target="_blank"
                                                                href="{{ route('umumkanemail.wwn', [$periodeOpenned->name, $userWwnGagal->user_id]) }}"
                                                                class="{{ isset($userWwnGagal->wwn_email_at) ? 'small' : 'btn btn-email btn-xs btn-outline-primary' }} font-weight-normal">Kirimkan
                                                                {{ isset($userWwnGagal->wwn_email_at) ? 'Ulang.' : '' }}</a>
                                                        </th>
                                                    @else
                                                        <th scope="col"><button
                                                                class="btn-email btn btn-xs btn-outline-disabled text-muted"
                                                                disabled>Status belum Selesai</button>
                                                        </th>
                                                    @endif
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
                        <button type="button" class="btn btn-secondary rounded-sm mr-auto"
                            data-dismiss="modal">Close</button>
                        @if (isset($periodeOpenned->status_wwn))
                            Telah Diumumkan pada
                            {{ isset($periodeOpenned->ts_wwn) ? $periodeOpenned->ts_wwn->translatedFormat('d F Y - H:i') : '' }}.
                        @else
                            <div class="text-right">
                                <p class="m-0 p-0 small">Atur Status Tahap Wawancara</p>
                                <p class="m-0 p-0 small">menjadi telah Selesai.</p>
                            </div>
                            <form id="pengumumanWwnForm" method="POST"
                                action="{{ route('setselesai.wwn', $periodeOpenned->name) }}">
                                @csrf
                                <button type="submit" class="btn btn-primary rounded-sm">Selesai</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- ======== MODAL UMUMKAN AKHIR ======== --}}
        <!-- Modal -->
        <div class="modal fade" id="umumkanPng" tabindex="-1" role="dialog" aria-labelledby="umumkanPngLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content rounded-md">
                    <div class="modal-header h4 text-center">
                        <div class="modal-title w-100">Umumkan Tahap Akhir</div>
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
                                                <th scope="col">Kirim Email</th>
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
                                                        @if (isset($periodeOpenned->status_png))
                                                            <th scope="col">
                                                                <small>
                                                                    {{ isset($userPngLolos->png_email_at) ? $userPngLolos->png_email_at->diffForHumans() . '. ' : '' }}
                                                                </small>
                                                                <a target="_blank"
                                                                    href="{{ route('umumkanemail.png', [$periodeOpenned->name, $userPngLolos->user_id]) }}"
                                                                    class="{{ isset($userPngLolos->png_email_at) ? 'small' : 'btn btn-email btn-xs btn-outline-primary' }} font-weight-normal">Kirimkan
                                                                    {{ isset($userPngLolos->png_email_at) ? 'Ulang.' : '' }}</a>
                                                            </th>
                                                        @else
                                                            <th scope="col"><button
                                                                    class="btn-email btn btn-xs btn-outline-disabled text-muted"
                                                                    disabled>Status belum Selesai</button>
                                                            </th>
                                                        @endif
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
                                    <table class="table table-striped table-borderless table-dark rounded-md">
                                        <thead class="text-secondary">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Kirim Email</th>
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
                                                        @if (isset($periodeOpenned->status_png))
                                                            <th scope="col">
                                                                <small>
                                                                    {{ isset($userPngGagal->png_email_at) ? $userPngGagal->png_email_at->diffForHumans() . '. ' : '' }}
                                                                </small>
                                                                <a target="_blank"
                                                                    href="{{ route('umumkanemail.png', [$periodeOpenned->name, $userPngGagal->user_id]) }}"
                                                                    class="{{ isset($userPngGagal->png_email_at) ? 'small' : 'btn btn-email btn-xs btn-outline-primary' }} font-weight-normal">Kirimkan
                                                                    {{ isset($userPngGagal->png_email_at) ? 'Ulang.' : '' }}
                                                                </a>
                                                            </th>
                                                        @else
                                                            <th scope="col"><button
                                                                    class="btn-email btn btn-xs btn-outline-disabled text-muted"
                                                                    disabled>Status belum Selesai</button>
                                                            </th>
                                                        @endif
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
                        <button type="button" class="btn btn-secondary rounded-sm mr-auto"
                            data-dismiss="modal">Close</button>
                        @if (isset($periodeOpenned->status_png))
                            Telah Diumumkan pada
                            {{ isset($periodeOpenned->ts_png) ? $periodeOpenned->ts_png->translatedFormat('d F Y - H:i') : '' }}.
                        @else
                            <div class="text-right">
                                <p class="m-0 p-0 small">Atur Status Tahap Penugasan</p>
                                <p class="m-0 p-0 small">menjadi telah Selesai.</p>
                            </div>
                            <form id="pengumumanPngForm" method="POST"
                                action="{{ route('setselesai.png', $periodeOpenned->name) }}">
                                @csrf
                                <button type="submit" class="btn btn-primary rounded-sm">Selesai</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>


        <script>
            $(document).ready(function() {
                $('#summernote').summernote({
                    placeholder: 'Teknis Wawancara...',
                    tabsize: 2,
                    minHeight: 100,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'clear']],
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
                    "buttons": ["pageLength", "excel", {
                        extend: 'pdf',
                        text: 'PDF',
                        exportOptions: {
                            columns: ':visible',
                            page: 'current'
                        }
                    }, {
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

        <script>
            $(function() {
                $('[data-toggle="tooltip"]').tooltip({
                    html: true,
                    trigger: ' click ',
                })
            })

            $(document).on('click', function(e) {
                $('[data-toggle="tooltip"],[data-original-title]').each(function() {
                    //the 'is' for buttons that trigger popups
                    //the 'has' for icons within a button that triggers a popup
                    if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.tooltip').has(e
                            .target).length === 0) {
                        (($(this).tooltip('hide').data('bs.tooltip') || {}).inState || {}).click =
                            false // fix for BS 3.3.6
                    }

                });
            });
        </script>
    @endsection
