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
                <div onclick="location.href='{{ route('data.pengguna') }}'" class="small-box rounded-md">
                    <div class="inner">
                        <h3 class="mb-1 mt-2">{{ count($getAllUser->where('role', '=', 'mahasiswa')) }} Akun</h3>
                        <p class="mb-1">Mahasiswa.</p>
                    </div>
                    <div class="icon">
                        <i class="ion">
                            <ion-icon class="ion-icon" name="people"></ion-icon>
                        </i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div onclick="location.href='{{ route('index.periode') }}'" class="small-box rounded-md">
                    <div class="inner">
                        <h3 class="mb-1 mt-2">{{ count($getAllPeriode) }} Periode</h3>
                        <p class="mb-1">Telah dibuat.</p>
                    </div>
                    <div class="icon">
                        <i class="ion">
                            <ion-icon name="school"></ion-icon>
                        </i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div onclick="location.href='{{ route('index.periode') }}'" class="small-box rounded-md">
                    <div class="inner">
                        <h3 class="mb-1 mt-2">{{ count($getAllPeriode->where('status_png', '=', 'Selesai')) }}
                            Periode
                        </h3>
                        <p class="mb-1">Telah Selesai.</p>
                    </div>
                    <div class="icon">
                        <i class="ion">
                            <ion-icon name="checkmark-circle"></ion-icon>
                        </i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div onclick="location.href='{{ route('periode', isset($getPeriodeAktif->name) ? $getPeriodeAktif->name : '') }}'"
                    class="small-box rounded-md">
                    <div class="inner">
                        <h3 class="mb-1 {{ isset($getPeriodeAktif->name) ? 'mt-2' : 'mt-3' }}"
                            style="{{ isset($getPeriodeAktif->name) ? '' : 'font-size: 28px!important;' }}">
                            {{ isset($getPeriodeAktif->name) ? ucfirst($getPeriodeAktif->name) : 'Tidak Ada' }}
                        </h3>
                        <p class="mb-1">Periode Aktif.</p>
                    </div>
                    <div class="icon">
                        <i class="ion">
                            <ion-icon name="school"></ion-icon>
                        </i>
                    </div>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
@endsection
