<?php

use App\Http\Controllers\AdministrasiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PenugasanController;
use App\Http\Controllers\WawancaraController;

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


// ================= ROUTE HOME MAHASISWA =================
Route::middleware(['periode.timerestricted', 'auth', 'role:mahasiswa'])->group(function () {
    // all routes that need time-restrictions

    Route::get('/home', [HomeController::class, 'indexMahasiswa'])->name('home');
    Route::get('/profil', [HomeController::class, 'indexProfilMahasiswa'])->name('profil.mahasiswa');
});

Route::get('/tahap-administrasi', [AdministrasiController::class, 'admShow'])->name('tahap.administrasi')->middleware('periode.timerestricted', 'administrasi.timerestricted', 'auth');
Route::get('/tahap-wawancara', [WawancaraController::class, 'wwnShow'])->name('tahap.wawancara')->middleware('periode.timerestricted', 'wawancara.timerestricted', 'auth');
Route::get('/tahap-penugasan', [PenugasanController::class, 'pngShow'])->name('tahap.penugasan')->middleware('periode.timerestricted', 'penugasan.timerestricted', 'auth');

// ================= ROUTE HOME ADMIN =================
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'indexAdmin'])->name('admin');
    Route::get('/profil-admin', [HomeController::class, 'indexProfilAdmin'])->name('profil.admin');
});

Auth::routes();
