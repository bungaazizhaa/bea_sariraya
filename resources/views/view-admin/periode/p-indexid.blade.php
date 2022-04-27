@extends('view-admin.layouts.app')
@section('titlepage')
    <title>Dashboard Beasiswa Sariraya</title>
@endsection
@section('title')
    <h4 class="m-0 p-0">Periode {{ $periodeOpenned->name }}</h4>
@endsection
@section('content')
    <!-- Main content -->
    <div class="container px-4">
        <h1 class="h4">Informasi</h1>
        <div class="row">
            <div class="col mb-3">
                <div onclick="location.href='{{ route('periode', $periodeOpenned->id) }}'"
                    class="{{ $periodeOpenned->status == 'aktif' ? 'bg-success' : 'bg-secondary' }} rounded myshadow d-flex">
                    <p class="m-3 h5">
                        Status
                        : {{ ucfirst($periodeOpenned->status) }}
                    </p>
                </div>
            </div>
            <div class="ml-2 mb-3 mr-2">
                <button type="button" data-toggle="modal" data-target="#editPeriode"
                    class="rounded myshadow d-flex justify-content-center align-items-center btn btn-sm btn-primary my-0 p-3 tombol"><i
                        class="fas fa-edit"></i>&nbsp;Ubah
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
                                    <i class="fa-regular text-light fa-circle-check fa-2xl"></i>
                                </span>
                            @else
                                <span class="btn" style="width: 64px">
                                    <i class="fa-regular text-light fa-clock fa-2xl"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                    </p>
                    <hr style="border-color:#ffffff88">
                    <p class="mb-1">Tanggal Mulai :</p>
                    <p><strong>{{ $periodeOpenned->tm_adm->isoFormat('D MMMM Y') }}</strong></p>
                    <p class="mb-1 mt-2">Tanggal Akhir :</p>
                    <p><strong>{{ $periodeOpenned->ta_adm->isoFormat('D MMMM Y') }}</strong></p>
                    <p class="mb-1 mt-2">Tanggal Pengumuman :</p>
                    <p class="mb-0"><strong>{{ $periodeOpenned->tp_adm->isoFormat('D MMMM Y') }}</strong>
                    </p>
                    <hr style="border-color:#ffffff88">
                    <div id="footer-tahap" class="d-flex" style="height:38px">
                        @if ($getTanggalSekarang > $periodeOpenned->ta_adm)
                            <a href="/nilai-administrasi" class="btn btn-outline-light">Nilai Administrasi</a>
                        @endif
                        @if ($getTanggalSekarang >= $periodeOpenned->tp_adm)
                            <button class="btn btn-outline-light ml-auto">Umumkan</button>
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
                                    <i class="fa-regular text-light fa-circle-check fa-2xl"></i>
                                </span>
                            @else
                                <span class="btn" style="width: 64px">
                                    <i class="fa-regular text-light fa-clock fa-2xl"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                    </p>
                    <hr style="border-color:#ffffff88">
                    <p class="mb-1">Tanggal Mulai :</p>
                    <p><strong>{{ $periodeOpenned->tm_wwn->isoFormat('D MMMM Y') }}</strong></p>
                    <p class="mb-1 mt-2">Tanggal Akhir :</p>
                    <p><strong>{{ $periodeOpenned->ta_wwn->isoFormat('D MMMM Y') }}</strong></p>
                    <p class="mb-1 mt-2">Tanggal Pengumuman :</p>
                    <p class="mb-0"><strong>{{ $periodeOpenned->tp_wwn->isoFormat('D MMMM Y') }}</strong>
                    </p>
                    <hr style="border-color:#ffffff88">
                    <div id="footer-tahap" class="d-flex" style="height:38px">
                        @if ($getTanggalSekarang >= $periodeOpenned->tm_wwn)
                            <a href="/nilai-administrasi" class="btn btn-outline-light">Nilai Wawancara</a>
                        @endif
                        @if ($getTanggalSekarang >= $periodeOpenned->tp_wwn)
                            <button class="btn btn-outline-light ml-auto">Umumkan</button>
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
                                    <i class="fa-regular text-light fa-circle-check fa-2xl"></i>
                                </span>
                            @else
                                <span class="btn" style="width: 64px">
                                    <i class="fa-regular text-light fa-clock fa-2xl"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                    </p>
                    <hr style="border-color:#ffffff88">
                    <p class="mb-1">Tanggal Mulai :</p>
                    <p><strong>{{ $periodeOpenned->tm_png->isoFormat('D MMMM Y') }}</strong></p>
                    <p class="mb-1 mt-2">Tanggal Akhir :</p>
                    <p><strong>{{ $periodeOpenned->ta_png->isoFormat('D MMMM Y') }}</strong></p>
                    <p class="mb-1 mt-2">Tanggal Pengumuman :</p>
                    <p class="mb-0"><strong>{{ $periodeOpenned->tp_png->isoFormat('D MMMM Y') }}</strong>
                    </p>
                    <hr style="border-color:#ffffff88">
                    <div id="footer-tahap" class="d-flex" style="height:38px">
                        @if ($getTanggalSekarang > $periodeOpenned->ta_png)
                            <a href="/nilai-administrasi" class="btn btn-outline-light">Nilai Penugasan</a>
                        @endif
                        @if ($getTanggalSekarang >= $periodeOpenned->tp_png)
                            <button class="btn btn-outline-light ml-auto">Umumkan</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>


        {{-- ======== MODAL EDIT PERIODE ======== --}}
        <!-- Modal -->
        <div class="modal fade" id="editPeriode" tabindex="-1" role="dialog" aria-labelledby="editPeriodeLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form id="periodeForm" method="POST" action="{{ route('update.periode', $periodeOpenned->id) }}">
                        @csrf
                        {{-- <div class="modal-header">
                            <h5 class="modal-title" id="editPeriodeLabel">Detail Periode</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div> --}}
                        <div class="modal-body pb-0">
                            <div class="row">
                                <div class="col-12">
                                    <div class="bg-secondary py-md-1 pb-3 px-3 rounded myshadow mb-3">
                                        <div class="row">
                                            <label for="status" class="col col-form-label">Status :</label>
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
                                    <div class="bg-secondary p-3 rounded myshadow mb-3">
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
                                        <input id="tm_adm" type="tm_adm" class="datepicker"
                                            class="form-control @error('tm_adm') is-invalid @enderror" name="tm_adm"
                                            value="{{ old('tm_adm', $periodeOpenned->tm_adm->format('d-m-Y')) }}"
                                            required autocomplete="tm_adm" autofocus>

                                        @error('tm_adm')
                                            <div class="small text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                        <p class="mb-1 mt-2">Tanggal Akhir :</p>
                                        <input id="ta_adm" type="ta_adm" class="datepicker"
                                            class="form-control @error('ta_adm') is-invalid @enderror" name="ta_adm"
                                            value="{{ old('ta_adm', $periodeOpenned->ta_adm->format('d-m-Y')) }}"
                                            required autocomplete="ta_adm" autofocus>

                                        @error('ta_adm')
                                            <div class="small text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                        <p class="mb-1 mt-2">Tanggal Pengumuman :</p>
                                        <input id="tp_adm" type="tp_adm" class="datepicker"
                                            class="form-control @error('tp_adm') is-invalid @enderror" name="tp_adm"
                                            value="{{ old('tp_adm', $periodeOpenned->tp_adm->format('d-m-Y')) }}"
                                            required autocomplete="tp_adm" autofocus>

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
                                    <div class="bg-secondary p-3 rounded myshadow mb-3">
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
                                        <input id="tm_wwn" type="tm_wwn" class="datepicker"
                                            class="form-control @error('tm_wwn') is-invalid @enderror" name="tm_wwn"
                                            value="{{ old('tm_wwn', $periodeOpenned->tm_wwn->format('d-m-Y')) }}"
                                            required autocomplete="tm_wwn" autofocus>

                                        @error('tm_wwn')
                                            <div class="small text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                        <p class="mb-1 mt-2">Tanggal Akhir :</p>
                                        <input id="ta_wwn" type="ta_wwn" class="datepicker"
                                            class="form-control @error('ta_wwn') is-invalid @enderror" name="ta_wwn"
                                            value="{{ old('ta_wwn', $periodeOpenned->ta_wwn->format('d-m-Y')) }}"
                                            required autocomplete="ta_wwn" autofocus>

                                        @error('ta_wwn')
                                            <div class="small text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                        <p class="mb-1 mt-2">Tanggal Pengumuman :</p>
                                        <input id="tp_wwn" type="tp_wwn" class="datepicker"
                                            class="form-control @error('tp_wwn') is-invalid @enderror" name="tp_wwn"
                                            value="{{ old('tp_wwn', $periodeOpenned->tp_wwn->format('d-m-Y')) }}"
                                            required autocomplete="tp_wwn" autofocus>

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
                                    <div class="bg-secondary p-3 rounded myshadow mb-3">
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
                                        <input id="tm_png" type="tm_png" class="datepicker"
                                            class="form-control @error('tm_png') is-invalid @enderror" name="tm_png"
                                            value="{{ old('tm_png', $periodeOpenned->tm_png->format('d-m-Y')) }}"
                                            required autocomplete="tm_png" autofocus>

                                        @error('tm_png')
                                            <div class="small text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                        <p class="mb-1 mt-2">Tanggal Akhir :</p>
                                        <input id="ta_png" type="ta_png" class="datepicker"
                                            class="form-control @error('ta_png') is-invalid @enderror" name="ta_png"
                                            value="{{ old('ta_png', $periodeOpenned->ta_png->format('d-m-Y')) }}"
                                            required autocomplete="ta_png" autofocus>

                                        @error('ta_png')
                                            <div class="small text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                        <p class="mb-1 mt-2">Tanggal Pengumuman :</p>
                                        <input id="tp_png" type="tp_png" class="datepicker"
                                            class="form-control @error('tp_png') is-invalid @enderror" name="tp_png"
                                            value="{{ old('tp_png', $periodeOpenned->tp_png->format('d-m-Y')) }}"
                                            required autocomplete="tp_png" autofocus>

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
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            $('.datepicker').each(function() {
                $(this).datepicker({
                    format: 'dd-mm-yyyy',
                    uiLibrary: 'bootstrap4',
                    iconsLibrary: 'fontawesome',
                    showRightIcon: true,
                    todayHighlight: true,
                    autoclose: true,
                });
            });
        </script>
    @endsection
