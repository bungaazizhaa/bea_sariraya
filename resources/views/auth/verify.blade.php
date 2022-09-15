@extends('layouts.app')

@section('content')
    @include('sweetalert::alert')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="card-header">Verifikasi Alamat Email <strong>{{ Auth::user()->email }}</strong>.</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                Tautan verifikasi baru telah dikirim ke alamat email Anda.
                            </div>
                        @endif
                        Silahkan cek Kotak Masuk email Anda (termasuk Folder Spam),<br>dan lakukan verifikasi Email.<br><br>
                        Jika Anda tidak menerima email,
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Kirim Ulang Email Verifikasi
                            </button>.
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
