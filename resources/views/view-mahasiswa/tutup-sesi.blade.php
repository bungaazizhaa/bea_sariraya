@extends('layouts.app')

@section('content')
    <div class="container mt-0 test">

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <h2 class="text-gray-200 mt-2 mt-md-5">{{ $info }}</h2>

        @isset($tglpengumuman)
            <p class="h4 mt-5 text-gray-200">Hasil Akan Diumumkan pada Hari :</p>
            <p class="h3 font-weight-bold">{{ \Carbon\Carbon::parse($tglpengumuman)->isoFormat('dddd, D MMMM Y') }}</p>
            <p class="h4 mb-4">di Jam Kerja.</p>
        @endisset

        @auth
            <a href="{{ url('/my-profile') }}" class="btn btn-outline-secondary mt-3 mb-4 mb-md-3"><i
                    class="fa-solid fa-angle-left"></i>
                Kembali ke
                Profil Anda</a>
        @endauth
    </div>
@endsection
