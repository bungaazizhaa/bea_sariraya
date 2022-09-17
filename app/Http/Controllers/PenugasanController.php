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
use Illuminate\Support\Facades\Validator;

class PenugasanController extends Controller
{
    //! Menampilkan Halaman Penugasan Mahasiswa
    public function index()
    {
        $info = '';
        $getTanggalSekarang = Carbon::now()->format('Y-m-d');
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
        $getAdministrasiUser = Administrasi::where('user_id', '=', Auth::user()->id)->where('periode_id', '=', $getPeriodeAktif->id_periode)->first();
        if (isset($getAdministrasiUser->wawancara)) {
            $getPenugasanUser = $getAdministrasiUser->wawancara->penugasan;
            return view('view-mahasiswa.penugasan.p-index', compact('info', 'getTanggalSekarang', 'getPeriodeAktif', 'getAdministrasiUser', 'getPenugasanUser'));
        } else {
            return view('view-mahasiswa.penugasan.p-index', compact('info', 'getTanggalSekarang', 'getPeriodeAktif', 'getAdministrasiUser'));
        }
    }

    //! Menampilkan Halaman Penilaian Tugas
    public function nilaiPng($name)
    {
        $getAllPeriode = Periode::all();
        $getTanggalSekarang = Carbon::now()->format('Y-m-d');
        $periodeOpenned = Periode::where('name', '=', $name)->first();
        $administrasiOpenned = Administrasi::where('periode_id', '=', $periodeOpenned->id_periode)->pluck('id');
        // dd($administrasiOpenned);
        $wawancaraOpenned = Wawancara::whereIn('administrasi_id', $administrasiOpenned)->pluck('id');
        $penugasanOpenned = Penugasan::whereIn('wawancara_id', $wawancaraOpenned)->filter(request(['search']))->paginate(1)->onEachSide(0)->withQueryString();
        return view('view-admin.penugasan.nilai-penugasan', compact('getTanggalSekarang', 'periodeOpenned', 'wawancaraOpenned', 'penugasanOpenned', 'getAllPeriode'));
    }

    //! Memperbarui Penilaian Tugas
    public function updatenilaiPng(Request $request, $id)
    {
        $penugasanSelected = Penugasan::where('id', '=', $id)->first();
        $penugasanSelected->status_png = $request->status_png;
        $penugasanSelected->catatan = $request->catatan;
        $penugasanSelected->save();
        toast('Penugasan ' . $penugasanSelected->wawancara->administrasi->user->name . ' sudah di Perbarui', 'success');
        // Alert::success('Penugasan ' . $penugasanSelected->wawancara->administrasi->user->name . ' sudah di Perbarui', 'Data telah tersimpan.');
        return redirect()->back();
    }

    //! Memperbarui Jawaban Tugas Mahasiswa
    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'field_jawaban' => 'string|nullable',
            'file_jawaban' => 'mimes:jpeg,png,jpg,pdf|max:2048|nullable'
        ]);

        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();

        $getAdministrasiUser = Administrasi::where('user_id', '=', Auth::user()->id)->where('periode_id', '=', $getPeriodeAktif->id_periode)->first();

        $getPenugasanUser = $getAdministrasiUser->wawancara->penugasan;
        $id = $getPenugasanUser->id;

        if ($validator->fails()) {
            Alert::error('Gagal melakukan Update.', 'Cek kesalahan Pengisian.');
        }

        $validator->validated();

        if (isset($request->file_jawaban)) {
            $path = $getPeriodeAktif->name . '/' . $getAdministrasiUser->user->id . '/';
            $file = $request->file('file_jawaban');
            $new_image_name = 'FileJawaban-' . date('-Ymd-H.i.s.') . $file->extension();
            $upload = $file->move(public_path($path), $new_image_name);

            if ($upload) {
                $userInfo =  $getPenugasanUser->file_jawaban;
                if ($userInfo != '') {
                    unlink($path . $userInfo);
                }

                $getPenugasanUser = Penugasan::find($id)->update(['file_jawaban' => $new_image_name]);
                // Alert::success('Foto Berhasil Diupload.', 'Anda dapat melanjutkan ke Proses Penerimaan Beasiswa.');
                // return redirect(route('tahap.administrasi'));
            } else {
                Alert::error('Gagal Upload!', 'Data Penugasan Gagal Disimpan.');
                return back();
            }
        }
        $getPenugasanUser = Penugasan::find($id)->update(['field_jawaban' => $request->field_jawaban]);

        if ($getPenugasanUser) {
            Alert::success('Jawaban Tugas telah Tersimpan.', 'Silahkan tunggu hasil seleksi keseluruhan sesuai dengan waktu yang sudah ditentukan. ')->autoClose(false);
        }
        return back();
    }

    //! Menghapus File Jawaban Tugas
    public function filejawabanDestroy($id)
    {
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
        $getAdministrasiUser = Administrasi::where('user_id', '=', Auth::user()->id)->where('periode_id', '=', $getPeriodeAktif->id_periode)->first();
        $getPenugasanUser = $getAdministrasiUser->wawancara->penugasan;
        $path = $getPeriodeAktif->name . '/' . $getAdministrasiUser->user->id . '/';
        unlink($path . $getPenugasanUser->file_jawaban);
        $getPenugasanUser->file_jawaban = null;
        $getPenugasanUser->save();
        Alert::success('Data Terhapus!', 'Data Penugasan Telah Diperbarui.');
        return back();
    }

    //! Mengumumkan Tahap Penugasan (Menyatakan Selesai)
    public function setSelesaiPenugasan($name)
    {

        $periodeSelected = Periode::where('name', '=', $name)->first();
        if ($periodeSelected->group_wa == null) {
            Alert::error('Gagal! Mohon isi link Group WhatsApp ' . ucfirst($periodeSelected->name) . ' terlebih Dahulu! ', 'Terimakasih.');
            return back();
        }
        $periodeSelected->status_png = 'Selesai';
        $periodeSelected->ts_png = now();
        $periodeSelected->save();

        if ($periodeSelected) {
            Alert::success('Tahap Penugasan ' . ucfirst($periodeSelected->name) . ' diatur menjadi Selesai.', 'Sekarang Anda dapat mengirimkan Email Pengumuman Penugasan melalui Tombol Umumkan. Selanjutnya adalah menunggu peserta bergabung pada Grup Whatsapp.')->autoClose(false);
            return redirect(route('periode', $name));
        } else {
            Alert::error('Tahap Penugasan ' . ucfirst($periodeSelected->name) . ' Gagal Diumumkan.', 'Cek data kembali.');
            return redirect(route('periode', $name));
        }
    }
}
