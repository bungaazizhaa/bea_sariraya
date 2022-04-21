<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\Periode;
use Illuminate\Http\Request;
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
        $statusAdmUser = "lolos"; //kondisi user yang diambil dari database
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
        $getTanggalSekarang = Carbon::now()->format('Y-m-d');

        //=========== TAHAP WAWANCARA ===========
        if ($getPeriodeAktif->status_wwn == null && $statusAdmUser == 'lolos') {
            if ($getTanggalSekarang < $getPeriodeAktif->tm_wwn) { //Sesi Belum Dibuka
                $info = 'Tahap Wawancara Belum Dibuka.';
                return response(view('view-mahasiswa.tutup-sesi', compact('info', 'getPeriodeAktif')));
            } elseif ($getTanggalSekarang > $getPeriodeAktif->ta_wwn) { //Sesi Sudah Ditutup
                $info = 'Tahap Wawancara Sudah Ditutup. Mohon untuk Menunggu Pengumuman.';
                $tglpengumuman = $getPeriodeAktif->tp_wwn;
                return response(view('view-mahasiswa.tutup-sesi', compact('info', 'getPeriodeAktif', 'tglpengumuman')));
            }
        } elseif ($getPeriodeAktif->status_wwn == 'Selesai' && $getTanggalSekarang < $getPeriodeAktif->tm_png && $statusAdmUser == 'lolos') { //Sesi Sudah Selesai dan Diumumkan
            $statusWwnUser = 'lolos';
            if ($statusWwnUser == 'lolos') {
                return response(view('view-mahasiswa.wawancara.w-pengumumanlolos', compact('getPeriodeAktif', 'statusWwnUser', 'tanggal_wawancara')));
            } else {
                return response(view('view-mahasiswa.wawancara.w-pengumumangagal', compact('getPeriodeAktif', 'statusWwnUser')));
            }
        } elseif ($getPeriodeAktif->status_adm == 'Selesai' && $getTanggalSekarang >= $getPeriodeAktif->tm_png && $statusAdmUser == 'lolos') {
            $statusWwnUser = 'lolos'; //kondisi user yang diambil dari database
            if ($statusWwnUser == 'lolos') {
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
