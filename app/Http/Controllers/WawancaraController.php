<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Periode;
use App\Models\Penugasan;
use App\Models\Wawancara;
use App\Models\Administrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class WawancaraController extends Controller
{
    //! Menampilkan Halaman Wawancara Mahasiswa
    public function index()
    {
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
        $getAdministrasiUser = Administrasi::where('user_id', '=', Auth::user()->id)->where('periode_id', '=', $getPeriodeAktif->id_periode)->first();
        $tanggal_wawancara = $getAdministrasiUser->wawancara->jadwal_wwn;
        return view('view-mahasiswa.wawancara.w-index', compact('tanggal_wawancara', 'getAdministrasiUser', 'getPeriodeAktif'));
    }

    //! Menampilkan Halaman Penilaian Wawancara Admin
    public function nilaiWwn($name)
    {
        $getAllPeriode = Periode::all();
        $getTanggalSekarang = Carbon::now()->format('Y-m-d');
        $periodeOpenned = Periode::where('name', '=', $name)->first();
        $administrasiOpenned = Administrasi::where('periode_id', '=', $periodeOpenned->id_periode)->pluck('id');
        // dd($administrasiOpenned);
        $wawancaraOpenned = Wawancara::whereIn('administrasi_id', $administrasiOpenned)->filter(request(['search']))->orderBy('jadwal_wwn', 'asc')->paginate(1)->onEachSide(0)->withQueryString();
        return view('view-admin.wawancara.nilai-wawancara', compact('getTanggalSekarang', 'periodeOpenned', 'wawancaraOpenned', 'getAllPeriode'));
    }

    //! Memperbarui Penilaian Wawancara
    public function updatenilaiWwn(Request $request, $id)
    {
        $wawancaraSelected = Wawancara::where('id', '=', $id)->first();
        $wawancaraSelected->status_wwn = $request->status_wwn;
        $wawancaraSelected->catatan = $request->catatan;
        $wawancaraSelected->save();
        toast('Wawancara ' . $wawancaraSelected->administrasi->user->name . ' sudah di Perbarui', 'success');
        // Alert::success('Wawancara ' . $wawancaraSelected->administrasi->user->name . ' sudah di Perbarui', 'Data telah tersimpan.');
        if ($request->status_wwn == 'lolos') {
            if (isset($wawancaraSelected->penugasan->id)) {
                $penugasan = Penugasan::where('wawancara_id', '=', $wawancaraSelected->id)->first();
                $penugasan->soal = $request->soal;
                $penugasan->touch();
                $penugasan->save();
            } else {
                Penugasan::create([
                    'wawancara_id' => $id,
                    'soal' => $request['soal'],
                ]);
            }
            toast('Wawancara ' . $wawancaraSelected->administrasi->user->name . ' sudah di Nilai', 'success');
            // Alert::success('Wawancara ' . $wawancaraSelected->administrasi->user->name . ' sudah di Nilai', 'Data telah tersimpan.');
        } elseif ($request->status_wwn == 'gagal') {
            if (isset($wawancaraSelected->penugasan->id)) {
                $penugasan = Penugasan::where('wawancara_id', '=', $wawancaraSelected->id)->first();
                $penugasan->delete();
            }
            toast('Wawancara ' . $wawancaraSelected->administrasi->user->name . ' sudah di Nilai', 'success');
            // Alert::success('Wawancara ' . $wawancaraSelected->administrasi->user->name . ' sudah di Nilai', 'Data telah tersimpan.');
        }

        return redirect()->back();
    }

    //! Mengumumkan Tahap Wawancara (Menyatakan Selesai)
    public function setSelesaiWawancara($name)
    {

        $periodeSelected = Periode::where('name', '=', $name)->first();

        $periodeSelected->status_wwn = 'Selesai';
        $periodeSelected->ts_wwn = now();
        $periodeSelected->save();

        if ($periodeSelected) {
            Alert::success('Tahap Wawancara ' . ucfirst($periodeSelected->name) . ' diatur menjadi Selesai.', 'Sekarang Anda dapat mengirimkan Email Pengumuman Wawancara melalui Tombol Umumkan. Selanjutnya adalah Tahap Penugasan.')->autoClose(false);
            return redirect(route('periode', $name));
        } else {
            Alert::error('Tahap Wawancara ' . ucfirst($periodeSelected->name) . ' Gagal Diumumkan.', 'Cek data kembali.');
            return redirect(route('periode', $name));
        }
    }
}
