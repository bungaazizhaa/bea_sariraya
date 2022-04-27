<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Univ;
use App\Models\Periode;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    protected $periodeOpenned;
    public function indexPeriodeById($id)
    {
        $getAllUniv = Univ::all();
        $getAllPeriode = Periode::all();
        $getTanggalSekarang = Carbon::now()->format('Y-m-d');
        $periodeOpenned = Periode::find($id);
        return view('view-admin.periode.p-indexid', compact('periodeOpenned', 'getAllUniv', 'getAllPeriode', 'getTanggalSekarang'));
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
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tm_adm' => 'required|date|date_format:d-m-Y',
            'ta_adm' => 'required|date|date_format:d-m-Y',
            'tp_adm' => 'required|date|date_format:d-m-Y',
            // 'status_adm' => 'string',
            'tm_wwn' => 'required|date|date_format:d-m-Y',
            'ta_wwn' => 'required|date|date_format:d-m-Y',
            'tp_wwn' => 'required|date|date_format:d-m-Y',
            // 'status_wwn' => 'string',
            'tm_png' => 'required|date|date_format:d-m-Y',
            'ta_png' => 'required|date|date_format:d-m-Y',
            'tp_png' => 'required|date|date_format:d-m-Y',
            // 'status_png' => 'string',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal melakukan Update.', 'Cek kesalahan Pengisian.');
            // var_dump($validator);
        }
        $validator->validated();

        $periode = Periode::find($id);
        $periode->tm_adm = $request->tm_adm;
        $periode->ta_adm = $request->ta_adm;
        $periode->tp_adm = $request->tp_adm;
        $periode->status_adm = $request->status_adm;
        $periode->tm_wwn = $request->tm_wwn;
        $periode->ta_wwn = $request->ta_wwn;
        $periode->tp_wwn = $request->tp_wwn;
        $periode->status_wwn = $request->status_wwn;
        $periode->tm_png = $request->tm_png;
        $periode->ta_png = $request->ta_png;
        $periode->tp_png = $request->tp_png;
        $periode->status_png = $request->status_png;
        $periode->status = $request->status;
        $periode->save();
        Alert::success('Berhasil!', 'Data Periode Telah Diperbarui.');
        return redirect(route('periode', $periode->id));
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
