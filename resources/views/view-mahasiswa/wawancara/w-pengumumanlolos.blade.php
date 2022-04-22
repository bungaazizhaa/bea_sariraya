<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Selamat Anda Lolos Seleksi Wawancara</h1>
    <h2>Berikut adalah Soal Penugasan Anda</h2>
    @auth
        <a href="{{ url('/home') }}" class="btn-sm text-gray-700 dark:text-gray-500 underline">Kembali ke Home</a>
    @endauth
</body>

</html>
