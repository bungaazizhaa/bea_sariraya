<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Periode;
use App\Models\Penugasan;
use App\Models\Administrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class PenugasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $info = '';
        $getTanggalSekarang = Carbon::now()->format('Y-m-d');
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
        $getAdministrasiUser = Administrasi::where('user_id', '=', Auth::user()->id)->where('periode_id', '=', $getPeriodeAktif->id_periode)->first();
        $getPenugasanUser = $getAdministrasiUser->wawancara->penugasan;
        return view('view-mahasiswa.penugasan.p-index', compact('info', 'getTanggalSekarang', 'getPeriodeAktif', 'getAdministrasiUser', 'getPenugasanUser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();

        $getAdministrasiUser = Administrasi::where('user_id', '=', Auth::user()->id)->where('periode_id', '=', $getPeriodeAktif->id_periode)->first();
        // dd($getAdministrasiUser);
        $getPenugasanUser = $getAdministrasiUser->wawancara->penugasan;
        $id = $getPenugasanUser->id;
        if (isset($request->field_jawaban)) {
            $validator = Validator::make($request->all(), [
                'field_jawaban' => 'string',
            ]);
        }

        if (isset($request->file_jawaban)) {
            $validator = Validator::make($request->all(), [
                'file_jawaban' => 'mimes:jpeg,png,jpg,pdf|max:5120'
            ]);
        }

        if (isset($request->field_jawaban) || isset($request->file_jawaban) && $validator->fails()) {
            Alert::error('Gagal melakukan Update.', 'Cek kesalahan Pengisian.');
        }
        if (isset($request->field_jawaban) || isset($request->file_jawaban)) {
            $validator->validated();
        }

        if (isset($request->file_jawaban)) {
            $path = $getPeriodeAktif->name . '/' . $getAdministrasiUser->user->id . '-' . str_replace(' ', '-', $getAdministrasiUser->user->name) . '/';
            $file = $request->file('file_jawaban');
            $new_image_name = 'FileJawaban-' . str_replace(' ', '-', $getAdministrasiUser->user->name) .  date('-Ymd-H.i.s.') . $file->extension();
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
            Alert::success('Berhasil!', 'Data Penugasan Telah Disimpan.');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filejawabanDestroy($id)
    {
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
        $getAdministrasiUser = Administrasi::where('user_id', '=', Auth::user()->id)->where('periode_id', '=', $getPeriodeAktif->id_periode)->first();
        $getPenugasanUser = $getAdministrasiUser->wawancara->penugasan;
        $path = $getPeriodeAktif->name . '/' . $getAdministrasiUser->user->id . '-' . str_replace(' ', '-', $getAdministrasiUser->user->name) . '/';
        unlink($path . $getPenugasanUser->file_jawaban);
        $getPenugasanUser->file_jawaban = null;
        $getPenugasanUser->save();
        Alert::success('Data Terhapus!', 'Data Penugasan Telah Diperbarui.');
        return back();
    }
}
