<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\Periode;
use App\Models\Administrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AdministrasiTimeRestrictedMiddleware
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
        isset($getAdministrasiUser) ? $statusUserAdm = $getAdministrasiUser->status_adm : '';

        if (!isset(Auth::user()->picture) && $getTanggalSekarang <= $getPeriodeAktif->ta_adm) {
            return redirect(route('profil.mahasiswa'));
        } elseif ((!isset(Auth::user()->picture) && isset($getPeriodeAktif->status_adm))) {
            return response(view('view-mahasiswa.administrasi.a-pengumumangagal', compact('getPeriodeAktif')));
        } elseif ($getPeriodeAktif->status_adm != 'Selesai') { //Tahap Administrasi Belum Selesai
            if ($getTanggalSekarang < $getPeriodeAktif->tm_adm) { //Sesi Belum Dibuka
                $info = 'Tahap Administrasi Belum Dibuka.';
                return response(view('view-mahasiswa.tutup-sesi', compact('info', 'getPeriodeAktif')));
            } elseif ($getPeriodeAktif->ta_adm < $getTanggalSekarang && !$getPeriodeAktif->status_adm == 'Selesai') { //Sesi Sudah Ditutup
                $info = 'Tahap Administrasi Sudah Ditutup. Saat ini sedang dilakukan proses Seleksi.';
                $tglpengumuman = $getPeriodeAktif->tp_adm;
                $getAdministrasiUser = Administrasi::where('user_id', '=', Auth::user()->id)->where('periode_id', '=', $getPeriodeAktif->id)->first();
                return response(view('view-mahasiswa.administrasi.a-detail', compact('info', 'getPeriodeAktif', 'getAdministrasiUser', 'tglpengumuman')));
            }
        } elseif ($getPeriodeAktif->status_adm == 'Selesai' && $getTanggalSekarang < $getPeriodeAktif->tm_wwn) { //Sudah diumumkan dan Belum Memasuki T.Wawancara
            $tanggal_wawancara = '2022-04-31 14:00:00'; //TODO: kondisi user yang diambil dari database
            if (isset($getAdministrasiUser) && $statusUserAdm == 'lolos') {
                return response(view('view-mahasiswa.administrasi.a-pengumumanlolos', compact('getPeriodeAktif', 'tanggal_wawancara')));
            } else {
                return response(view('view-mahasiswa.administrasi.a-pengumumangagal', compact('getPeriodeAktif', 'tanggal_wawancara')));
            }
        } elseif ($getPeriodeAktif->status_adm == 'Selesai' && $getTanggalSekarang >= $getPeriodeAktif->tm_wwn) { //Sudah diumumkan dan Sudah Memasuki T.Wawancara
            if (isset($getAdministrasiUser) && $statusUserAdm == 'lolos') {
                return redirect(route('tahap.wawancara'));
            } else {
                return response(view('view-mahasiswa.administrasi.a-pengumumangagal', compact('getPeriodeAktif')));
            }
        }
        return $next($request);
    }
}
