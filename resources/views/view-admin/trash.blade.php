@extends('view-admin.layouts.app')
@section('titlepage')
    <title>Data Terhapus</title>
@endsection
@section('title')
    <h4 class="m-0 p-0 text-truncate"
        style="white-space: nowrap;                                                                                                                                                                                                                                                                    overflow: hidden;text-overflow: ellipsis;">
        Data
        Pengguna
    </h4>
@endsection
@section('content')
    <div class="container">
        <div class="container-fluid">
            <!-- Main content -->
            <div class="row">
                <div class="col-12">
                    <div class="card rounded-md myshadow">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h4 class="mt-2">User Terhapus</h4>
                                </div>
                                <div class="col-6">
                                    @if (count($getAllUserTrashed) > 0)
                                        <div class="mt-2">
                                            <a href="" id="deleteAllUserAlert" style="border: none;"
                                                class="btn btn-xs btn-outline-danger float-right px-2 rounded-pill ml-2 mt-1">
                                                <i class="fa-solid fa-trash"></i>&nbsp; Delete
                                                All
                                            </a>
                                            <a href="" id="restoreAllUserAlert" style="border: none;"
                                                class="btn btn-xs btn-outline-warning float-right px-2 rounded-pill ml-2 mt-1">
                                                <i class="fa-solid fa-sync-alt"></i>&nbsp; Restore All
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tableuser" class="table table-striped table-borderless table-dark rounded">
                                <thead class="text-secondary">
                                    <tr>
                                        <th>No</th>
                                        <th>ID</th>
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Perguruan Tinggi</th>
                                        <th>Program Studi</th>
                                        <th>Dibuat</th>
                                        <th>Diperbarui</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @if ($getAllUser->count())
                                        @foreach ($getAllUserTrashed as $user)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $user->id }}</td>
                                                <td><img src="{{ asset('pictures') . '/' }}{{ $user->picture == '' ? 'noimg.png' : $user->picture }}"
                                                        class="rounded" alt="User Image" height="80px" width="60px">
                                                </td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->role == 'mahasiswa' ? $user->univ->nama_universitas : '-' }}
                                                </td>
                                                <td>{{ $user->role == 'mahasiswa' ? $user->prodi->nama_prodi : '-' }}
                                                </td>
                                                <td>{{ $user->created_at->translatedFormat('d F Y H:i') }}</td>
                                                <td>{{ $user->updated_at->translatedFormat('d F Y H:i') }}</td>
                                                <td class="text-nowrap">
                                                    @if ($user->role == 'mahasiswa')
                                                        <a href="" id="restoreUserAlert"
                                                            data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                                            class="btn btn-xs btn-outline-warning rounded-pill px-2 ml-2">Restore
                                                        </a>
                                                        <a href="" id="deleteUserAlert"
                                                            data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                                            class="btn btn-xs btn-outline-danger rounded-pill px-2 ml-2">Hapus
                                                            Permanen
                                                        </a>
                                                    @endif
                                                </td>
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

            <div class="row">
                <div class="col-12">
                    <div class="card rounded-md myshadow">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h4 class="mt-2">Periode Terhapus</h4>
                                </div>
                                <div class="col-6">
                                    @if (count($getAllPeriodeTrashed) > 0)
                                        <div class="float-right mt-2">
                                            <a href="" id="deleteAllPeriodeAlert" style="border: none;"
                                                class="btn btn-xs btn-outline-danger float-right px-2 rounded-pill ml-2 mt-1">
                                                <i class="fa-solid fa-trash"></i>&nbsp; Delete
                                                All
                                            </a>
                                            <a href="" id="restoreAllPeriodeAlert" style="border: none;"
                                                data-id=""
                                                class="btn btn-xs btn-outline-warning float-right px-2 rounded-pill ml-2 mt-1"><i
                                                    class="fa-solid fa-sync-alt"></i>&nbsp; Restore All
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tableperiode" class="table table-striped table-borderless table-dark rounded">
                                <thead class="text-secondary">
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
                                    @foreach ($getAllPeriodeTrashed as $periode)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $periode->id_periode }}</td>
                                            <td>{{ ucfirst($periode->name) }}</td>
                                            <td>{{ $periode->status_adm ? $periode->status_adm : '-' }}</td>
                                            <td>{{ $periode->status_wwn ? $periode->status_wwn : '-' }}</td>
                                            <td>{{ $periode->status_png ? $periode->status_png : '-' }}</td>
                                            <td>{{ $periode->status }}</td>
                                            <td class="no-wrap">
                                                <a href="" id="restorePeriodeAlert" data-id="{{ $periode->name }}"
                                                    class="btn btn-xs btn-outline-warning ml-2 rounded-pill px-2">Restore
                                                </a>
                                                <a href="" id="deletePeriodeAlert" data-id="{{ $periode->name }}"
                                                    class="btn btn-xs btn-outline-danger ml-2 rounded-pill px-2">Hapus
                                                    Permanen
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
    </div>

    <!-- Page specific script -->
    <script>
        $(function() {
            $("#tableuser").DataTable({
                // "dom": 'Blfrtip',
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "info": true,
                "stateSave": true,
                "paging": true,
                "pagingType": "numbers",
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
            }).buttons().container().appendTo('#tableuser_wrapper .col-md-6:eq(0)');
        });
    </script>

    <script>
        const swalDeleteButton = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-danger mx-2',
                cancelButton: 'btn btn-secondary mx-2'
            },
            buttonsStyling: false
        })
        const swalRestoreButton = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-warning mx-2',
                cancelButton: 'btn btn-secondary mx-2'
            },
            buttonsStyling: false
        })
    </script>

    {{-- ! USER --}}
    @if (count($getAllUserTrashed) > 0)
        <script>
            $(document).on('click', '#restoreUserAlert', function(e) {
                e.preventDefault();
                var
                    userid = $(this).attr('data-id');
                var username = $(this).attr('data-name');
                swalRestoreButton.fire({
                    title: "Restore user " +
                        username + " ?", // (" + userid + ")
                    text: "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Restore',
                    cancelButtonText: 'Batalkan',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "/admin/data-pengguna/restore/" + userid + ""
                    } else(
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    )
                })
            })

            $(document).on('click', '#restoreAllUserAlert', function(e) {
                e.preventDefault();
                swalRestoreButton.fire({
                    title: "Restore Semua User dari Trash ?",
                    //  (" + userid + ")
                    text: "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Restore',
                    cancelButtonText: 'Batalkan',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "admin/data-pengguna/restore/"
                    } else(
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    )
                })
            })
            $(document).on('click', '#deleteUserAlert', function(e) {
                e.preventDefault();
                var
                    userid = $(this).attr('data-id');
                var username = $(this).attr('data-name');
                swalDeleteButton.fire({
                    title: "Hapus user " +
                        username + " secara Permanen ?", // (" + userid + ")
                    text: " Data tidak dapat dikembalikan setelahnya.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batalkan',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "/admin/force-destroy/data-pengguna/" + userid + ""
                    } else(
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    )
                })
            })

            $(document).on('click', '#deleteAllUserAlert', function(e) {
                e.preventDefault();
                swalDeleteButton.fire({
                    title: "Hapus Semua User dari Trash secara Permanen ?",
                    //  (" + userid + ")
                    text: "Data tidak dapat dikembalikan setelahnya.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batalkan',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "/admin/force-destroy/data-pengguna/"
                    } else(
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    )
                })
            })
        </script>
    @endif

    {{-- ! PERIODE --}}
    @if (count($getAllPeriodeTrashed) > 0)
        <script>
            $(document).on('click', '#restorePeriodeAlert', function(e) {
                e.preventDefault();
                var periodeid = $(this).attr('data-id');
                swalRestoreButton.fire({
                    title: "Restore periode " + periodeid + " ?",
                    text: "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Restore',
                    cancelButtonText: 'Batalkan',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "/restore-periode/" + periodeid + ""
                    } else(
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    )
                })
            })

            $(document).on('click', '#deletePeriodeAlert', function(e) {
                e.preventDefault();
                var periodeid = $(this).attr('data-id');
                swalDeleteButton.fire({
                    title: "Hapus data " + periodeid + " secara Permanen ?",
                    text: "Data tidak dapat dikembalikan setelahnya.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batalkan',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "/force-destroy-periode/" + periodeid + ""
                    } else(
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    )
                })
            })

            $(document).on('click', '#restoreAllPeriodeAlert', function(e) {
                e.preventDefault();
                var periodeid = $(this).attr('data-id');
                swalRestoreButton.fire({
                    title: "Restore Semua Periode dari Trash ?",
                    text: "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Restore',
                    cancelButtonText: 'Batalkan',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "/restore-periode/"
                    } else(
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    )
                })
            })

            $(document).on('click', '#deleteAllPeriodeAlert', function(e) {
                e.preventDefault();
                var periodeid = $(this).attr('data-id');
                swalDeleteButton.fire({
                    title: "Hapus Semua Periode dari Trash secara Permanen ?",
                    text: "Data tidak dapat dikembalikan setelahnya.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batalkan',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "/force-destroy-periode/"
                    } else(
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    )
                })
            })
        </script>
    @endif


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
            }).buttons().container().appendTo('#tableperiode_wrapper .col-md-6:eq(0)');
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
@endsection
