@extends('view-admin.layouts.app')
@section('titlepage')
    <title>Dashboard Beasiswa Sariraya</title>
@endsection
@section('title')
    <h4 class="m-0 p-0">Dashboard</h4>
@endsection
@section('content')
    <div class="container-fluid px-3">
        <!-- Main content -->
        <div class="col-12 mb-3">
            <a type="button" data-toggle="modal" data-target="#tambahPeriode" class="btn btn-secondary">
                <i class="fa-solid fa-plus nav-icon"></i> Tambah Periode
            </a>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div onclick="location.href='{{ route('data.pengguna') }}'" class="small-box bg-info rounded-md myshadow">
                <div class="inner">
                    <h3 class="mb-1">5</h3>
                    <p class="mb-1">Jumlah Mahasiswa<br>yang Registrasi</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ route('data.pengguna') }}" class="small-box-footer rounded-bottom-md">More
                    info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    {{-- ======== MODAL EDIT PERIODE ======== --}}
    <!-- Modal -->
    <div class="modal fade" id="tambahPeriode" tabindex="-1" role="dialog" aria-labelledby="tambahPeriodeLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="periodeForm" autocomplete="off" method="POST" action="{{ route('store.periode') }}">
                    @csrf
                    <div class="modal-header h4 text-center">
                        <p class="mb-0 w-100">Form Tambah Periode</p>
                    </div>
                    <div class="modal-body pb-1">
                        <div class="row">
                            <div class="col-12">
                                <div class="bg-secondary py-md-1 pb-3 px-3 rounded myshadow mb-3">
                                    <div class="row">
                                        <label for="status" class="col col-form-label text-md-right">ID
                                            Periode
                                            :</label>
                                        <div class="col-12 col-md-10">
                                            <input autocomplete="off" id="id_periode" name="id_periode"
                                                value="{{ $getPeriodeLast + 1 }}" class="form-control mb-1">
                                            @error('id_periode')
                                                <div class="small text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="status" class="col col-form-label text-md-right">Nama Periode
                                            :</label>
                                        <div class="col-12 col-md-10">
                                            <input autocomplete="off" id="name" name="name"
                                                value="batch-{{ $getPeriodeLast + 1 }}" class="form-control">
                                            @error('name')
                                                <div class="small text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
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
                                    <input autocomplete="off" id="tm_adm" type="tm_adm" class="datepicker"
                                        class="form-control @error('tm_adm') is-invalid @enderror" name="tm_adm"
                                        value="{{ old('tm_adm') }}" required autocomplete="tm_adm" autofocus>

                                    @error('tm_adm')
                                        <div class="small text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                    <p class="mb-1 mt-2">Tanggal Akhir :</p>
                                    <input autocomplete="off" id="ta_adm" type="ta_adm" class="datepicker"
                                        class="form-control @error('ta_adm') is-invalid @enderror" name="ta_adm"
                                        value="{{ old('ta_adm') }}" required autocomplete="ta_adm" autofocus>

                                    @error('ta_adm')
                                        <div class="small text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                    <p class="mb-1 mt-2">Tanggal Pengumuman :</p>
                                    <input autocomplete="off" id="tp_adm" type="tp_adm" class="datepicker"
                                        class="form-control @error('tp_adm') is-invalid @enderror" name="tp_adm"
                                        value="{{ old('tp_adm') }}" required autocomplete="tp_adm" autofocus>

                                    @error('tp_adm')
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
                                                Tahap Wawancara
                                            </p>
                                        </div>
                                    </div>
                                    </p>
                                    <hr style="border-color:#ffffff88">
                                    <p class="mb-1">Tanggal Mulai :</p>
                                    <input autocomplete="off" id="tm_wwn" type="tm_wwn" class="datepicker"
                                        class="form-control @error('tm_wwn') is-invalid @enderror" name="tm_wwn"
                                        value="{{ old('tm_wwn') }}" required autocomplete="tm_wwn" autofocus>

                                    @error('tm_wwn')
                                        <div class="small text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                    <p class="mb-1 mt-2">Tanggal Akhir :</p>
                                    <input autocomplete="off" id="ta_wwn" type="ta_wwn" class="datepicker"
                                        class="form-control @error('ta_wwn') is-invalid @enderror" name="ta_wwn"
                                        value="{{ old('ta_wwn') }}" required autocomplete="ta_wwn" autofocus>

                                    @error('ta_wwn')
                                        <div class="small text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                    <p class="mb-1 mt-2">Tanggal Pengumuman :</p>
                                    <input autocomplete="off" id="tp_wwn" type="tp_wwn" class="datepicker"
                                        class="form-control @error('tp_wwn') is-invalid @enderror" name="tp_wwn"
                                        value="{{ old('tp_wwn') }}" required autocomplete="tp_wwn" autofocus>

                                    @error('tp_wwn')
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
                                    <input autocomplete="off" id="tm_png" type="tm_png" class="datepicker"
                                        class="form-control @error('tm_png') is-invalid @enderror" name="tm_png"
                                        value="{{ old('tm_png') }}" required autocomplete="tm_png" autofocus>

                                    @error('tm_png')
                                        <div class="small text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                    <p class="mb-1 mt-2">Tanggal Akhir :</p>
                                    <input autocomplete="off" id="ta_png" type="ta_png" class="datepicker"
                                        class="form-control @error('ta_png') is-invalid @enderror" name="ta_png"
                                        value="{{ old('ta_png') }}" required autocomplete="ta_png" autofocus>

                                    @error('ta_png')
                                        <div class="small text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                    <p class="mb-1 mt-2">Tanggal Pengumuman :</p>
                                    <input autocomplete="off" id="tp_png" type="tp_png" class="datepicker"
                                        class="form-control @error('tp_png') is-invalid @enderror" name="tp_png"
                                        value="{{ old('tp_png') }}" required autocomplete="tp_png" autofocus>

                                    @error('tp_png')
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
