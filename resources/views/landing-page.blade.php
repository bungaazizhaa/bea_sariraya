    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Landing Page</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link rel="icon" href="{{ asset('assets/images/bunga2.png') }}" type="image/x-icon">

    </head>

    <body>
        @include('sweetalert::alert')
        <!-- Banner -->
        <div class="banner">
            <img src="{{ asset('assets/images/banner.png') }}" alt="">
        </div>
        <!-- Akhir Banner -->

        <div class="container">
            @if ($getPeriodeAktif == null)
            @else
            <!-- Section Tombol Pendaftaran -->
            <div class="tomboldaftar">
                <center>
                    <p class="mt-4">Klik tombol di bawah ini untuk mengakses pendaftaran</p>
                    @guest
                    @if (Route::has('login'))
                    <a class="btn btn-success rounded-pill" href="{{ route('login') }}">{{ __('Login') }}</a>
                    @endif

                    @if (Route::has('register') && isset($getPeriodeAktif) ? !$getPeriodeAktif->status_adm == 'Selesai' : '')
                    <a class="btn btn-success rounded-pill" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                    @else
                    <a class="btn btn-outline-success rounded-pill " href="{{ Auth::user()->role == 'admin' ? '/dashboard' : '/my-profile' }}">
                        {{ Auth::user()->name }}
                    </a>
                    @endguest
                    </ul>
                </center>
            </div>
            <!-- Akhir Section Tombol Pendaftaran -->
            @endif
            <!-- Section Timeline -->
            <div class="timeline">
                <center>
                    <h2><b> Timeline Beasiswa</b></h2>
                    @if ($getPeriodeAktif == null)
                    <div class=" py-1 my-2 p-md-0 m-md-0">
                        <center class="text-gray-200 h4 pt-4 mt-4 mb-5 pb-3"> Maaf. Saat ini sedang tidak ada Program
                            Penerimaan Beasiswa
                            Sariraya.
                        </center>
                    </div>
                    @else
                    <div class="row mb-lg-2 mx-lg-5 mx-sm-2 my-sm-2">
                        <div class="col-sm-3 mt-3">
                            <div class="card mycard1 text-center">
                                <img class="card-img-top" src="{{ asset('assets/images/1.png') }}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Pendaftaran & Submit Administrasi</h5>
                                    <p>{{ isset($getPeriodeAktif) ? $getPeriodeAktif->tm_adm->translatedFormat('d F Y - ') . $getPeriodeAktif->ta_adm->translatedFormat('d F Y') : '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 mt-3">
                            <div class="card mycard1 text-center">
                                <img class="card-img-top" src="{{ asset('assets/images/3.png') }}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Pengumuman Hasil Seleksi Administrasi</h5>
                                    <p>{{ isset($getPeriodeAktif) ? $getPeriodeAktif->tp_adm->translatedFormat('d F Y') : '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 mt-3">
                            <div class="card mycard1 text-center">
                                <img class="card-img-top" src="{{ asset('assets/images/4.png') }}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Seleksi Wawancara</h5>
                                    <p>{{ isset($getPeriodeAktif) ? $getPeriodeAktif->tm_wwn->translatedFormat('d F Y - ') . $getPeriodeAktif->ta_wwn->translatedFormat('d F Y') : '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 mt-3">
                            <div class="card mycard1 text-center">
                                <img class="card-img-top" src="{{ asset('assets/images/5.png') }}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Pengumuman Hasil Seleksi Wawancara</h5>
                                    <p>{{ isset($getPeriodeAktif) ? $getPeriodeAktif->tp_wwn->translatedFormat('d F Y') : '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-lg-2 mb-lg-5 mx-lg-5 mx-sm-2 my-sm-2 d-flex justify-content-center">
                        <div class="col-sm-3 mt-3">
                            <div class="card mycard1 text-center">
                                <img class="card-img-top" src="{{ asset('assets/images/7.png') }}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Submit Penugasan</h5>
                                    <p>{{ isset($getPeriodeAktif) ? $getPeriodeAktif->tm_png->translatedFormat('d F Y - ') . $getPeriodeAktif->ta_png->translatedFormat('d F Y') : '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 mt-3">
                            <div class="card mycard1 text-center">
                                <img class="card-img-top" src="{{ asset('assets/images/9.png') }}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Pengumuman Akhir</h5>
                                    <p>{{ isset($getPeriodeAktif) ? $getPeriodeAktif->tp_png->translatedFormat('d F Y') : '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 mt-3">
                            <div class="card mycard1 text-center mb-md-0 mb-5">
                                <img class="card-img-top" src="{{ asset('assets/images/6.png') }}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Pemberian Beasiswa</h5>
                                    <p>{{ $getPeriodeAktif == null ? '-' : 'Maret - Agustus 2022' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </center>
            </div>
            <!-- Akhir Section Timeline -->

            <!-- Section Apa Itu Beasiswa Sariraya -->
            <div class="beasariraya">
                <center>
                    <h2><b>Apa Itu Beasiswa Sariraya</b> </h2>
                </center>
                <div class="row sariraya">
                    <div class="col-lg-6 foto">
                        <img src="{{ asset('assets/images/pos1.jpeg') }}" alt="" class="img-fluid mt-1 mb-4" />
                    </div>
                    <div class="col-lg-6">
                        <p>Beasiswa Sariraya Japan adalah beasiswa yang diberikan oleh perusahaan Sariraya Co., Ltd
                            bagi
                            mahasiswa berprestasi yang memenuhi kriteria, sebagai bentuk tanggung jawab sosial
                            perusahaan.</p>
                        <p>Persyaratan: <br>
                            - Warga Negara Indonesia <br>
                            - Mahasiswa S1/D4 minimal semester 6 Perguruan Tinggi di Indonesia yang terakreditasi
                            minimal B dengan program studi
                            (akreditasi minimal B): <br>
                            - Desain Komunikasi Visual <br>
                            - Desain Grafis, Teknik Informatika <br>
                            - Teknologi Informasi <br>
                            - Sistem Informasi <br>
                            - Sistem Komputer <br>
                            - Ilmu Komputer <br>
                            - Manajemen Pemasaran
                            - Seni Rupa <br>
                            - IPK minimal 3.0 (skala 4.0) <br>
                            - Memiliki kemampuan pengembangan website dan/atau desain grafis
                        </p>
                    </div>
                </div>
                <center>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card mycard1 bea mb-4">
                                <h5 class="text-center"> Keuntungan Beasiswa :</h5>
                                <p class="text-left">- Uang saku Rp500,000 per bulan selama 1 semester. <br>
                                    - Business Coaching bersama CEO Sariraya Co., Ltd. <br>
                                    - Mentoring beasiswa luar negeri. <br>
                                    - Pengembangan diri dan karakter.
                                </p>
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="card mycard1 bea text-left">
                                <h5 class="text-center">Syarat Administrasi :</h5>
                                <p>- Scan Kartu Tanda Mahasiswa <br>
                                    - Scan Transkrip Nilai <br>
                                    - Portofolio pengembangan website dan/atau desain grafis <br>
                                    - Esai 1000 kata: Strategi Pemanfaatan Peluang Pasar Produk Halal di Jepang</p>
                            </div>
                        </div>
                    </div>
                </center>
            </div>
            <!-- Akhir Section Apa Itu Beasiswa Sariraya -->

            <!-- Section Sariraya -->
            <div class="tentangsariraya">
                <center>
                    <h2> <b>Tentang Sariraya</b> </h2>
                </center>
                <div class="row sariraya">
                    <div class="col-lg-6">
                        <p>Sariraya Co., Ltd merupakan sebuah perusahaan Indonesia yang menjadi pioneer bisnis
                            makanan
                            Halal di Jepang sejak tahun 2005.
                            <br> Saat ini Sariraya Co., Ltd telah memiliki beberapa unit usaha
                            di antaranya :
                            <br> produksi tempe, bakso halal dan sambal pecel,toko retail produk-produk makanan
                            halal
                            japanhalal_net , restoran halal, Halal Fried Chicken sariraya.hfcjapan , Halal Pizza
                            Station
                            pizzastation.jp dan impor serta distribusi produk halal dari berbagai negara terutama
                            Asia
                            Tenggara khususnya Indonesia ke Jepang.
                        </p>
                        <p>Cek untuk informasi lebih lanjut mengenai perusahaan di website resmi Sariraya Co., Ltd
                            <a href="http://sariraya.com"> (Sariraya.com)</a>
                        </p>
                    </div>

                    <div class="col-lg-6 foto">
                        <img src="{{ asset('assets/images/sariraya.png') }}" alt="" class="img-fluid mt-1" />
                    </div>
                </div>
            </div>
            <!-- Akhir Section Sariraya -->

            <!-- Section FAQ -->
            <div class="faq">
                <center>
                    <h2 class="mb-4"> <b>FAQ</b> </h2>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card mycard text-left bea mb-4">
                                <h5>Q : Apakah beasiswa ini berlaku untuk semua jurusan ?</h5>
                                <p>A : Mohon maaf, tidak bisa. Beasiswa ini hanya terbuka bagi mahasiswa jurusan
                                    tersebut saja.
                                </p>

                                <h5>Q : Apakah beasiswa ini terbuka untuk alumni / yang sudah lulus ?</h5>
                                <p>A : Tidak, beasiswa ini hanya diperuntukkan bagi Mahasiswa S1/D4 yang masih aktif
                                    kuliah minimal di semester 6.</p>

                                <h5>Q : Dimana saya akan mengetahui pengumuman kelulusan di setiap seleksi ?</h5>
                                <p>A : Pengumuman akan diberitahuan melalui website ini, dan pastikan anda sudah
                                    login
                                    terlebih dahulu untuk melihat status kelulusan anda.</p>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card mycard text-left bea">
                                <h5>Q : Apakah pendaftaran beasiswa ini berbayar ?</h5>
                                <p>A : Tidak, beasiswa ini tidak dipungut biaya apapun (gratis).</p>

                                <h5>Q : Apakah ada ketentuan dalam penulisan esai untuk syarat beasiswa ini ?</h5>
                                <p>A : Tidak ada ketentuan khusus, yang penting formatnya rapi dan terbaca jelas,
                                    konten
                                    sesuai tema dan jumlah kata maksimal 1000 kata saja.</p>

                                <h5>Q : Kemana saya harus menghubungi apabila ada hal yang ingin saya tanyakan ?
                                </h5>
                                <p>A : Anda bisa menghubungi kontak person di bawah ini dan juga mengunjungi
                                    media sosial sariraya yaitu instagram
                                    untuk mendapatkan info terupdate mengenai Beasiswa Sariraya ini.</p>
                            </div>
                        </div>
                    </div>
                </center>
            </div>
            <!-- Akhir Section FAQ -->

            <!-- Section Kontak -->
            <div class="kontak">
                <center>
                    <h2 class="mb-4"><b>Contact Person</b> </h2>
                    <p>WhatsApp: +81-70-1304-5868</p>
                    <p>Email: info@sariraya.com</p>
                </center>
            </div>
            <!-- Akhir Section Kontak -->
        </div>

        <!-- Footer -->
        <footer class="pt-3 pt-3 pb-1 border-top bg-dark">
            <div class="text-center bg-dark text-white">
                <p>&copy; Sariraya 2022</p>
            </div>
        </footer>


    </body>

    </html>