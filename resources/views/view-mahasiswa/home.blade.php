@include('sweetalert::alert')
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Beranda Anda') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (Auth::user()->picture == null)
                            <p>Upload Foto Profil untuk melanjutkan ke Halaman Anda!</p>
                        @else
                            @if ($getPeriodeAktif->status_adm == null)
                                <a href="/tahap-administrasi" class="btn btn-primary">Tahap Administrasi
                                </a>
                            @elseif ($getPeriodeAktif->status_adm == 'Selesai' && $getPeriodeAktif->status_wwn == null)
                                <a href="/tahap-wawancara" class="btn btn-primary">Tahap Wawancara
                                </a>
                            @elseif ($getPeriodeAktif->status_wwn == 'Selesai' && $getPeriodeAktif->status_png == null)
                                <a href="/tahap-penugasan" class="btn btn-primary">Tahap Penugasan
                                </a>
                            @elseif ($getPeriodeAktif->status_wwn == 'Selesai' && $getPeriodeAktif->status_png == 'Selesai')
                                <a href="/tahap-penugasan" class="btn btn-primary">Lihat Pengumuman Final
                                </a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
