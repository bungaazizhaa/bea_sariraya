@extends('view-admin.layouts.app')
@section('titlepage')
    <title>Panduan Aplikasi Beasiswa Sariraya</title>
@endsection
@section('title')
    <h4 class="m-0 p-0">Panduan Aplikasi</h4>
@endsection
@section('content')
    <div class="container-fluid px-3">
        <!-- Main content -->
        <div class="row">
            <div class="col-12">
                <div class="card rounded-md myshadow">
                    <div class="card-header">
                        <p class="h4">A. Cara Membuat Program Beasiswa Baru</p>
                    </div>

                    <div class="card-body">

                        <div id="accordion">
                            <div class="card rounded-md myshadow">
                                <div class="card-header rounded-bottom-md p-0">
                                    <a class="h5 d-block w-100 p-3 text-white mb-0" data-toggle="collapse"
                                        href="#collapseA1">
                                        1. Membuat Periode Beasiswa Baru
                                    </a>
                                </div>
                                <div id="collapseA1" class="collapse hide" data-parent="#accordion">
                                    <div class="card-body">
                                        - Pergi ke Menu <b class="text-info">&nbsp;Periode Beasiswa &nbsp;<i
                                                class="fa-solid fa-angle-right text-white"></i>&nbsp; Tambah /
                                            Hapus.</b>
                                        <br>- Tekan tombol <b class="text-info">&nbsp;Tambah
                                            Periode&nbsp;</b> di
                                        sebelah
                                        kanan atas.
                                        <br>- Isi ID dengan format "<b class="text-info">X</b>" dan Nama Periode dengan
                                        format
                                        "<b class="text-info">batch-X</b>". <b>X</b>
                                        adalah Angka.
                                        <br>- Isi Seluruh Tanggal dengan benar.
                                        <br>- Contoh Pengisian:
                                        <br><br>
                                        <div class="text-center" style="max-height:400px">
                                            <img src="{{ asset('assets/images/panduan/create-new-periode.png') }}"
                                                class="img-fluid border border-secondary"
                                                alt="Membuat Periode Beasiswa Baru" style="max-height: 400px">
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div class="card rounded-md myshadow">
                                <div class="card-header rounded-bottom-md p-0">
                                    <a class="h5 d-block w-100 p-3 text-white mb-0" data-toggle="collapse"
                                        href="#collapseA2">
                                        2. Melengkapi Data Periode Beasiswa
                                    </a>
                                </div>
                                <div id="collapseA2" class="collapse hide" data-parent="#accordion">
                                    <div class="card-body">
                                        - Pergi ke Menu <b class="text-info">&nbsp;Periode Beasiswa &nbsp;<i
                                                class="fa-solid fa-angle-right text-white"></i>&nbsp; Batch-X
                                            (Nonaktif).</b>
                                        <br> - Sedikit gulir ke Bawah, isi kolom <b class="text-info">&nbsp;Group
                                            WhatsApp &nbsp;</b>untuk ditampilkan
                                        ketika
                                        pengumuman akhir diberikan. Format "<b class="text-info">https://...</b>".
                                        <br> - Kemudian tekan tombol <b class="text-info">Simpan</b>.
                                        <br> - Isi kolom <b class="text-info">&nbsp;Teknis Wawancara &nbsp;</b>untuk
                                        ditampilkan pada saat peserta lolos Tahap Administrasi.
                                        <br> - Kemudian tekan tombol <b class="text-info">Simpan</b>.
                                        <br> - Contoh Pengisian:
                                        <br><br>
                                        <div class="text-center" style="max-height:400px">
                                            <img src="{{ asset('assets/images/panduan/melengkapi-periode.png') }}"
                                                class="img-fluid border border-secondary"
                                                alt="Screenshot Melengkapi Periode" style="max-height: 400px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card rounded-md myshadow">
                                <div class="card-header rounded-bottom-md p-0">
                                    <a class="h5 d-block w-100 p-3 text-white mb-0" data-toggle="collapse"
                                        href="#collapseA3">
                                        3. Mengaktifkan Periode Beasiswa
                                    </a>
                                </div>
                                <div id="collapseA3" class="collapse hide" data-parent="#accordion">
                                    <div class="card-body">
                                        - Pergi ke Menu <b class="text-info">&nbsp;Periode Beasiswa &nbsp;<i
                                                class="fa-solid fa-angle-right text-white"></i>&nbsp; Batch-X
                                            (Nonaktif).</b>
                                        <br> - Pada bagian kanan atas, tekan tombol <b
                                            class="text-warning">&nbsp;Pengaturan&nbsp;</b>.
                                        <br> - Setelah form muncul, tekan pada kolom <b
                                            class="text-info">&nbsp;Nonaktif &nbsp;</b>dan ubah menjadi <b
                                            class="text-info">&nbsp;Aktif&nbsp;</b>.
                                        <br> - Kemudian tekan tombol <b class="text-info">Simpan Perubahan</b>.
                                        <br> - Selesai. Periode Baru sudah Aktif, dan peserta dapat melakukan Pendaftaran
                                        atau Registrasi
                                        Akun.
                                        <br><br>
                                        <div class="text-center" style="max-height:400px">
                                            <img src="{{ asset('assets/images/panduan/mengaktifkan-periode.png') }}"
                                                class="img-fluid border border-secondary"
                                                alt="Screenshot Mengaktifkan Periode" style="max-height: 400px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card rounded-md myshadow">
                    <div class="card-header">
                        <p class="h4">B. Tahapan Program Beasiswa</p>
                    </div>

                    <div class="card-body">

                        <div id="accordion2">
                            <div class="card rounded-md myshadow">
                                <div class="card-header rounded-bottom-md p-0">
                                    <a class="h6 d-block w-100 p-3 text-white mb-0" data-toggle="collapse"
                                        href="#collapseB1">
                                        Peserta Melakukan Registrasi Akun
                                    </a>
                                </div>
                                <div id="collapseB1" class="collapse hide" data-parent="#accordion2">
                                    <div class="card-body">
                                        - Link Registrasi Peserta :<br>
                                        - <a href="{{ url('/register') }}">{{ url('/register') }}</a><br>
                                        - Peserta melakukan Registrasi pada saat Periode
                                        diaktifkan sampai dengan Penutupan Tahap Administrasi.
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div class="card rounded-md myshadow">
                                <div class="card-header rounded-bottom-md p-0">
                                    <a class="h6 d-block w-100 p-3 text-white mb-0" data-toggle="collapse"
                                        href="#collapseB2">
                                        <span class="text-warning">Tahap Administrasi</span> - Peserta Mengisi Formulir
                                        Administrasi
                                    </a>
                                </div>
                                <div id="collapseB2" class="collapse hide" data-parent="#accordion2">
                                    <div class="card-body">
                                        - Selama tahap Administrasi berlangsung, Peserta yang belum memiliki akun masih
                                        dapat melakukan Registrasi.<br>
                                        - Selama tahap Administrasi berlangsung, Admin hanya menunggu hingga tahap
                                        Administrasi Ditutup.<br>
                                        - Mahasiswa yang telah mengisi Administrasi Akan muncul pada Tabel Pendaftar.<br>
                                        - Lihat Gambar Berikut.
                                        <br>
                                        <div class="text-center" style="max-height:400px">
                                            <img src="{{ asset('assets/images/panduan/list-administrasi.png') }}"
                                                class="img-fluid border border-secondary"
                                                alt="Screenshot List Pendaftar / Peserta" style="max-height: 400px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card rounded-md myshadow">
                                <div class="card-header rounded-bottom-md p-0">
                                    <a class="h6 d-block w-100 p-3 text-white mb-0" data-toggle="collapse"
                                        href="#collapseB3">
                                        <span class="text-warning">Tahap Administrasi</span> - Admin Menilai Administrasi
                                    </a>
                                </div>
                                <div id="collapseB3" class="collapse hide" data-parent="#accordion2">
                                    <div class="card-body">
                                        - Setelah Sesi Administrasi di Tutup, Tombol penilaian Administrasi akan muncul.<br>
                                        - Admin menekan tombol tersebut untuk menuju halaman Penilaian.<br>
                                        - Admin melakukan penilaian peserta dan menyimpannya satu persatu.<br>
                                        - Admin dapat menambahkan catatan tentang apapun kedalam kolom catatan disetiap
                                        peserta untuk keperluan Admin.<br>
                                        - Peserta tidak dapat melihat catatan tersebut.<br>
                                        <br>
                                        <div class="text-center" style="max-height:400px">
                                            <img src="{{ asset('assets/images/panduan/nilaiadm.png') }}"
                                                class="img-fluid border border-secondary"
                                                alt="Screenshot Tombol Penilaian Administrasi" style="max-height: 400px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card rounded-md myshadow">
                                <div class="card-header rounded-bottom-md p-0">
                                    <a class="h6 d-block w-100 p-3 text-white mb-0" data-toggle="collapse"
                                        href="#collapseB4">
                                        <span class="text-warning">Tahap Administrasi</span> - Admin Mengumumkan
                                        Administrasi
                                    </a>
                                </div>
                                <div id="collapseB4" class="collapse hide" data-parent="#accordion2">
                                    <div class="card-body">
                                        - Tombol untuk mengumumkan Administrasi akan muncul ketika Tanggal hari ini =
                                        Tanggal Pengumuman Administrasi. <br>
                                        - Tekan tombol untuk melihat daftar peserta yang lolos dan yang tidak lolos.<br>
                                        - Sebelum menekan Tombol "Selesai & Kirim", pastikan data peserta dan jadwal
                                        wawancara sudah benar, serta Teknis Wawancara telah diisi dengan benar.<br>
                                        <br>
                                        <div class="text-center" style="max-height:400px">
                                            <img src="{{ asset('assets/images/panduan/umumkanadm.png') }}"
                                                class="img-fluid border border-secondary"
                                                alt="Screenshot Tombol Umumkan Administrasi" style="max-height: 400px">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card rounded-md myshadow">
                                <div class="card-header rounded-bottom-md p-0">
                                    <a class="h6 d-block w-100 p-3 text-white mb-0" data-toggle="collapse"
                                        href="#collapseB5">
                                        <span class="text-success">Tahap Wawancara</span> - Peserta dan Admin Melakukan
                                        Kegiatan Wawancara Sekaligus Menilai
                                    </a>
                                </div>
                                <div id="collapseB5" class="collapse hide" data-parent="#accordion2">
                                    <div class="card-body">
                                        - Wawancara dilakukan pada saat sesi Wawancara telah dimulai.<br>
                                        - Ketika peserta login, peserta akan melihat jadwal wawancara dan teknis pelaksanaan
                                        yang sudah diberikan.<br>
                                        - Saat wawancara berlangsung, pada saat itu juga Admin mengakses halaman Penilaian
                                        Wawancara untuk menilai peserta yang sedang diwawancarai.<br>
                                        - Admin dapat memberikan catatan pada setiap peserta.<br>
                                        - Catatan Wawancara tidak dapat dilihat oleh peserta.<br>
                                        <br>
                                        <div class="text-center" style="max-height:400px">
                                            <img src="{{ asset('assets/images/panduan/nilaiwwn.png') }}"
                                                class="img-fluid border border-secondary"
                                                alt="Screenshot Tombol Penilaian Wawancara" style="max-height: 400px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card rounded-md myshadow">
                                <div class="card-header rounded-bottom-md p-0">
                                    <a class="h6 d-block w-100 p-3 text-white mb-0" data-toggle="collapse"
                                        href="#collapseB7">
                                        <span class="text-success">Tahap Wawancara</span> - Admin Mengumumkan Wawancara
                                    </a>
                                </div>
                                <div id="collapseB7" class="collapse hide" data-parent="#accordion2">
                                    <div class="card-body">
                                        - Tombol untuk mengumumkan Wawancara akan muncul ketika Tanggal hari ini =
                                        Tanggal Pengumuman Wawancara. <br>
                                        - Tekan tombol untuk melihat daftar peserta yang lolos dan yang tidak lolos.<br>
                                        - Sebelum menekan Tombol "Selesai & Kirim", pastikan data peserta dan soal sudah
                                        benar.<br>
                                        <br>
                                        <div class="text-center" style="max-height:400px">
                                            <img src="{{ asset('assets/images/panduan/umumkanwwn.png') }}"
                                                class="img-fluid border border-secondary"
                                                alt="Screenshot Tombol Umumkan Wawancara" style="max-height: 400px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card rounded-md myshadow">
                                <div class="card-header rounded-bottom-md p-0">
                                    <a class="h6 d-block w-100 p-3 text-white mb-0" data-toggle="collapse"
                                        href="#collapseB8">
                                        <span class="text-primary">Tahap Penugasan</span> - Peserta Mengisi Formulir
                                        Penugasan
                                    </a>
                                </div>
                                <div id="collapseB8" class="collapse hide" data-parent="#accordion2">
                                    <div class="card-body">
                                        - Peserta dapat mengisi / mengupload tugas ketika Tahap Penugasan dimulai.<br>
                                        - Selama tahap Penugasan berlangsung, Admin hanya menunggu hingga tahap
                                        Penugasan Ditutup.<br>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div class="card rounded-md myshadow">
                                <div class="card-header rounded-bottom-md p-0">
                                    <a class="h6 d-block w-100 p-3 text-white mb-0" data-toggle="collapse"
                                        href="#collapseB9">
                                        <span class="text-primary">Tahap Penugasan</span> - Admin Menilai Penugasan
                                    </a>
                                </div>
                                <div id="collapseB9" class="collapse hide" data-parent="#accordion2">
                                    <div class="card-body">
                                        - Setelah Sesi Penugasan di Tutup, Tombol penilaian Penugasan akan muncul.<br>
                                        - Admin menekan tombol tersebut untuk menuju halaman Penilaian.<br>
                                        - Admin melakukan penilaian peserta dan menyimpannya satu persatu.<br>
                                        - Admin dapat menambahkan catatan tentang apapun ke dalam kolom catatan disetiap
                                        peserta untuk keperluan Admin.<br>
                                        - Peserta tidak dapat melihat catatan tersebut.<br>
                                        <br>
                                        <div class="text-center" style="max-height:400px">
                                            <img src="{{ asset('assets/images/panduan/nilaipng.png') }}"
                                                class="img-fluid border border-secondary"
                                                alt="Screenshot Tombol Menilai Penugasan" style="max-height: 400px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card rounded-md myshadow">
                                <div class="card-header rounded-bottom-md p-0">
                                    <a class="h6 d-block w-100 p-3 text-white mb-0" data-toggle="collapse"
                                        href="#collapseB10">
                                        <span class="text-primary">Tahap Penugasan</span> - Admin Mengumumkan Penugasan
                                        (Final)
                                    </a>
                                </div>
                                <div id="collapseB10" class="collapse hide" data-parent="#accordion2">
                                    <div class="card-body">
                                        - Tombol untuk mengumumkan Penugasan akan muncul ketika Tanggal hari ini =
                                        Tanggal Pengumuman Penugasan. <br>
                                        - Tekan tombol untuk melihat daftar peserta yang lolos dan yang tidak lolos.<br>
                                        - Sebelum menekan Tombol "Selesai & Kirim", pastikan data peserta dan Link Group
                                        Whatsapp sudah terisi.<br>
                                        <br>
                                        <div class="text-center" style="max-height:400px">
                                            <img src="{{ asset('assets/images/panduan/umumkanpng.png') }}"
                                                class="img-fluid border border-secondary"
                                                alt="Screenshot Tombol Umumkan Penugasan" style="max-height: 400px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
@endsection
