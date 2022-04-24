<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\Periode;
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
        if (!isset(Auth::user()->picture) && $getTanggalSekarang <= $getPeriodeAktif->ta_adm) {
            return redirect(route('profil.mahasiswa'));
        } elseif ((!isset(Auth::user()->picture) && isset($getPeriodeAktif->status_adm))) {
            $user = ''; //kondisi user yang diambil dari database
            return response(view('view-mahasiswa.administrasi.a-pengumumangagal', compact('getPeriodeAktif', 'user')));
        } else {
            if ($getPeriodeAktif->status_adm == null) {
                if ($getTanggalSekarang < $getPeriodeAktif->tm_adm) { //Sesi Belum Dibuka
                    $info = 'Tahap Administrasi Belum Dibuka.';
                    return response(view('view-mahasiswa.tutup-sesi', compact('info', 'getPeriodeAktif')));
                } elseif ($getPeriodeAktif->ta_adm < $getTanggalSekarang) { //Sesi Sudah Ditutup
                    $info = 'Tahap Administrasi Sudah Ditutup. Saat ini sedang dilakukan proses Seleksi.';
                    $tglpengumuman = $getPeriodeAktif->tp_adm;
                    return response(view('view-mahasiswa.tutup-sesi', compact('info', 'getPeriodeAktif', 'tglpengumuman')));
                }
            } elseif ($getPeriodeAktif->status_adm == 'Selesai' && $getTanggalSekarang < $getPeriodeAktif->tm_wwn) { //Sesi Sudah Selesai dan Diumumkan
                $user = ''; //kondisi user yang diambil dari database
                $tanggal_wawancara = '2022-04-31 14:00:00'; //kondisi user yang diambil dari database
                if ($user == 'lolos') {
                    return response(view('view-mahasiswa.administrasi.a-pengumumanlolos', compact('getPeriodeAktif', 'user', 'tanggal_wawancara')));
                }
            } elseif ($getPeriodeAktif->status_adm == 'Selesai' && $getTanggalSekarang >= $getPeriodeAktif->tm_wwn) {
                $user = ''; //kondisi user yang diambil dari database
                if ($user == 'lolos') {
                    return redirect(route('tahap.wawancara'));
                } else {
                    return response(view('view-mahasiswa.administrasi.a-pengumumangagal', compact('getPeriodeAktif', 'user')));
                }
            }
        }
        return $next($request);
        // } elseif ($getPeriodeAktif->status_adm == 'Selesai') {
        //     if ($getTanggalSekarang < $getPeriodeAktif->tm_wwn) { //Sesi Belum Dibuka
        //         $info = 'Tahap Wawancara Belum Dibuka.';
        //         return redirect(route('tahap.wawancara'));
        //         return response(view('view-mahasiswa.tutup-sesi', compact('info', 'getPeriodeAktif')));
        //     } elseif ($getTanggalSekarang > $getPeriodeAktif->ta_wwn) { //Sesi Sudah Ditutup
        //         $info = 'Tahap Wawancara Sudah Ditutup.';
        //         return redirect(route('tahap.wawancara'));
        //         return response(view('view-mahasiswa.tutup-sesi', compact('info', 'getPeriodeAktif')));
        //     }
        // } elseif ($getPeriodeAktif->status_adm == 'Selesai' && $getPeriodeAktif->status_wwn == 'Selesai') {
        //     if ($getTanggalSekarang < $getPeriodeAktif->tm_wwn) { //Sesi Belum Dibuka
        //         $info = 'Tahap Wawancara Belum Dibuka.';
        //         return redirect(route('tahap.penugasan'));
        //         return response(view('view-mahasiswa.tutup-sesi', compact('info', 'getPeriodeAktif')));
        //     } elseif ($getTanggalSekarang > $getPeriodeAktif->ta_wwn) { //Sesi Sudah Ditutup
        //         $info = 'Tahap Wawancara Sudah Ditutup.';
        //         return redirect(route('tahap.penugasan'));
        //         return response(view('view-mahasiswa.tutup-sesi', compact('info', 'getPeriodeAktif')));
        //     }
        // }

        // $periodeaktif = Periode::where('status', '=', 'buka')->first();
        // $namaauth = auth()->user()->name;
        // if (!$periodeaktif) {
        //     auth()->logout();
        //     $request->session()->invalidate();
        //     $request->session()->regenerateToken();
        //     Alert::warning('Maaf ' . $namaauth . ' ! Untuk saat ini tidak terdapat Program Beasiswa.', 'Semangat mencari program beasiswa lainnya awokwok.');
        //     // return response(view('welcome'));
        //     return redirect(route('welcome'));
        // }
        // $mulaitanggaltahap1 = $periodeaktif->tglmulai;
        // $batastanggaltahap1 = $periodeaktif->tglakhir;
        // $tanggalsekarang = Carbon::now()->format('Y-m-d');
        // if ($tanggalsekarang < $mulaitanggaltahap1) {
        //     auth()->logout();
        //     $request->session()->invalidate();
        //     $request->session()->regenerateToken();
        //     // Alert::warning('Maaf ' . $namaauth . ' ! Pendaftaran ' . $periodeaktif->name . ' belum dibuka.', 'Tahap Pendaftaran dapat di Akses mulai tanggal ' . Carbon::parse($mulaitanggaltahap1)->format('l, d F Y'));
        //     // return response(view('welcome'));
        //     return redirect(route('welcome'));
        // } elseif ($tanggalsekarang > $batastanggaltahap1) {
        //     auth()->logout();
        //     $request->session()->invalidate();
        //     $request->session()->regenerateToken();
        //     // Alert::warning('Maaf ' . $namaauth . ' ! Pendaftaran ' . $periodeaktif->name . ' sudah berakhir.', 'Anda tidak dapat melanjutkan Pendaftaran.');
        //     // return response(view('welcome'));
        //     return redirect(route('welcome'));
        // }
    }
}
