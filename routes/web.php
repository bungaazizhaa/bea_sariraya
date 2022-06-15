<?php

use Carbon\Carbon;
use App\Models\Periode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PenugasanController;
use App\Http\Controllers\WawancaraController;
use App\Http\Controllers\AdministrasiController;
use App\Http\Controllers\PeriodeController;
use App\Models\User;
use Illuminate\Support\Facades\Schema;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'indexLandingPage'])->name('landing');

//TODO: ================= ROUTE SEMENTARA =================
// Route::view('/_login', '_login');

//TODO: ================= ROUTE HOME MAHASISWA =================
Route::middleware(['periode.timerestricted', 'auth', 'role:mahasiswa', 'verified'])->group(function () {
    Route::get('/my-profile', [HomeController::class, 'indexMahasiswa'])->name('profil.mahasiswa');
    Route::post('update-data-saya', [UserController::class, 'updateMyUser'])->name('update.myuser'); //Edit Data User dari Profil Akun Sendiri
    Route::post('uploadfoto', [UserController::class, 'uploadFoto'])->name('upload.foto'); //Edit Foto User dari Profil Akun Sendiri
    Route::post('update-administrasi', [AdministrasiController::class, 'update'])->name('update.administrasi');
    Route::post('update-penugasan', [PenugasanController::class, 'update'])->name('update.penugasan');
    Route::post('/delete-filejawaban/{id}', [PenugasanController::class, 'filejawabanDestroy'])->name('filejawaban.destroy');
    Route::get('/delete-fileadm/{column}', [AdministrasiController::class, 'fileadmDestroy'])->name('fileadm.destroy');
    // Route::get('/my-administrasi', [AdministrasiController::class, 'detailAdm'])->name('detail.adm');
});

Route::get('/tahap-administrasi', [AdministrasiController::class, 'index'])->name('tahap.administrasi')->middleware('periode.timerestricted', 'administrasi.timerestricted', 'auth', 'verified');
Route::get('/tahap-wawancara', [WawancaraController::class, 'index'])->name('tahap.wawancara')->middleware('periode.timerestricted', 'wawancara.timerestricted', 'auth', 'verified');
Route::get('/tahap-penugasan', [PenugasanController::class, 'index'])->name('tahap.penugasan')->middleware('periode.timerestricted', 'penugasan.timerestricted', 'auth', 'verified');

//TODO: ================= ROUTE HOME ADMIN =================
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/setting', [HomeController::class, 'viewSetting'])->name('setting.beasiswa');
    Route::post('/admin/reset-beasiswa', [HomeController::class, 'resetBeasiswa'])->name('reset.beasiswa');
    Route::get('/dashboard', [HomeController::class, 'indexAdmin'])->name('admin');
    Route::get('/panduan-aplikasi', [HomeController::class, 'panduanAplikasi'])->name('panduan.aplikasi');
    Route::get('/preview-tekniswwn', [HomeController::class, 'previewTeknisWwn'])->name('preview.tekniswwn'); //preview teknis wawancara
    //Periode
    Route::get('/periode', [PeriodeController::class, 'index'])->name('index.periode'); //periode
    Route::post('/periode/store', [PeriodeController::class, 'store'])->name('store.periode'); //membuat-baru-periode
    Route::post('/{name}/group-wa/update', [PeriodeController::class, 'groupwaUpdate'])->name('groupwaupdate.periode'); //memperbarui link wa
    Route::post('/{name}/teknis-wwn/update', [PeriodeController::class, 'tekniswwnUpdate'])->name('tekniswwnupdate.periode'); //memperbarui teknis wawancara
    Route::get('/{name}/detail-periode', [PeriodeController::class, 'indexPeriodeById'])->name('periode'); //detail-periode
    Route::post('/{name}/destroy-periode', [PeriodeController::class, 'destroy'])->name('destroy.periode'); //menghapus-periode
    Route::post('/{name}/update-periode', [PeriodeController::class, 'update'])->name('update.periode');
    Route::post('/{name}/administrasi/umumkan', [PeriodeController::class, 'umumkanAdm'])->name('umumkan.adm'); //Set status_adm Selesai di Periode
    Route::post('/{name}/wawancara/umumkan', [PeriodeController::class, 'umumkanWwn'])->name('umumkan.wwn'); //Set status_adm Selesai di Periode
    Route::post('/{name}/penugasan/umumkan', [PeriodeController::class, 'umumkanPng'])->name('umumkan.png'); //Set status_adm Selesai di Periode
    //Administrasi
    Route::get('/{name}/nilai-administrasi', [AdministrasiController::class, 'nilaiAdm'])->name('nilai.adm'); //halaman nilai adm
    Route::post('/update-nilai-administrasi/{id}', [AdministrasiController::class, 'updatenilaiAdm'])->name('updatenilai.adm'); //menyimpan penilaian adm
    //Wawancara
    Route::get('/{name}/nilai-wawancara', [WawancaraController::class, 'nilaiWwn'])->name('nilai.wwn'); //halaman nilai wwn
    Route::post('/update-nilai-wawancara/{id}', [WawancaraController::class, 'updatenilaiWwn'])->name('updatenilai.wwn'); //menyimpan penilaian wwn
    //Penugasan
    Route::get('/{name}/nilai-penugasan', [PenugasanController::class, 'nilaiPng'])->name('nilai.png'); //halaman nilai png
    Route::post('/update-nilai-penugasan/{id}', [PenugasanController::class, 'updatenilaiPng'])->name('updatenilai.png'); //menyimpan penilaian wwn
    // User
    Route::get('admin/data-pengguna/tabel', [UserController::class, 'showDataPenggunaTabel'])->name('datatabel.pengguna'); //halaman nilai png
    Route::get('admin/data-pengguna', [UserController::class, 'showDataPengguna'])->name('data.pengguna'); //halaman nilai png
    Route::get('admin/data-pengguna/detail/{id}', [UserController::class, 'show'])->name('pengguna.show');;
    Route::get('admin/destroy/data-pengguna/{id}', [UserController::class, 'destroy'])->name('pengguna.destroy');
    Route::post('admin/data-pengguna/update/{id}', [UserController::class, 'update'])->name('pengguna.update');
    // Home
    Route::get('/profil-admin', [HomeController::class, 'indexProfilAdmin'])->name('profil.admin');
});


if (Schema::hasTable('periodes')) {
    $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
} else {
    $getPeriodeAktif = null;
}

if ($getPeriodeAktif == null) {  //Jika Tidak ada periode Aktif
    Auth::routes(['register' => false, 'verify' => true]);
} elseif (isset($getPeriodeAktif)) { //Jika ada periode Aktif
    $getTanggalAkhirAdministrasi = $getPeriodeAktif->ta_adm;
    $getTanggalSekarang = Carbon::now()->format('Y-m-d');
    if ($getTanggalSekarang > $getTanggalAkhirAdministrasi) { //dan Jika Sekarang sudah melewati Tanggal Akhir Administrasi
        Auth::routes(['register' => false, 'verify' => true]); //Tutup Registrasi
    } else { //Jika Sekarang Belum melewati Tanggal Akhir Administrasi, Bisa Register, Bisa Update
        Auth::routes(['verify' => true]);
    }
}
