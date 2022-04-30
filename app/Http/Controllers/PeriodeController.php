<?php

namespace App\Http\Controllers;

use App\Models\Administrasi;
use App\Models\Penugasan;
use Carbon\Carbon;
use App\Models\Univ;
use App\Models\Periode;
use App\Models\Wawancara;
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

    public function indexPeriodeById($name)
    {
        $getAllUniv = Univ::all();
        $getAllPeriode = Periode::all();
        $getTanggalSekarang = Carbon::now()->format('Y-m-d');
        $periodeOpenned = Periode::where('name', '=', $name)->first();
        $getAllAdmLolos = Administrasi::where('periode_id', '=', $periodeOpenned->id_periode)->where('status_adm', '=', 'lolos')->get();
        $getAllAdmGagal = Administrasi::where('periode_id', '=', $periodeOpenned->id_periode)->where('status_adm', '!=', 'lolos')->get();
        $administrasiOpenned = Administrasi::where('periode_id', '=', $periodeOpenned->id_periode)->pluck('id');
        $getAllWwnLolos = Wawancara::whereIn('administrasi_id', $administrasiOpenned)->where('status_wwn', '=', 'lolos')->get();
        $getAllWwnGagal = Wawancara::whereIn('administrasi_id', $administrasiOpenned)->where('status_wwn', '=', 'gagal')->get();
        $wawancaraOpenned = Wawancara::whereIn('administrasi_id', $administrasiOpenned)->pluck('id');
        $getAllPngLolos = Penugasan::whereIn('wawancara_id', $wawancaraOpenned)->where('status_png', '=', 'lolos')->get();
        $getAllPngGagal = Penugasan::whereIn('wawancara_id', $wawancaraOpenned)->where('status_png', '=', 'gagal')->get();
        return view('view-admin.periode.periodeid-index', compact('periodeOpenned', 'getAllUniv', 'getAllPeriode', 'getTanggalSekarang', 'getAllAdmLolos', 'getAllAdmGagal', 'getAllWwnLolos', 'getAllWwnGagal', 'getAllPngLolos', 'getAllPngGagal'));
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
        $validator = Validator::make($request->all(), [
            'id_periode' => 'required|integer|unique:periodes',
            'name' => 'required|unique:periodes|string|max:255',
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
            Alert::error('Gagal melakukan Penambahan Periode.', 'Cek kesalahan Pengisian.');
            // var_dump($validator);
        }
        $validator->validated();

        Periode::create([
            'id_periode' => $request['id_periode'],
            'name' => $request['name'],
            'tm_adm' => $request['tm_adm'],
            'ta_adm' => $request['ta_adm'],
            'tp_adm' => $request['tp_adm'],
            'status_adm' => null,
            'tm_wwn' => $request['tm_wwn'],
            'ta_wwn' => $request['ta_wwn'],
            'tp_wwn' => $request['tp_wwn'],
            'status_wwn' => null,
            'tm_png' => $request['tm_png'],
            'ta_png' => $request['ta_png'],
            'tp_png' => $request['tp_png'],
            'status_png' => null,
            'status' => 'nonaktif',
        ]);
        mkdir($request['name']);
        Alert::success('Berhasil membuat Periode Baru!', 'Data Periode telah dibuat.');
        return redirect(route('periode', $request['name']));
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

    public function umumkanAdm($name)
    {
        $periodeSelected = Periode::where('name', '=', $name)->first();
        $periodeSelected->status_adm = 'Selesai';
        $periodeSelected->save();

        Alert::success('Tahap Administrasi ' . ucfirst($periodeSelected->name) . ' sudah Diumumkan.', 'Selanjutnya adalah Tahap Wawancara.');
        return redirect(route('periode', $name));
        // 
    }

    public function umumkanWwn($name)
    {
        $periodeSelected = Periode::where('name', '=', $name)->first();
        $periodeSelected->status_wwn = 'Selesai';
        $periodeSelected->save();

        Alert::success('Tahap Wawancara ' . ucfirst($periodeSelected->name) . ' sudah Diumumkan.', 'Selanjutnya adalah Tahap Penugasan.');
        return redirect(route('periode', $name));
        // 
    }

    public function umumkanPng($name)
    {
        $periodeSelected = Periode::where('name', '=', $name)->first();
        $periodeSelected->status_png = 'Selesai';
        $periodeSelected->save();

        Alert::success('Tahap Wawancara ' . ucfirst($periodeSelected->name) . ' sudah Diumumkan.', 'Selanjutnya adalah membuat Group WhatsApp.');
        return redirect(route('periode', $name));
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $name)
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
        $periodeAktif = Periode::where('status', '=', 'aktif')->whereNotIn('name', array($name))->get();
        $periode = Periode::where('name', '=', $name)->first();
        if ($periode->id_periode != $request->id_periode) {
            $validator = Validator::make($request->all(), [
                'id_periode' => 'required|unique:periodes|integer',
            ]);
            if ($validator->fails()) {
                Alert::error('Gagal melakukan Update.', 'Cek kesalahan Pengisian.');
                // var_dump($validator);
            }
            $validator->validated();
            $periode->id_periode = $request->id_periode;
        }
        if ($name != $request->name) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:periodes',
            ]);
            if ($validator->fails()) {
                Alert::error('Gagal melakukan Update.', 'Cek kesalahan Pengisian.');
                // var_dump($validator);
            }
            $validator->validated();
            $periode->name = $request->name;
            rename($name, $request->name);
        }

        $periode->tp_adm = $request->tp_adm;
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
        foreach ($periodeAktif as $data) {
            $data->status = 'nonaktif';
            $data->save();
        }
        $periode->status = $request->status;
        $periode->save();
        Alert::success('Berhasil!', 'Data Periode Telah Diperbarui.');
        return redirect(route('periode', $periode->name));
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
