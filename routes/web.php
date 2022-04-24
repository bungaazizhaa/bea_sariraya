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

$getTanggalSekarang = Carbon::now()->format('Y-m-d');
$getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
$getTanggalMulaiAdministrasi = $getPeriodeAktif->tm_adm;

Route::get('/', [HomeController::class, 'indexLandingPage'])->name('landing');


// ================= ROUTE HOME MAHASISWA =================
Route::middleware(['periode.timerestricted', 'auth', 'role:mahasiswa'])->group(function () {
    // all routes that need time-restrictions

    Route::get('/my-profile', [HomeController::class, 'indexMahasiswa'])->name('profil.mahasiswa');
});

Route::get('/tahap-administrasi', [AdministrasiController::class, 'admShow'])->name('tahap.administrasi')->middleware('periode.timerestricted', 'administrasi.timerestricted', 'auth');
Route::get('/tahap-wawancara', [WawancaraController::class, 'wwnShow'])->name('tahap.wawancara')->middleware('periode.timerestricted', 'wawancara.timerestricted', 'auth');
Route::get('/tahap-penugasan', [PenugasanController::class, 'pngShow'])->name('tahap.penugasan')->middleware('periode.timerestricted', 'penugasan.timerestricted', 'auth');

// ================= ROUTE HOME ADMIN =================
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'indexAdmin'])->name('admin');
    Route::get('/profil-admin', [HomeController::class, 'indexProfilAdmin'])->name('profil.admin');
});


Route::post('update-data-saya', [UserController::class, 'updateMyUser'])->name('update.myuser'); //Edit Data User dari Profil Akun Sendiri

Route::post('uploadfoto', [UserController::class, 'uploadFoto'])->name('upload.foto'); //Edit Foto User dari Profil Akun Sendiri

if ($getTanggalSekarang >= $getTanggalMulaiAdministrasi) {
    Auth::routes(['register' => false]);
} else {
    Auth::routes();
}
