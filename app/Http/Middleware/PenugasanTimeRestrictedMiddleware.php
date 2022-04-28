<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\Periode;
use Illuminate\Http\Request;
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
        $statusAdmUser = "lolos"; //kondisi user yang diambil dari database
        $statusWwnUser = "lolos"; //kondisi user yang diambil dari database
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
        $getTanggalSekarang = Carbon::now()->format('Y-m-d');

        if ($getPeriodeAktif->status_png == null) {
            if ($getTanggalSekarang < $getPeriodeAktif->tm_png->format('Y-m-d')) { //Sesi Belum Dibuka
                $info = 'Tahap Penugasan Belum Dibuka.';
                return response(view('view-mahasiswa.tutup-sesi', compact('info', 'getPeriodeAktif')));
            } elseif ($getTanggalSekarang > $getPeriodeAktif->ta_png->format('Y-m-d') && $statusAdmUser == 'lolos' && $statusWwnUser == 'lolos') { //Sesi Sudah Ditutup
                $info = 'Tahap Penugasan Sudah Ditutup. Mohon untuk Menunggu Pengumuman.';
                $tglpengumuman = $getPeriodeAktif->tp_png->format('Y-m-d');
                return response(view('view-mahasiswa.tutup-sesi', compact('info', 'getPeriodeAktif', 'tglpengumuman')));
            }
        } elseif ($getPeriodeAktif->status_png == 'Selesai' && $getPeriodeAktif->status == 'aktif' && $statusAdmUser == 'lolos' && $statusWwnUser == 'lolos') { //Sesi Sudah Selesai dan Diumumkan
            $statusPngUser = 'lolos';
            if ($statusPngUser == 'lolos') {
                return response(view('view-mahasiswa.penugasan.p-pengumumanlolos', compact('getPeriodeAktif', 'statusPngUser')));
            } else {
                return response(view('view-mahasiswa.penugasan.p-pengumumangagal', compact('getPeriodeAktif', 'statusPngUser')));
            }
        } elseif ($statusAdmUser == 'lolos' && $statusWwnUser == 'gagal') {
            return response(view('view-mahasiswa.wawancara.w-pengumumangagal', compact('getPeriodeAktif')));
        } else {
            return response(view('view-mahasiswa.administrasi.a-pengumumangagal', compact('getPeriodeAktif')));
        }
        return $next($request);
    }
    // {

    //     $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
    //     $getTanggalSekarang = Carbon::now()->format('Y-m-d');

    //     //=========== TAHAP PENUGASAN ===========
    //     if ($getPeriodeAktif->status_png == null) {
    //         if ($getTanggalSekarang < $getPeriodeAktif->tm_png) { //Sesi Belum Dibuka
    //             $info = 'Tahap Penugasan Belum Dibuka.';
    //             return response(view('view-mahasiswa.tutup-sesi', compact('info', 'getPeriodeAktif')));
    //         } elseif ($getTanggalSekarang > $getPeriodeAktif->ta_png) { //Sesi Sudah Ditutup
    //             $info = 'Tahap Penugasan Sudah Ditutup.';
    //             return response(view('view-mahasiswa.tutup-sesi', compact('info', 'getPeriodeAktif')));
    //         }
    //     } elseif ($getPeriodeAktif->status_png == 'Selesai') {
    //         $info = 'Tahap Penugasan Telah Selesai.';
    //         return response(view('view-mahasiswa.tutup-sesi', compact('info', 'getPeriodeAktif')));
    //     }
    //     return $next($request);
    // }
}
