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
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getAllPeriode = Periode::all();
        $getPeriodeLast = Periode::orderBy('id_periode', 'desc')->value('id_periode');
        $getTanggalSekarang = Carbon::now()->format('Y-m-d');
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
        return view('view-admin.periode.periode-index', compact('getAllPeriode', 'getPeriodeLast', 'getTanggalSekarang', 'getPeriodeAktif'));
    }

    public function indexPeriodeById($name)
    {
        $getAllUniv = Univ::all();
        $getAllPeriode = Periode::all();
        $getTanggalSekarang = Carbon::now()->format('Y-m-d');
        $periodeOpenned = Periode::where('name', '=', $name)->first();
        $getAdministrasiUser = Administrasi::with('user')->where('periode_id', '=', $periodeOpenned->id_periode)
            ->leftJoin('wawancaras', 'wawancaras.administrasi_id', '=', 'administrasis.id')
            ->leftJoin('penugasans', 'penugasans.wawancara_id', '=', 'wawancaras.id')
            ->leftJoin('users', 'users.id', '=', 'administrasis.user_id')
            ->leftJoin('univs', 'univs.id', '=', 'users.univ_id')
            ->leftJoin('prodis', 'prodis.id', '=', 'users.prodi_id')
            ->get();
        $getAllAdmLolos = Administrasi::with('user')->where('periode_id', '=', $periodeOpenned->id_periode)->where('status_adm', '=', 'lolos')
            ->leftJoin('wawancaras', 'wawancaras.administrasi_id', '=', 'administrasis.id')
            ->leftJoin('users', 'users.id', '=', 'administrasis.user_id')
            ->orderBy('jadwal_wwn', 'asc')->get();
        $getAllAdmGagal = Administrasi::with('user')->where('periode_id', '=', $periodeOpenned->id_periode)->where('status_adm', '!=', 'lolos')
            ->leftJoin('users', 'users.id', '=', 'administrasis.user_id')->get();
        $administrasiOpenned = Administrasi::with('user')->where('periode_id', '=', $periodeOpenned->id_periode)->pluck('id');
        $getAllWwnLolos = Wawancara::with('user')->whereIn('administrasi_id', $administrasiOpenned)->where('status_wwn', '=', 'lolos')
            ->leftJoin('administrasis', 'administrasis.id', '=', 'wawancaras.administrasi_id')
            ->leftJoin('users', 'users.id', '=', 'administrasis.user_id')
            ->leftJoin('penugasans', 'penugasans.wawancara_id', '=', 'wawancaras.id')
            ->get();
        $getAllWwnGagal = Wawancara::with('user')->whereIn('administrasi_id', $administrasiOpenned)->where('status_wwn', '=', 'gagal')
            ->leftJoin('administrasis', 'administrasis.id', '=', 'wawancaras.administrasi_id')
            ->leftJoin('users', 'users.id', '=', 'administrasis.user_id')
            ->get();
        $wawancaraOpenned = Wawancara::with('user')->whereIn('administrasi_id', $administrasiOpenned)->pluck('id');
        $getAllPngLolos = Penugasan::whereIn('wawancara_id', $wawancaraOpenned)->where('status_png', '=', 'lolos')
            ->leftJoin('wawancaras', 'wawancaras.id', '=', 'penugasans.wawancara_id')
            ->leftJoin('administrasis', 'wawancaras.administrasi_id', '=', 'administrasis.id')
            ->leftJoin('users', 'users.id', '=', 'administrasis.user_id')
            ->get();
        $getAllPngGagal = Penugasan::whereIn('wawancara_id', $wawancaraOpenned)->where('status_png', '=', 'gagal')
            ->leftJoin('wawancaras', 'wawancaras.id', '=', 'penugasans.wawancara_id')
            ->leftJoin('administrasis', 'wawancaras.administrasi_id', '=', 'administrasis.id')
            ->leftJoin('users', 'users.id', '=', 'administrasis.user_id')
            ->get();
        return view('view-admin.periode.periodeid-index', compact('periodeOpenned', 'getAllUniv', 'getAllPeriode', 'getTanggalSekarang', 'getAllAdmLolos', 'getAllAdmGagal', 'getAllWwnLolos', 'getAllWwnGagal', 'getAllPngLolos', 'getAllPngGagal', 'getAdministrasiUser'));
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
            'tm_adm' => 'required|date|date_format:d F Y',
            'ta_adm' => 'required|date|date_format:d F Y',
            'tp_adm' => 'required|date|date_format:d F Y',
            // 'status_adm' => 'string',
            'tm_wwn' => 'required|date|date_format:d F Y',
            'ta_wwn' => 'required|date|date_format:d F Y',
            'tp_wwn' => 'required|date|date_format:d F Y',
            // 'status_wwn' => 'string',
            'tm_png' => 'required|date|date_format:d F Y',
            'ta_png' => 'required|date|date_format:d F Y',
            'tp_png' => 'required|date|date_format:d F Y',
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
        if ($periodeSelected->teknis_wwn == null) {
            Alert::error('Gagal! Mohon isi Teknis Wawancara ' . ucfirst($periodeSelected->name) . ' terlebih Dahulu! ', 'Terimakasih.');
            return back();
        }

        $periodeSelected->status_adm = 'Selesai';
        $periodeSelected->ts_adm = now();
        $periodeSelected->save();

        Alert::success('Tahap Administrasi ' . ucfirst($periodeSelected->name) . ' sudah Diumumkan.', 'Selanjutnya adalah Tahap Wawancara.');
        return redirect(route('periode', $name));
        // 
    }

    public function umumkanWwn($name)
    {
        $periodeSelected = Periode::where('name', '=', $name)->first();
        $periodeSelected->status_wwn = 'Selesai';
        $periodeSelected->ts_wwn = now();
        $periodeSelected->save();

        Alert::success('Tahap Wawancara ' . ucfirst($periodeSelected->name) . ' sudah Diumumkan.', 'Selanjutnya adalah Tahap Penugasan.');
        return redirect(route('periode', $name));
        // 
    }

    public function umumkanPng($name)
    {
        $periodeSelected = Periode::where('name', '=', $name)->first();
        if ($periodeSelected->group_wa == null) {
            Alert::error('Gagal! Mohon isi link Group WhatsApp ' . ucfirst($periodeSelected->name) . ' terlebih Dahulu! ', 'Terimakasih.');
            return back();
        }
        $periodeSelected->status_png = 'Selesai';
        $periodeSelected->ts_png = now();
        $periodeSelected->save();

        Alert::success('Tahap Penugasan ' . ucfirst($periodeSelected->name) . ' sudah Diumumkan.', 'Selanjutnya adalah menunggu Mahasiswa bergabung ke Group WhatsApp.');
        return redirect(route('periode', $name));
        // 
    }

    public function groupwaUpdate(Request $request, $name)
    {
        $periodeSelected = Periode::where('name', '=', $name)->first();
        $periodeSelected->group_wa = $request->group_wa;
        $periodeSelected->save();
        Alert::success('Link Group WhatsApp ' . ucfirst($periodeSelected->name) . ' sudah Diperbarui.', 'Data Tersimpan.');
        return redirect(route('periode', $name));
    }

    public function tekniswwnUpdate(Request $request, $name)
    {
        $periodeSelected = Periode::where('name', '=', $name)->first();
        $periodeSelected->teknis_wwn = $request->teknis_wwn;
        if ($request == '') {
            $periodeSelected->teknis_wwn = null;
        }
        $periodeSelected->save();
        Alert::success('Teknis Wawancara ' . ucfirst($periodeSelected->name) . ' sudah Diperbarui.', 'Data Tersimpan.');
        return redirect(route('periode', $name));
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
            'tm_adm' => 'required|date|date_format:d F Y',
            'ta_adm' => 'required|date|date_format:d F Y',
            'tp_adm' => 'required|date|date_format:d F Y',
            // 'status_adm' => 'string',
            'tm_wwn' => 'required|date|date_format:d F Y',
            'ta_wwn' => 'required|date|date_format:d F Y',
            'tp_wwn' => 'required|date|date_format:d F Y',
            // 'status_wwn' => 'string',
            'tm_png' => 'required|date|date_format:d F Y',
            'ta_png' => 'required|date|date_format:d F Y',
            'tp_png' => 'required|date|date_format:d F Y',
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
    public function destroy($name)
    {
        $getBatch = Periode::where('name', '=', $name)->first();
        if (isset($getBatch)) {
            if (is_dir(public_path($getBatch->name))) {
                $dir = public_path($getBatch->name);
                $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
                $files = new RecursiveIteratorIterator(
                    $it,
                    RecursiveIteratorIterator::CHILD_FIRST
                );
                foreach ($files as $file) {
                    if ($file->isDir()) {
                        rmdir($file->getRealPath());
                    } else {
                        unlink($file->getRealPath());
                    }
                }
                rmdir($dir);
            }
        }
        $getBatch = Periode::where('name', '=', $name)->first()->delete();

        Alert::success('Periode ' . ucfirst($name) . ' berhasil di Hapus!', 'Daftar periode telah terbarui.');
        return redirect(route('index.periode'));
    }
}
