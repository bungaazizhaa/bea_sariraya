@extends('view-admin.layouts.app')
@section('titlepage')
    <title>Profil Pengguna</title>
@endsection
@section('title')
    <h4 class="m-0 p-0">Profil Pengguna {{ $getUser->name }}</h4>
@endsection
@section('content')
    <div class="container">
        <div class="container-fluid">
            <!-- Main content -->
            <div class="row">
                <div class="col-md-3">
                    <div class="card rounded-md myshadow">
                        <div class="card-header text-white bg-dark text-center rounded-top-md">
                            <p class="card-title">Foto</p>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body d-flex mx-auto">
                            <img src="/pictures/{{ $getUser->picture == '' ? 'noimg.png' : $getUser->picture }}"
                                class="rounded img-fluid image-previewer" alt="User Image" height="400px" width="300px">
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>


                <div class="col-md-9">
                    <div class="card rounded-md myshadow">
                        <div class="card-header text-white bg-dark text-center rounded-top-md">
                            <p class="card-title">Profil Mahasiswa</p>
                        </div><!-- /.card-header -->
                        <!-- Table row -->
                        <div class="row m-2">
                            <div class="col-12 table-responsive">
                                <table class="table table-hover mb-0">
                                    <tbody>
                                        <tr>
                                            <th style="width: 20%">Nama</td>
                                            <th style="width: 2%">:</td>
                                            <th style="width: 78%">{{ $getUser->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email Address</th>
                                            <th>:</th>
                                            <th>{{ $getUser->email }}</th>
                                        </tr>
                                        <tr>
                                            <td>NIM</td>
                                            <td>:</td>
                                            <td>{{ $getUser->nim }}</td>
                                        </tr>
                                        <tr>
                                            <td>ID User</td>
                                            <td>:</td>
                                            <td>{{ $getUser->id }}</td>
                                        </tr>
                                        <tr>
                                            <td>Email Terverifikasi</td>
                                            <td>:</td>
                                            <td>{{ $getUser->email_verified_at == '' ? '' : $getUser->email_verified_at->isoFormat('dddd, D MMMM Y - hh:mm:ss') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Akun Dibuat</td>
                                            <td>:</td>
                                            <td>{{ $getUser->created_at == '' ? '' : $getUser->created_at->isoFormat('dddd, D MMMM Y - hh:mm:ss') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Akun Diperbarui</td>
                                            <td>:</td>
                                            <td>{{ $getUser->updated_at == '' ? '' : $getUser->updated_at->isoFormat('dddd, D MMMM Y - hh:mm:ss') }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-12">
                    <div class="card rounded-md myshadow">
                        <div class="card-header text-white bg-dark text-center rounded-top-md">
                            <p class="card-title">Riwayat Beasiswa</p>
                        </div><!-- /.card-header -->
                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="m-1 p-3">
                                    @if (isset($getAdministrasiUser))
                                        @foreach ($getAdministrasiUser as $admUser)
                                            <div class="d-flex mb-3 rounded-md myshadow p-3"
                                                style="background-color:#414a53; overflow-x: auto; white-space: nowrap;">
                                                <div class="h5 pt-2 mr-5">
                                                    {{ ucfirst($admUser->periode->name) }}</th>
                                                </div>
                                                <div class="h6 pt-2 mt-1 mr-2">Administrasi :</div>
                                                <div
                                                    class="mr-5 my-2 py-2 px-3 badge {{ $admUser->status_adm == 'lolos' ? 'badge-success' : '' }} {{ $admUser->status_adm == 'gagal' ? 'badge-danger' : '' }} {{ $admUser->status_adm == null ? 'badge-secondary' : '' }}">
                                                    {{ !isset($admUser->status_adm) ? 'Unset' : '' }}
                                                    {{ ucfirst($admUser->status_adm) }}
                                                </div>
                                                <div class="h6 pt-2 mt-1 mr-2">Wawancara :</div>
                                                <div
                                                    class="mr-5 my-2 py-2 px-3 badge
                                                        {{ !isset($admUser->wawancara->status_wwn) ? 'badge-secondary' : '' }}
                                                    {{ isset($admUser->wawancara->status_wwn) && $admUser->wawancara->status_wwn == 'lolos' ? 'badge-success' : '' }}
                                                    {{ isset($admUser->wawancara->status_wwn) && $admUser->wawancara->status_wwn == 'gagal' ? 'badge-danger' : '' }}">
                                                    {{ !isset($admUser->wawancara->status_wwn) ? 'Unset' : '' }}
                                                    {{ isset($admUser->wawancara->status_wwn) && $admUser->wawancara->status_wwn == 'lolos' ? 'Lolos' : '' }}
                                                    {{ isset($admUser->wawancara->status_wwn) && $admUser->wawancara->status_wwn == 'gagal' ? 'Gagal' : '' }}
                                                </div>
                                                <div class="h6 pt-2 mt-1 mr-2">Final :</div>
                                                <div
                                                    class="mr-5 my-2 py-2 px-3 badge
                                                    {{ !isset($admUser->wawancara->penugasan->status_png) ? 'badge-secondary' : '' }}
                                                    {{ isset($admUser->wawancara->penugasan->status_png) && $admUser->wawancara->penugasan->status_png == 'lolos' ? 'badge-success' : '' }}
                                                    {{ isset($admUser->wawancara->penugasan->status_png) && $admUser->wawancara->penugasan->status_png == 'gagal' ? 'badge-danger' : '' }}">
                                                    {{ !isset($admUser->wawancara->penugasan->status_png) ? 'Unset' : '' }}
                                                    {{ isset($admUser->wawancara->penugasan->status_png) && $admUser->wawancara->penugasan->status_png == 'lolos' ? 'Lolos' : '' }}
                                                    {{ isset($admUser->wawancara->penugasan->status_png) && $admUser->wawancara->penugasan->status_png == 'gagal' ? 'Gagal' : '' }}
                                                </div>
                                                {{-- <a class="btn btn-primary btn-sm m-2 px-3 rounded" href="#">
                                                    Detail
                                                </a>
                                                <a class="btn btn-info btn-sm m-2 px-3 rounded" href="#">
                                                    Edit
                                                </a> --}}
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </div>
    </div>
@endsection
