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

// ================= ROUTE SEMENTARA =================
Route::view('/awal', 'awal');
Route::view('/regist', 'regist');
Route::view('/masuk', 'masuk');

// ================= ROUTE HOME MAHASISWA =================
Route::middleware(['periode.timerestricted', 'auth', 'role:mahasiswa'])->group(function () {
    Route::get('/my-profile', [HomeController::class, 'indexMahasiswa'])->name('profil.mahasiswa');
    Route::post('update-data-saya', [UserController::class, 'updateMyUser'])->name('update.myuser'); //Edit Data User dari Profil Akun Sendiri
    Route::post('uploadfoto', [UserController::class, 'uploadFoto'])->name('upload.foto'); //Edit Foto User dari Profil Akun Sendiri
    Route::post('update-administrasi', [AdministrasiController::class, 'update'])->name('update.administrasi');
    // Route::get('/my-administrasi', [AdministrasiController::class, 'detailAdm'])->name('detail.adm');
});

Route::get('/tahap-administrasi', [AdministrasiController::class, 'index'])->name('tahap.administrasi')->middleware('periode.timerestricted', 'administrasi.timerestricted', 'auth');
Route::get('/tahap-wawancara', [WawancaraController::class, 'index'])->name('tahap.wawancara')->middleware('periode.timerestricted', 'wawancara.timerestricted', 'auth');
Route::get('/tahap-penugasan', [PenugasanController::class, 'index'])->name('tahap.penugasan')->middleware('periode.timerestricted', 'penugasan.timerestricted', 'auth');

// ================= ROUTE HOME ADMIN =================
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'indexAdmin'])->name('admin');

    Route::get('/nilai-administrasi/{name}', [AdministrasiController::class, 'nilaiAdm'])->name('nilai.adm');
    Route::post('/update-nilai-administrasi/{id}', [AdministrasiController::class, 'updatenilaiAdm'])->name('updatenilai.adm');
    Route::post('/periode/store', [PeriodeController::class, 'store'])->name('store.periode');
    Route::post('/update-periode/{name}', [PeriodeController::class, 'update'])->name('update.periode');

    Route::post('/periode/umumkan/{name}', [PeriodeController::class, 'umumkanAdm'])->name('umumkan.adm');
    Route::get('/periode/{name}', [PeriodeController::class, 'indexPeriodeById'])->name('periode');
    Route::get('/profil-admin', [HomeController::class, 'indexProfilAdmin'])->name('profil.admin');
});

$getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();

if ($getPeriodeAktif == null) {  //Jika Tidak ada periode Aktif
    Auth::routes(['register' => false]);
} else { //Jika ada periode Aktif
    $getTanggalAkhirAdministrasi = $getPeriodeAktif->ta_adm;
    $getTanggalSekarang = Carbon::now()->format('Y-m-d');
    if ($getTanggalSekarang > $getTanggalAkhirAdministrasi) { //dan Jika Sekarang sudah melewati Tanggal Akhir Administrasi
        Auth::routes(['register' => false]); //Tutup Registrasi
    } else { //Jika Sekarang Belum melewati Tanggal Akhir Administrasi, Bisa Register, Bisa Update
        Auth::routes();
    }
}
