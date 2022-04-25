<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<style>
    .text-center {
        text-align: center
    }

</style>

<body class="text-center">
    <h1 class="text-gray-200">{{ $info }}</h1>
    @isset($tglpengumuman)
        <h2 class="text-gray-200">Hasil Akan Diumumkan Pada Tanggal :</h2>
        <h1>{{ \Carbon\Carbon::parse($tglpengumuman)->isoFormat('dddd, D MMMM Y') }}</h1>
        <h3>( Di Jam Kerja )</h3>
    @endisset
    @auth
        <a href="{{ url('/my-profile') }}" class="btn-sm text-gray-700 dark:text-gray-500 underline">Kembali ke Profil
            Anda</a>
    @endauth
    {{-- <h3>{{ \Carbon\Carbon::parse($getPeriodeAktif->tp_adm)->diffForHumans() }}</h3> --}}
</body>

</html>
