@extends('view-admin.layouts.app')
@section('titlepage')
    <title>Data Pengguna</title>
@endsection
@section('title')
    <h4 class="m-0 p-0 text-truncate" style="white-space: nowrap;
                                        overflow: hidden;text-overflow: ellipsis;">Data Pengguna</h4>
@endsection
@section('content')
    <div class="container">
        <div class="container-fluid">
            <!-- Main content -->
            <div class="row justify-content-end">
                <div class="col-12 col-md-5">
                    <form action="/admin/data-pengguna">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Cari Nama, atau data yang lainnya."
                                aria-label="Recipient's username" aria-describedby="basic-addon2" name="search"
                                value="{{ request('search') }}" autofocus>
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="submit"><i class="fa-solid fa-magnifying-glass"></i>
                                    Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                @if ($getAllUser->count())
                    @foreach ($getAllUser as $user)
                        <div class="col-12 col-md-6">
                            <div class="card rounded-md myshadow">
                                <div class="row px-2">
                                    <img src="/pictures/{{ $user->picture == '' ? 'noimg.png' : $user->picture }}"
                                        onclick="location.href='{{ route('pengguna.show', $user->id) }}'"
                                        class="rounded-md image-previewer m-2" alt="User Image" width="120px"
                                        height="160px">
                                    <ul class="list-unstyled mt-2 float-right" style="width:calc(100% - 140px);">
                                        <li class="p-0 ml-2 font-weight-normal pt-2 text-truncate h5 text-success">
                                            {{ $user->name }}
                                            @if ($user->role === 'admin')
                                                <span class="float-right mr-2">
                                                    <i class="fa-solid fa-user-shield text-warning"></i>
                                                </span>
                                            @endif
                                        </li>
                                        <p class="m-0 ml-2 font-weight-light text-truncate"><a class=" text-light"
                                                href="">{{ $user->email }}</a>
                                        </p>
                                        <p class="m-0 ml-2 font-weight-light text-truncate">
                                            {{ ucfirst($user->role) }}</p>
                                        <p class="m-0 ml-2 mt-2 font-weight-normal text-truncate">
                                            {{ $user->role == 'mahasiswa' ? $user->univ->nama_universitas : '' }}</p>
                                        <p class="m-0 ml-2 font-weight-light text-truncate">
                                            {{ $user->role == 'mahasiswa' ? $user->prodi->nama_prodi : '' }}</p>
                                        {{-- <p class="m-0 mt-2 font-weight-light text-truncate small"><a
                                                href="{{ route('send.maillolos', $user->email) }}">{{ $user->email }}</a>
                                        </p> --}}
                                    </ul>
                                </div>
                                <div class="card-footer rounded-bottom-md p-2 d-flex">
                                    <div class="mb-0 mr-2"><span><small><span class="text-muted"> Created at :
                                                </span>{{ $user->created_at->format('D M Y - H:i:s') }}</small></span>
                                    </div>
                                    <div class="mr-0 ml-auto">
                                        <a href="{{ route('pengguna.show', $user->id) }}" id="showUser"
                                            class="btn btn-xs rounded bg-dark text-info px-3 mr-2">Detail
                                        </a>
                                        {{-- <a href="{{ route('pengguna.edit', $user->id) }}" id="editUserAlert"
                                            class="btn btn-xs rounded bg-dark text-warning">
                                            Edit
                                        </a>
                                        <button type="button" class="btn btn-xs rounded btn-info edit"
                                            data-id="{{ $pengguna->id }}" data-toggle="modal">
                                            Edit
                                        </button> --}}
                                        <a href="" id="deleteUserAlert" data-id="{{ $user->id }}"
                                            data-name="{{ $user->name }}"
                                            class="btn btn-xs rounded bg-dark text-danger">Hapus
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <p class="h4">User tidak Ada.</p>
                    </div>
                @endif
                <div class="col-12 mt-3">
                    <div class="d-flex justify-content-center">
                        {{ $getAllUser->links() }}
                    </div>
                </div>
            </div>
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
                "lengthMenu": [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"]
                ],
                "buttons": ["pageLength", "copy", "excel", "pdf", {
                    extend: 'print',
                    text: 'Print',
                    exportOptions: {
                        modifier: {
                            page: 'current'
                        }
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
