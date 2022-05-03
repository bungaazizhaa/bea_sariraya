<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Periode;
use App\Models\Wawancara;
use App\Models\Administrasi;
use App\Models\Penugasan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class WawancaraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $info = '';
        return view('view-mahasiswa.wawancara.w-index', compact('info'));
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



    public function nilaiWwn($name)
    {
        $getAllPeriode = Periode::all();
        $getTanggalSekarang = Carbon::now()->format('Y-m-d');
        $periodeOpenned = Periode::where('name', '=', $name)->first();
        $administrasiOpenned = Administrasi::where('periode_id', '=', $periodeOpenned->id_periode)->pluck('id');
        // dd($administrasiOpenned);
        $wawancaraOpenned = Wawancara::whereIn('administrasi_id', $administrasiOpenned)->filter(request(['search']))->paginate(1)->withQueryString();
        return view('view-admin.wawancara.nilai-wawancara', compact('getTanggalSekarang', 'periodeOpenned', 'wawancaraOpenned', 'getAllPeriode'));
    }



    public function updatenilaiWwn(Request $request, $id)
    {
        $wawancaraSelected = Wawancara::where('id', '=', $id)->first();
        $wawancaraSelected->status_wwn = $request->status_wwn;
        $wawancaraSelected->catatan = $request->catatan;
        $wawancaraSelected->save();
        Alert::success('Wawancara ' . $wawancaraSelected->administrasi->user->name . ' sudah di Perbarui', 'Data telah tersimpan.');
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
            Alert::success('Wawancara ' . $wawancaraSelected->administrasi->user->name . ' sudah di Nilai', 'Data telah tersimpan.');
        } elseif ($request->status_wwn == 'gagal') {
            if (isset($wawancaraSelected->penugasan->id)) {
                $penugasan = Penugasan::where('wawancara_id', '=', $wawancaraSelected->id)->first();
                $penugasan->delete();
            }
            Alert::success('Wawancara ' . $wawancaraSelected->administrasi->user->name . ' sudah di Nilai', 'Data telah tersimpan.');
        }

        return redirect()->back();
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
    public function update(Request $request, $id)
    {
        //
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
