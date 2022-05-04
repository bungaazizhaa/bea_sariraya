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
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div onclick="location.href='{{ route('data.pengguna') }}'" class="small-box bg-info rounded-md myshadow">
                    <div class="inner">
                        <h3 class="mb-1">{{ count($getAllUser->where('role', '=', 'mahasiswa')) }}</h3>
                        <p class="mb-1">Jumlah Akun<br>Mahasiswa</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('data.pengguna') }}" class="small-box-footer rounded-bottom-md">More
                        info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div onclick="location.href='{{ route('data.pengguna') }}'" class="small-box bg-info rounded-md myshadow">
                    <div class="inner">
                        <h3 class="mb-1">{{ count($getAllUser->where('role', '=', 'mahasiswa')) }}</h3>
                        <p class="mb-1">Jumlah Akun<br>Mahasiswa</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('data.pengguna') }}" class="small-box-footer rounded-bottom-md">More
                        info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div onclick="location.href='{{ route('data.pengguna') }}'" class="small-box bg-info rounded-md myshadow">
                    <div class="inner">
                        <h3 class="mb-1">{{ count($getAllUser->where('role', '=', 'mahasiswa')) }}</h3>
                        <p class="mb-1">Jumlah Akun<br>Mahasiswa</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('data.pengguna') }}" class="small-box-footer rounded-bottom-md">More
                        info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div onclick="location.href='{{ route('data.pengguna') }}'" class="small-box bg-info rounded-md myshadow">
                    <div class="inner">
                        <h3 class="mb-1">{{ count($getAllUser->where('role', '=', 'mahasiswa')) }}</h3>
                        <p class="mb-1">Jumlah Akun<br>Mahasiswa</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('data.pengguna') }}" class="small-box-footer rounded-bottom-md">More
                        info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>

    <script>
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-danger mx-2',
                cancelButton: 'btn btn-secondary mx-2'
            },
            buttonsStyling: false
        })

        $(document).on('click', '#resetBeasiswaAlert', function(e) {
            e.preventDefault();
            swalWithBootstrapButtons.fire({
                title: "Anda yakin ingin mereset Beasiswa ?",
                //  (" + userid + ")
                text: "Data Pengguna, Administrasi, Wawancara, Penugasan dan Periode akan dihapus.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batalkan',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("formResetBeasiswa").submit();
                } else(
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                )
            })
        })
    </script>

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
