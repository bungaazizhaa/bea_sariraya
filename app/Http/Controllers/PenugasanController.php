<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Periode;
use App\Models\Administrasi;
use App\Models\Penugasan;
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
        $getTanggalSekarang = Carbon::now()->format('Y-m-d');
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();

        $validator = Validator::make($request->all(), [
            // 'tempat_lahir' => 'string|max:255',
            // 'tanggal_lahir' => 'date|date_format:Y-m-d',
            // 'semester' => 'numeric|between:6,14',
            // 'ipk' => 'numeric|between:0,4.00',
            // 'keahlian' => 'string|max:255',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal melakukan Update.', 'Cek kesalahan Pengisian.');
        }

        $validator->validated();

        $getAdministrasiUser = Administrasi::where('user_id', '=', Auth::user()->id)->where('periode_id', '=', $getPeriodeAktif->id_periode)->first();
        // dd($getAdministrasiUser);
        $getPenugasanUser = $getAdministrasiUser->wawancara->penugasan;
        $id = $getPenugasanUser->id;
        $getPenugasanUser = Penugasan::find($id);
        $getPenugasanUser->field_jawaban = $request->field_jawaban;
        $getPenugasanUser->file_jawaban = $request->file_jawaban;
        $getPenugasanUser->touch();
        $getPenugasanUser->save();
        Alert::success('Data Berhasil Di Update.', 'Data baru telah tersimpan.');

        return redirect(route('tahap.wawancara'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
