<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @include('sweetalert::alert')

    <h1>Halaman Profil</h1>
    @if (Auth::user()->picture == null)
        <p>Upload Foto Profil untuk melanjutkan ke Halaman Anda!</p>
    @endif
</body>

</html>
