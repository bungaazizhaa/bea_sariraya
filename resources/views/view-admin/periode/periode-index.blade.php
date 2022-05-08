@extends('view-admin.layouts.app')
@section('titlepage')
    <title>Pengaturan Periode Beasiswa Sariraya</title>
@endsection
@section('title')
    <h4 class="m-0 p-0">Pengaturan Periode</h4>
@endsection
@section('content')
    <!-- Main content -->
    <div class="container-fluid px-3">
        <!-- Main content -->

        <div class="row">
            <div class="col-12">
                <div class="card rounded-md myshadow">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h3 class="card-title mt-2">Data Seluruh Periode</h3>
                            </div>
                            <div class="col-6">
                                <a type="button" data-toggle="modal" data-target="#tambahPeriode"
                                    class="btn btn-outline-info card-title float-right rounded-pill">
                                    <i class="fa-solid fa-plus nav-icon"></i>&nbsp; Tambah Periode
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tableperiode" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Status Adm</th>
                                    <th>Status Wwn</th>
                                    <th>Status Png</th>
                                    <th>Status Periode</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($getAllPeriode as $periode)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $periode->id_periode }}</td>
                                        <td>{{ ucfirst($periode->name) }}</td>
                                        <td>{{ $periode->status_adm ? $periode->status_adm : '-' }}</td>
                                        <td>{{ $periode->status_wwn ? $periode->status_wwn : '-' }}</td>
                                        <td>{{ $periode->status_png ? $periode->status_png : '-' }}</td>
                                        <td>{{ $periode->status }}</td>
                                        <td class="no-wrap">
                                            <a href="{{ route('periode', $periode->name) }}" id="showUser"
                                                class="btn btn-xs btn-primary">Detail
                                            </a>

                                            <a href="" id="deletePeriodeAlert" data-id="{{ $periode->name }}"
                                                class="btn btn-xs btn-danger ml-2">
                                                <form id="formDelete{{ $periode->name }}" method="POST"
                                                    action="{{ route('destroy.periode', $periode->name) }}">
                                                    @csrf
                                                    Hapus
                                                </form>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
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
                                        value="{{ old('tm_png') }}" required autofocus>

                                    @error('tm_png')
                                        <div class="small text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                    <p class="mb-1 mt-2">Tanggal Akhir :</p>
                                    <input autocomplete="off" id="ta_png" type="ta_png" class="datepicker"
                                        class="form-control @error('ta_png') is-invalid @enderror" name="ta_png"
                                        value="{{ old('ta_png') }}" required autofocus>

                                    @error('ta_png')
                                        <div class="small text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                    <p class="mb-1 mt-2">Tanggal Pengumuman :</p>
                                    <input autocomplete="off" id="tp_png" type="tp_png" class="datepicker"
                                        class="form-control @error('tp_png') is-invalid @enderror" name="tp_png"
                                        value="{{ old('tp_png') }}" required autofocus>

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
                        <button type="submit" class="btn btn-primary">Tambahkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Page specific script -->
    <script>
        $(function() {
            $("#tableperiode").DataTable({
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
                "buttons": ["pageLength", "copy", "excel", "pdf", {
                    extend: 'print',
                    text: 'Print',
                    exportOptions: {
                        columns: ':visible',
                        page: 'current'
                    }
                }, "colvis"],
            }).buttons().container().appendTo('#tableperiode_wrapper .col-md-6:eq(0)');
        });
    </script>
    @if (count($getAllPeriode) > 0)
        <script>
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-danger mx-2',
                    cancelButton: 'btn btn-secondary mx-2'
                },
                buttonsStyling: false
            })

            $(document).on('click', '#deletePeriodeAlert', function(e) {
                e.preventDefault();
                var periodeid = $(this).attr('data-id');
                swalWithBootstrapButtons.fire({
                    title: "Hapus data " + periodeid + " ?",
                    text: "Data tidak dapat dikembalikan setelahnya.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batalkan',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById("formDelete" + periodeid).submit();
                    } else(
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    )
                })
            })
        </script>
    @endif
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
@endsection
