@extends('view-admin.layouts.app')
@section('titlepage')
    <title>Data Pengguna</title>
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
                <div class="mb-3 ml-auto mr-3">
                    <a href="/admin/data-pengguna" class=" ml-2 btn btn-secondary text-nowrap"><i
                            class="fa-solid fa-address-card"></i>&nbsp; Card View</a>
                </div>
                <div class="col-12">
                    <div class="card rounded-md myshadow">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-12">
                                    <h3 class="card-title mt-2">Data Pengguna</h3>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tableuser" class="table table-striped table-hover">
                                <thead>
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
                                        @foreach ($getAllUser as $user)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $user->id }}</td>
                                                <td><img src="/pictures/{{ $user->picture == '' ? 'noimg.png' : $user->picture }}"
                                                        class="rounded" alt="User Image" height="120px" width="90px">
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
                                                        <a href="{{ route('pengguna.show', $user->id) }}" id="showUser"
                                                            class="btn btn-xs btn-primary rounded">Detail
                                                        </a>
                                                        <a href="" id="deleteUserAlert" data-id="{{ $user->id }}"
                                                            data-name="{{ $user->name }}"
                                                            class="btn btn-xs btn-danger rounded ml-2">Hapus
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
                "buttons": ["pageLength", "copy", "excel", "pdf", {
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
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-danger mx-2',
                cancelButton: 'btn btn-secondary mx-2'
            },
            buttonsStyling: false
        })

        $(document).on('click', '#deleteUserAlert', function(e) {
            e.preventDefault();
            var userid = $(this).attr('data-id');
            var username = $(this).attr('data-name');
            swalWithBootstrapButtons.fire({
                title: "Hapus user " + username + " ?",
                //  (" + userid + ")
                text: "Data tidak dapat dikembalikan setelahnya.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batalkan',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "/admin/destroy/data-pengguna/" + userid + ""
                } else(
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                )
            })
        })
    </script>
    {{-- <script>
        $(document).ready(function() {
            //edit data
            $('.edit').on("click", function() {
                var id = $(this).attr('data-id');
                $.ajax({
                    url: "{{ route('user.edit', ' + id + ') }}",
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        $('#picture').val(data.picture);
                        $('#role').val(data.role);
                        $('#name').val(data.name);
                        $('#email').val(data.email);
                        $('#editusermodal').modal('show');
                    }
                });
            });

        });
    </script> --}}
@endsection
