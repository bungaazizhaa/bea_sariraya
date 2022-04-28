<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Periode;
use App\Models\Administrasi;
use App\Models\Wawancara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class AdministrasiController extends Controller
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

        if (isset($getAdministrasiUser)) {
            return view('view-mahasiswa.administrasi.a-index', compact('info', 'getPeriodeAktif', 'getTanggalSekarang', 'getAdministrasiUser'));
        } else {
            return view('view-mahasiswa.administrasi.a-index', compact('info', 'getPeriodeAktif', 'getTanggalSekarang'));
        }
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


    public function nilaiAdm($name)
    {
        $getAllPeriode = Periode::all();
        $getTanggalSekarang = Carbon::now()->format('Y-m-d');
        $periodeOpenned = Periode::where('name', '=', $name)->first();
        $administrasiOpenned = Administrasi::where('periode_id', '=', $periodeOpenned->id_periode)->paginate(1);
        return view('view-admin.administrasi.nilai-administrasi', compact('getTanggalSekarang', 'periodeOpenned', 'administrasiOpenned', 'getAllPeriode'));
    }

    public function updatenilaiAdm(Request $request, $id)
    {
        $administrasiSelected = Administrasi::where('id', '=', $id)->first();
        $administrasiSelected->status_adm = $request->status_adm;
        $administrasiSelected->catatan = $request->catatan;
        $administrasiSelected->save();
        Alert::success('Administrasi ' . $administrasiSelected->user->name . ' sudah di Perbarui', 'Data telah tersimpan.');
        if ($request->status_adm == 'lolos') {
            if (isset($administrasiSelected->wawancara->id)) {
                $wawancara = Wawancara::where('administrasi_id', '=', $administrasiSelected->id)->first();
                $wawancara->jadwal_wwn = $request->jadwal_wwn;
                $wawancara->touch();
                $wawancara->save();
            } else {
                Wawancara::create([
                    'administrasi_id' => $administrasiSelected->id,
                    'jadwal_wwn' => $request['jadwal_wwn'],
                ]);
            }
            Alert::success('Administrasi ' . $administrasiSelected->user->name . ' sudah di Nilai', 'Data telah tersimpan.');
        } elseif ($request->status_adm == 'gagal') {
            if (isset($administrasiSelected->wawancara->id)) {
                $wawancara = Wawancara::where('administrasi_id', '=', $administrasiSelected->id)->first();
                $wawancara->delete();
            }
            Alert::success('Administrasi ' . $administrasiSelected->user->name . ' sudah di Nilai', 'Data telah tersimpan.');
        }

        return redirect()->back();
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


    public function detailAdm()
    {
        $getTanggalSekarang = Carbon::now()->format('Y-m-d');
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
        $getAdministrasiUser = Administrasi::where('user_id', '=', Auth::user()->id)->where('periode_id', '=', $getPeriodeAktif->id_periode)->first();

        if (isset($getAdministrasiUser) && $getTanggalSekarang > $getPeriodeAktif->ta_adm) {
            return view('view-mahasiswa.administrasi.a-detail', compact('getPeriodeAktif', 'getTanggalSekarang', 'getAdministrasiUser'));
        } else {
            return redirect(route('tahap.administrasi'));
        }
    }

    public function update(Request $request)
    {
        $getTanggalSekarang = Carbon::now()->format('Y-m-d');
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
        // if ($getPeriodeAktif->ta_adm < $getTanggalSekarang) { //Update melebihi Batas Tanggal akan Tidak Akan Disimpan 
        //     Alert::error('Terlambat melakukan Update.', 'Maaf, Data Anda tidak Disimpan.');
        //     return redirect(route('tahap.administrasi'));
        // } else {
        $validator = Validator::make($request->all(), [
            'tempat_lahir' => 'string|max:255',
            'tanggal_lahir' => 'date|date_format:Y-m-d',
            'semester' => 'numeric|between:6,14',
            'ipk' => 'numeric|between:0,4.00',
            'keahlian' => 'string|max:255',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal melakukan Update.', 'Cek kesalahan Pengisian.');
        }

        $validator->validated();

        $getAdministrasiUser = Administrasi::where('user_id', '=', Auth::user()->id)->where('periode_id', '=', $getPeriodeAktif->id_periode)->first();
        // dd($getAdministrasiUser);
        if ($getAdministrasiUser != null) { //Jika Sudah Ada maka di Update
            $id = $getAdministrasiUser->id;
            $administrasi = Administrasi::find($id);
            $administrasi->tempat_lahir = $request->tempat_lahir;
            $administrasi->tanggal_lahir = $request->tanggal_lahir;
            $administrasi->semester = $request->semester;
            $administrasi->ipk = $request->ipk;
            $administrasi->keahlian = $request->keahlian;
            $administrasi->touch();
            $administrasi->save();
            Alert::success('Data Berhasil Di Update.', 'Data baru telah tersimpan.');
        } else {
            Administrasi::create([
                'no_pendaftaran' => strtoupper($request['periode_id'] . uniqid()),
                'user_id' => Auth::user()->id,
                'periode_id' => $getPeriodeAktif->id_periode,
                'tempat_lahir' => $request['tempat_lahir'],
                'tanggal_lahir' => $request['tanggal_lahir'],
                'semester' => $request['semester'],
                'ipk' => $request['ipk'],
                'keahlian' => $request['keahlian'],
            ]);
            Alert::success('Data Administrasi Anda Berhasil Di Tambahkan.', 'Anda dapat mengubahnya kembali.');
        }
        // }
        return redirect(route('tahap.administrasi'));
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
