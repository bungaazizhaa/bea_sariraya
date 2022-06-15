<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\Periode;
use App\Models\Administrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PenugasanTimeRestrictedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
        if ($getPeriodeAktif == null) {
            Alert::info('Maaf! Saat ini Tidak Ada Program Beasiswa.', 'Terimakasih.');
            return redirect(route('landing'));
        }
        $getTanggalSekarang = Carbon::now()->format('Y-m-d');
        $getAdministrasiUser = Administrasi::where('user_id', '=', Auth::user()->id)->where('periode_id', '=', $getPeriodeAktif->id_periode)->first();
        isset($getAdministrasiUser) ? $statusAdmUser = $getAdministrasiUser->status_adm : ''; //TODO: kondisi user yang diambil dari database
        isset($getAdministrasiUser->wawancara->status_wwn) ? $statusWwnUser = $getAdministrasiUser->wawancara->status_wwn : $statusWwnUser = ''; //TODO: kondisi user yang diambil dari database
        // $statusAdmUser = "lolos"; //kondisi user yang diambil dari database
        // $statusWwnUser = "lolos"; //kondisi user yang diambil dari database

        if (!isset(Auth::user()->picture) && $getTanggalSekarang > $getPeriodeAktif->ta_adm) {
            return response(view('view-mahasiswa.administrasi.a-pengumumangagal', compact('getPeriodeAktif')));
        } elseif ($getPeriodeAktif->status_adm == 'Selesai' && $statusAdmUser != 'lolos') {
            return response(view('view-mahasiswa.administrasi.a-pengumumangagal', compact('getPeriodeAktif')));
        } elseif ($getPeriodeAktif->status_wwn == 'Selesai' && $statusWwnUser != 'lolos') {
            return response(view('view-mahasiswa.wawancara.w-pengumumangagal', compact('getPeriodeAktif')));
        } elseif ($getPeriodeAktif->status_png == null) {
            if (!isset(Auth::user()->picture)) {
                Alert::warning('Isi Foto Profil Terlebih Dahulu.', 'Ukuran Pas Foto 3x4.');
                return redirect(route('profil.mahasiswa'));
            } elseif ($getTanggalSekarang < $getPeriodeAktif->tm_png->format('Y-m-d')) { //Sesi Belum Dibuka
                $info = 'Tahap Penugasan Belum Dibuka.';
                return response(view('view-mahasiswa.tutup-sesi', compact('info', 'getPeriodeAktif')));
            } elseif ($getTanggalSekarang > $getPeriodeAktif->ta_png->format('Y-m-d') &&  isset($statusAdmUser) ? $statusAdmUser == 'lolos' : '' && $statusWwnUser == 'lolos') { //Sesi Sudah Ditutup
                $info = 'Tahap Penugasan Sudah Ditutup. Mohon untuk Menunggu Pengumuman.';
                $tglpengumuman = $getPeriodeAktif->tp_png->format('Y-m-d');
                return response(view('view-mahasiswa.tutup-sesi', compact('info', 'getPeriodeAktif', 'tglpengumuman')));
            }
        } elseif (isset($getAdministrasiUser) && $getPeriodeAktif->status_png == 'Selesai' && $getPeriodeAktif->status == 'aktif' && $statusAdmUser == 'lolos' && $statusWwnUser == 'lolos') { //Sesi Sudah Selesai dan Diumumkan
            $statusPngUser = $getAdministrasiUser->wawancara->penugasan->status_png;
            if (isset(Auth::user()->picture) && $statusPngUser == 'lolos') {
                return response(view('view-mahasiswa.penugasan.p-pengumumanlolos', compact('getPeriodeAktif', 'statusPngUser')));
            } else {
                return response(view('view-mahasiswa.penugasan.p-pengumumangagal', compact('getPeriodeAktif', 'statusPngUser')));
            }
        } elseif (isset(Auth::user()->picture) && isset($getAdministrasiUser) && $statusAdmUser == 'lolos' && $statusWwnUser != 'lolos') {
            return response(view('view-mahasiswa.wawancara.w-pengumumangagal', compact('getPeriodeAktif')));
        }
        // else {
        //     return response(view('view-mahasiswa.administrasi.a-pengumumangagal', compact('getPeriodeAktif')));
        // }
        return $next($request);
    }
}
