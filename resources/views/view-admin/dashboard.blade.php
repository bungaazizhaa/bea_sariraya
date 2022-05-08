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
                <div onclick="location.href='{{ route('data.pengguna') }}'" class="small-box rounded-md"
                    style="height: 118px;">
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
                <div onclick="location.href='{{ route('index.periode') }}'" class="small-box rounded-md"
                    style="height: 118px;">
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
                <div onclick="location.href='{{ route('index.periode') }}'" class="small-box rounded-md"
                    style="height: 118px;">
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
                    class="small-box rounded-md" style="height: 118px;">
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

        @if (count($getAllPeriode) > 0)
            <div class="row">
                @foreach ($getAllPeriode as $periode)
                    <div class="col-12">
                        <!-- small box -->
                        <div onclick="location.href='{{ route('periode', $periode->name) }}'"
                            class="small-box rounded-md">
                            <div class="inner mb-0">
                                <h4 class="text-left mb-0 font-weight-bold">
                                    {{ isset($periode->name) ? ucfirst($periode->name) : '' }}
                                </h4>

                                <table class="table-responsive mt-2 text-nowrap">
                                    <tbody>
                                        <tr>
                                            <td class="h5 mr-5 pr-5 pb-3 pb-md-1" style="width: 220px; line-height: 20px;">
                                                Pendaftar :
                                                {{ $getAllAdministrasi->where('periode_id', '=', $periode->id_periode)->count() }}
                                            </td>
                                            <td class="h5 mr-5 pr-5 pb-3 pb-md-1" style="width: 270px; line-height: 20px;">
                                                Lolos
                                                Administrasi :
                                                {{ $getAllAdministrasi->where('periode_id', '=', $periode->id_periode)->where('status_adm', '=', 'lolos')->count() }}
                                            </td>
                                            <td class="h5 mr-5 pr-5 pb-3 pb-md-1" style="width: 270px; line-height: 20px;">
                                                Lolos
                                                Wawancara :
                                                @php
                                                    $administrasiOpenned = App\Models\Administrasi::where('periode_id', '=', $periode->id_periode)
                                                        ->where('status_adm', '=', 'lolos')
                                                        ->pluck('id');
                                                    $getAllWwnLolos = App\Models\Wawancara::whereIn('administrasi_id', $administrasiOpenned)
                                                        ->where('status_wwn', '=', 'lolos')
                                                        ->count();
                                                @endphp
                                                {{ $getAllWwnLolos > 0 ? $getAllWwnLolos : '0' }}
                                            </td>
                                            <td class="h5 mr-5 pr-5 pb-3 pb-md-1" style="width: 220px; line-height: 20px;">
                                                Diterima :
                                                @php
                                                    $wawancaraOpenned = App\Models\Wawancara::whereIn('administrasi_id', $administrasiOpenned)->pluck('id');
                                                    $getAllPngLolos = App\Models\Penugasan::whereIn('wawancara_id', $wawancaraOpenned)
                                                        ->where('status_png', '=', 'lolos')
                                                        ->count();
                                                @endphp
                                                {{ $getAllPngLolos > 0 ? $getAllPngLolos : '0' }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="icon">
                                <i class="ion" style="top:0; height:84px">
                                    <ion-icon name="chevron-forward-outline"></ion-icon>
                                </i>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        @else
            <div class="row">
                <div class="col-12">
                    <div class="bg-dark rounded-md d-flex justify-content-center flex-column" style="height: 200px">
                        <div class="text-center">
                            Anda belum membuat Periode.
                        </div>
                    </div>
                </div>
            </div>
        @endif
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
