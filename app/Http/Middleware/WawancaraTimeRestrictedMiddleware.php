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
        $getTanggalSekarang = Carbon::now()->format('Y-m-d');
        $getAdministrasiUser = Administrasi::where('user_id', '=', Auth::user()->id)->where('periode_id', '=', $getPeriodeAktif->id)->first();
        isset($getAdministrasiUser) ? $statusUserAdm = $getAdministrasiUser->status_adm : ''; //TODO: kondisi user yang diambil dari database

        //=========== TAHAP WAWANCARA ===========
        if ($getPeriodeAktif->status_wwn == null && $statusUserAdm == 'lolos') { //Status Wawancara Belum Selesai && User Lolos Adm
            if ($getTanggalSekarang < $getPeriodeAktif->tm_wwn) { //Sesi Belum Dibuka
                $info = 'Tahap Wawancara Belum Dibuka.';
                return response(view('view-mahasiswa.tutup-sesi', compact('info', 'getPeriodeAktif')));
            } elseif ($getTanggalSekarang > $getPeriodeAktif->ta_wwn) { //Sesi Sudah Ditutup
                $info = 'Tahap Wawancara Sudah Ditutup. Mohon untuk Menunggu Pengumuman.';
                $tglpengumuman = $getPeriodeAktif->tp_wwn;
                return response(view('view-mahasiswa.tutup-sesi', compact('info', 'getPeriodeAktif', 'tglpengumuman')));
            }
        } elseif ($getPeriodeAktif->status_wwn == 'Selesai' && $getTanggalSekarang < $getPeriodeAktif->tm_png && $statusUserAdm == 'lolos') { //Wawancara Selesai & Belum memasuki Penugasan & User Lolos Adm
            $statusWwnUser = 'lolos'; //TODO: kondisi user yang diambil dari database
            if (isset($getWawancaraUser) && $statusWwnUser == 'lolos') {
                return response(view('view-mahasiswa.wawancara.w-pengumumanlolos', compact('getPeriodeAktif', 'statusWwnUser')));
            } else {
                return response(view('view-mahasiswa.wawancara.w-pengumumangagal', compact('getPeriodeAktif', 'statusWwnUser')));
            }
        } elseif ($getPeriodeAktif->status_adm == 'Selesai' && $getTanggalSekarang >= $getPeriodeAktif->tm_png && $statusUserAdm == 'lolos') {
            $statusWwnUser = 'lolos'; //TODO: kondisi user yang diambil dari database
            if (isset($getWawancaraUser) && $statusWwnUser == 'lolos') {
                return redirect(route('tahap.penugasan'));
            } else {
                return response(view('view-mahasiswa.wawancara.a-pengumumangagal', compact('getPeriodeAktif', 'statusWwnUser')));
            }
        } else {
            return response(view('view-mahasiswa.administrasi.a-pengumumangagal', compact('getPeriodeAktif')));
        }
        return $next($request);
    }
}
