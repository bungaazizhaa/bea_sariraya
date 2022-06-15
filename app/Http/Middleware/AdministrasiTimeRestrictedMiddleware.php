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
        if ($getPeriodeAktif == null) {
            Alert::info('Maaf! Saat ini Tidak Ada Program Beasiswa.', 'Terimakasih.');
            return redirect(route('landing'));
        }
        $getTanggalSekarang = Carbon::now()->format('Y-m-d');
        $getAdministrasiUser = Administrasi::where('user_id', '=', Auth::user()->id)->where('periode_id', '=', $getPeriodeAktif->id_periode)->first();
        isset($getAdministrasiUser) ? $statusUserAdm = $getAdministrasiUser->status_adm : '';

        if (!isset(Auth::user()->picture) && $getTanggalSekarang > $getPeriodeAktif->ta_adm) {
            return response(view('view-mahasiswa.administrasi.a-pengumumangagal', compact('getPeriodeAktif')));
        } elseif (!isset(Auth::user()->picture) && $getTanggalSekarang <= $getPeriodeAktif->ta_adm->format('Y-m-d')) {
            Alert::warning('Isi Foto Profil Terlebih Dahulu.', 'Ukuran Pas Foto 3x4.');
            return redirect(route('profil.mahasiswa'));
        } elseif ((!isset(Auth::user()->picture) && isset($getPeriodeAktif->status_adm))) {
            return response(view('view-mahasiswa.administrasi.a-pengumumangagal', compact('getPeriodeAktif')));
        } elseif ($getPeriodeAktif->status_adm != 'Selesai') { //Tahap Administrasi Belum Selesai
            if ($getPeriodeAktif->tm_adm->format('Y-m-d') > $getTanggalSekarang) { //Sesi Belum Dibuka
                $info = 'Tahap Administrasi Belum Dibuka.';
                return response(view('view-mahasiswa.tutup-sesi', compact('info', 'getPeriodeAktif')));
            } elseif ($getPeriodeAktif->ta_adm < $getTanggalSekarang && !$getPeriodeAktif->status_adm == 'Selesai') { //Sesi Sudah Ditutup
                $info = 'Tahap Administrasi Sudah Ditutup. Saat ini sedang dilakukan proses Seleksi.';
                $tglpengumuman = $getPeriodeAktif->tp_adm->format('Y-m-d');
                $getAdministrasiUser = Administrasi::where('user_id', '=', Auth::user()->id)->where('periode_id', '=', $getPeriodeAktif->id_periode)->first();
                return response(view('view-mahasiswa.administrasi.a-detail', compact('info', 'getPeriodeAktif', 'getAdministrasiUser', 'tglpengumuman')));
            }
        } elseif ($getPeriodeAktif->status_adm == 'Selesai' && $getTanggalSekarang < $getPeriodeAktif->tm_wwn->format('Y-m-d')) { //Sudah diumumkan dan Belum Memasuki T.Wawancara
            if (isset($getAdministrasiUser) && $statusUserAdm == 'lolos') {
                $tanggal_wawancara = $getAdministrasiUser->wawancara->jadwal_wwn; //TODO: kondisi user yang diambil dari database
                return response(view('view-mahasiswa.administrasi.a-pengumumanlolos', compact('getPeriodeAktif', 'tanggal_wawancara')));
            } else {
                return response(view('view-mahasiswa.administrasi.a-pengumumangagal', compact('getPeriodeAktif')));
            }
        } elseif ($getPeriodeAktif->status_adm == 'Selesai' && $getTanggalSekarang >= $getPeriodeAktif->tm_wwn->format('Y-m-d')) { //Sudah diumumkan dan Sudah Memasuki T.Wawancara
            if (isset($getAdministrasiUser) && $statusUserAdm == 'lolos') {
                return redirect(route('tahap.wawancara'));
            } else {
                return response(view('view-mahasiswa.administrasi.a-pengumumangagal', compact('getPeriodeAktif')));
            }
        }
        return $next($request);
    }
}
