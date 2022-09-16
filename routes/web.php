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
use App\Http\Controllers\EmailController;
use App\Http\Controllers\PeriodeController;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Stevebauman\Location\Facades\Location;

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

//! === Route Landing Page ===
Route::get('/', [HomeController::class, 'indexLandingPage'])->name('landing');

//! === Route Mahasiswa ===
Route::middleware(['periode.timerestricted', 'auth', 'role:mahasiswa', 'verified'])->group(function () {
    Route::get('/my-profile', [HomeController::class, 'indexMahasiswa'])->name('profil.mahasiswa'); //Todo: Halaman Profil Mahasiswa
    Route::post('update-data-saya', [UserController::class, 'updateMyUser'])->name('update.myuser'); //Todo: Update - Data Akun Mahasiswa
    Route::post('uploadfoto', [UserController::class, 'uploadFoto'])->name('upload.foto'); //Todo: Insert - Upload Foto Mahasiswa
    Route::post('update-administrasi', [AdministrasiController::class, 'update'])->name('update.administrasi'); //Todo: Update - Submit Formulir Administrasi
    Route::post('update-penugasan', [PenugasanController::class, 'update'])->name('update.penugasan'); //Todo: Update - Submit Tugas Mahasiswa
    Route::post('/delete-filejawaban/{id}', [PenugasanController::class, 'filejawabanDestroy'])->name('filejawaban.destroy'); //Todo: Delete - File Tugas
    Route::get('/delete-fileadm/{column}', [AdministrasiController::class, 'fileadmDestroy'])->name('fileadm.destroy'); //Todo: Delete - File Administrasi
});

Route::get('/tahap-administrasi', [AdministrasiController::class, 'index'])->name('tahap.administrasi') //Todo: Halaman Administrasi
    ->middleware('auth', 'verified', 'role:mahasiswa', 'periode.timerestricted', 'administrasi.timerestricted'); //Todo: Middleware - Pengecekan Waktu & Pengarahan Halaman
Route::get('/tahap-wawancara', [WawancaraController::class, 'index'])->name('tahap.wawancara') //Todo: Halaman Wawancara
    ->middleware('auth', 'verified', 'role:mahasiswa', 'periode.timerestricted', 'wawancara.timerestricted'); //Todo: Middleware - Pengecekan Waktu & Pengarahan Halaman
Route::get('/tahap-penugasan', [PenugasanController::class, 'index'])->name('tahap.penugasan') //Todo: Halaman Penugasan
    ->middleware('auth', 'verified', 'role:mahasiswa', 'periode.timerestricted', 'penugasan.timerestricted'); //Todo: Middleware - Pengecekan Waktu & Pengarahan Halaman
// === Akhir Route Mahasiswa ===

//! === Route Admin ===
Route::middleware(['auth', 'role:admin'])->group(function () {
    //! Umum
    Route::get('/admin/setting', [HomeController::class, 'viewSetting'])->name('setting.beasiswa'); //Todo: Halaman Setting Admin
    Route::post('/admin/update-kontak', [HomeController::class, 'updateKontakAdmin'])->name('update.kontakadmin'); //Todo: Update - Kontak di Pengaturan
    Route::post('/admin/reset-beasiswa', [HomeController::class, 'resetBeasiswa'])->name('reset.beasiswa'); //Todo: Delete - Reset Database di Pengaturan
    Route::get('/admin/trash', [HomeController::class, 'trash'])->name('trash'); //Todo: Halaman Trash
    Route::get('/dashboard', [HomeController::class, 'indexAdmin'])->name('admin'); //Todo: Halaman Dashboard
    Route::get('/panduan-aplikasi', [HomeController::class, 'panduanAplikasi'])->name('panduan.aplikasi'); //Todo: Halaman Panduan Aplikasi
    Route::get('/preview-tekniswwn', [HomeController::class, 'previewTeknisWwn'])->name('preview.tekniswwn'); //Todo: Preview Halaman Teknis Wawancara
    //! Periode
    Route::get('/periode', [PeriodeController::class, 'index'])->name('index.periode'); //Todo: Halaman List Periode
    Route::post('/periode/store', [PeriodeController::class, 'store'])->name('store.periode'); //Todo: Insert - Periode Baru
    Route::post('/{name}/group-wa/update', [PeriodeController::class, 'groupwaUpdate'])->name('groupwaupdate.periode'); //Todo: Update - link Whatsapp
    Route::post('/{name}/teknis-wwn/update', [PeriodeController::class, 'tekniswwnUpdate'])->name('tekniswwnupdate.periode'); //Todo: Update - Teknis Wawancara
    Route::get('/{name}/detail-periode', [PeriodeController::class, 'indexPeriodeById'])->name('periode'); //Todo: Halaman Detail Periode
    Route::post('/{name}/destroy-periode', [PeriodeController::class, 'destroy'])->name('destroy.periode'); //Todo: Soft Delete - Periode
    Route::post('/{name}/update-periode', [PeriodeController::class, 'update'])->name('update.periode'); //Todo: Update - Pengaturan Periode
    Route::get('/restore-periode/{name?}', [PeriodeController::class, 'restore'])->name('restore.periode'); //Todo: Restore Periode
    Route::get('/force-destroy-periode/{name?}', [PeriodeController::class, 'forceDestroy'])->name('forcedestroy.periode'); //Todo: Delete Permanen Periode
    //! Send Email Pengumuman
    Route::post('/{name}/administrasi/setselesai', [AdministrasiController::class, 'setSelesaiAdministrasi'])->name('setselesai.adm'); //Todo: Update - Status Adm Selesai di Tombol Umumkan
    Route::post('/{name}/wawancara/setselesai', [WawancaraController::class, 'setSelesaiWawancara'])->name('setselesai.wwn'); //Todo: Update - Status Wwn Selesai di Tombol Umumkan
    Route::post('/{name}/penugasan/setselesai', [PenugasanController::class, 'setSelesaiPenugasan'])->name('setselesai.png'); //Todo: Update - Status Png Selesai di Tombol Umumkan
    Route::get('/{name}/administrasi/umumkanemail/{emailid}', [EmailController::class, 'sendEmailAdministrasi'])->name('umumkanemail.adm'); //Todo: Send Email Kelulusan Adm di Tombol Umumkan
    Route::get('/{name}/wawancara/umumkanemail/{emailid}', [EmailController::class, 'sendEmailWawancara'])->name('umumkanemail.wwn'); //Todo: Send Email Kelulusan Wwn di Tombol Umumkan
    Route::get('/{name}/penugasan/umumkanemail/{emailid}', [EmailController::class, 'sendEmailPenugasan'])->name('umumkanemail.png'); //Todo: Send Email Kelulusan Png di Tombol Umumkan
    //! Administrasi
    Route::get('/{name}/nilai-administrasi', [AdministrasiController::class, 'nilaiAdm'])->name('nilai.adm'); //Todo: Halaman Penilaian Administrasi
    Route::post('/update-nilai-administrasi/{id}', [AdministrasiController::class, 'updatenilaiAdm'])->name('updatenilai.adm'); //Todo: Update Penilaian Administrasi
    //! Wawancara
    Route::get('/{name}/nilai-wawancara', [WawancaraController::class, 'nilaiWwn'])->name('nilai.wwn'); //Todo: Halaman Penilaian Wawancara
    Route::post('/update-nilai-wawancara/{id}', [WawancaraController::class, 'updatenilaiWwn'])->name('updatenilai.wwn'); //Todo: Update Penilaian Wawancara
    //! Penugasan
    Route::get('/{name}/nilai-penugasan', [PenugasanController::class, 'nilaiPng'])->name('nilai.png'); //Todo: Halaman Penilaian Penugasan
    Route::post('/update-nilai-penugasan/{id}', [PenugasanController::class, 'updatenilaiPng'])->name('updatenilai.png'); //Todo: Update Penilaian Penugasan
    //! User
    Route::get('admin/data-pengguna/tabel', [UserController::class, 'showDataPenggunaTabel'])->name('datatabel.pengguna'); //Todo: Halaman Pengguna versi Tabel
    Route::get('admin/data-pengguna', [UserController::class, 'showDataPengguna'])->name('data.pengguna'); //Todo: Halaman Pengguna versi Card
    Route::get('admin/data-pengguna/detail/{id}', [UserController::class, 'show'])->name('pengguna.show'); //Todo: Halaman Detail Pengguna
    Route::get('admin/destroy/data-pengguna/{id}', [UserController::class, 'destroy'])->name('pengguna.destroy');  //Todo: Soft Delete Pengguna
    Route::post('admin/data-pengguna/update/{id}', [UserController::class, 'update'])->name('pengguna.update'); //Todo: Update - Akun Admin
    Route::get('admin/data-pengguna/restore/{id?}', [UserController::class, 'restore'])->name('pengguna.restore'); //Todo: Restore Pengguna
    Route::get('admin/force-destroy/data-pengguna/{id?}', [UserController::class, 'forceDestroy'])->name('pengguna.forcedestroy');  //Todo: Delete Permanen Pengguna
});
// === Akhir Route Admin ===

if (Schema::hasTable('periodes')) { //Todo: Cek Jika ada Tabel Periode
    $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first(); //Todo: Ambil Data Periode Aktif
} else {
    $getPeriodeAktif = null; //Todo: Simpan Informasi Tidak Ada Periode Aktif
}

if ($getPeriodeAktif == null) {  //Todo: Jika Tidak Ada Periode Aktif
    Auth::routes(['register' => false, 'verify' => true]); //Todo: Hapus Halaman Registrasi (Mahasiswa Tidak Bisa Registrasi)
} elseif (isset($getPeriodeAktif)) { //Todo: Jika ada periode Aktif
    $getTanggalAkhirAdministrasi = $getPeriodeAktif->ta_adm->format('Y-m-d'); //Todo: Dapatkan Tanggal Akhir Administrasi
    $getTanggalSekarang = Carbon::now()->format('Y-m-d'); //Todo: Dapatkan Tanggal Sekarang
    if ($getTanggalSekarang > $getTanggalAkhirAdministrasi) { //Todo: Jika Sekarang sudah melewati Tanggal Akhir Administrasi
        Auth::routes(['register' => false, 'verify' => true]); //Todo: Hapus Halaman Registrasi (Mahasiswa Tidak Bisa Registrasi)
    } else { //Todo: Jika Sekarang Belum melewati Tanggal Akhir Administrasi
        Auth::routes(['register' => true, 'verify' => true]); //Todo: Mahasiswa Bisa Register
    }
}
