<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/images') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="icon" href="{{ asset('assets/images/bunga2.png') }}" type="image/x-icon">

</head>

<body>


    <!-- Banner -->
    <div class="banner-regist">
        <img src="{{ asset('assets/images/regis.png') }}" alt="">
        <div class="txt">
            <div class="row row-kontak mb-4">
                <div class="col-12 col-md-6  text-md-left text-center d-flex my-auto">
                    <div class="welcom ml-md-5 mx-auto">
                        <p>Pendaftaran Beasiswa Sariraya Japan 2022</p>
                        <h1>SUDAH DIBUKA</h1>
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="card regis">
                        <div class="card-body">
                            <form action="/contact/insertcontact" method="POST" enctype="multipart/form-data">
                                <center>
                                    <h4>Register</h4>
                                </center>
                                <div class="form-group">
                                    <input type="text" name="name" value="" class="form-control" id="exampleFormControlInput1" required placeholder="Nama Lengkap" />
                                </div>
                                <div class="form-group">
                                    <input type="text" name="email" value="" class="form-control" id="exampleFormControlInput1" required placeholder="NIM" />
                                </div>
                                <div class="form-group">
                                    <input type="text" name="company" value="" class="form-control" id="exampleFormControlInput1" placeholder="Asal Perguruan Tinggi" />
                                </div>
                                <div class="form-group">
                                    <input type="text" name="state" value="" class="form-control" id="exampleFormControlInput1" placeholder="Password" />
                                </div>
                                <div class="form-group">
                                    <input type="text" name="state" value="" class="form-control" id="exampleFormControlInput1" placeholder="Confirm Password" />
                                </div>
                                <center>
                                    <p>Sudah punya akun ? <a href="">Login disini.</a></p>
                                    <div class="button-submit">
                                        <button type="submit" class="btn  tombol">Register</button>
                                    </div>
                                </center>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- Akhir Banner -->



</body>

</html>