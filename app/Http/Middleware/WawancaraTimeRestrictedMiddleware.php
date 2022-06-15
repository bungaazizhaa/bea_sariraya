<?php

namespace App\Http\Middleware;

use App\Models\Administrasi;
use Closure;
use Carbon\Carbon;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class WawancaraTimeRestrictedMiddleware
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
        isset($getAdministrasiUser->wawancara->status_wwn) ? $statusWwnUser = $getAdministrasiUser->wawancara->status_wwn : ''; //TODO: kondisi user yang diambil dari database
        //=========== TAHAP WAWANCARA ===========
        if (!isset(Auth::user()->picture) && $getTanggalSekarang > $getPeriodeAktif->ta_adm) {
            return response(view('view-mahasiswa.administrasi.a-pengumumangagal', compact('getPeriodeAktif')));
        } elseif ($getPeriodeAktif->status_adm == 'Selesai' && $statusAdmUser != 'lolos') {
            return response(view('view-mahasiswa.administrasi.a-pengumumangagal', compact('getPeriodeAktif')));
        } elseif ($getPeriodeAktif->status_wwn == null) { //Status Wawancara Belum Selesai && User Lolos Adm
            if (!isset(Auth::user()->picture)) {
                Alert::warning('Isi Foto Profil Terlebih Dahulu.', 'Ukuran Pas Foto 3x4.');
                return redirect(route('profil.mahasiswa'));
            } elseif ($getTanggalSekarang < $getPeriodeAktif->tm_wwn->format('Y-m-d')) { //Sesi Belum Dibuka
                $info = 'Tahap Wawancara Belum Dibuka.';
                return response(view('view-mahasiswa.tutup-sesi', compact('info', 'getPeriodeAktif')));
            } elseif ($getTanggalSekarang > $getPeriodeAktif->ta_wwn && $statusAdmUser == 'lolos') { //Sesi Sudah Ditutup
                $info = 'Tahap Wawancara Sudah Ditutup. Mohon untuk Menunggu Pengumuman.';
                $tglpengumuman = $getPeriodeAktif->tp_wwn;
                return response(view('view-mahasiswa.tutup-sesi', compact('info', 'getPeriodeAktif', 'tglpengumuman')));
            }
        } elseif (isset($getAdministrasiUser) && $getPeriodeAktif->status_wwn == 'Selesai' && $getTanggalSekarang > $getPeriodeAktif->ta_wwn->format('Y-m-d') && $getTanggalSekarang < $getPeriodeAktif->tm_png->format('Y-m-d') && $statusAdmUser == 'lolos') { //Wawancara Selesai & Belum memasuki Penugasan & User Lolos Adm
            if (isset($getAdministrasiUser->wawancara->status_wwn) && $statusWwnUser === 'lolos') {
                return response(view('view-mahasiswa.wawancara.w-pengumumanlolos', compact('getPeriodeAktif', 'getAdministrasiUser')));
            } elseif (!isset($getAdministrasiUser->wawancara->status_wwn) || $statusWwnUser != 'lolos') {
                return response(view('view-mahasiswa.wawancara.w-pengumumangagal', compact('getPeriodeAktif')));
            }
        } elseif ($getPeriodeAktif->status_wwn == 'Selesai' && $getTanggalSekarang >= $getPeriodeAktif->tm_png->format('Y-m-d') && $statusAdmUser == 'lolos') {
            if (isset($getAdministrasiUser->wawancara->status_wwn) && $statusWwnUser === 'lolos') {
                return redirect(route('tahap.penugasan'));
            } elseif (!isset($getAdministrasiUser->wawancara->status_wwn) || $statusWwnUser != 'gagal') {
                return response(view('view-mahasiswa.wawancara.w-pengumumangagal', compact('getPeriodeAktif')));
            }
        }
        // elseif ($getPeriodeAktif->status_adm == 'Selesai' && $statusAdmUser != 'lolos') {
        //     return response(view('view-mahasiswa.administrasi.a-pengumumangagal', compact('getPeriodeAktif')));
        // }
        return $next($request);
    }
}
