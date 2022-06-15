<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Periode;
use App\Models\Wawancara;
use App\Models\Administrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;

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

    public function fileadmDestroy($column)
    {
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
        $getAdministrasiUser = Administrasi::where('user_id', '=', Auth::user()->id)->where('periode_id', '=', $getPeriodeAktif->id_periode)->first();
        $path = $getPeriodeAktif->name . '/' . $getAdministrasiUser->user->id . '/';
        unlink($path . $getAdministrasiUser->$column);
        $getAdministrasiUser->$column = null;
        $getAdministrasiUser->save();
        $column = str_replace("_", " ", $column);
        $column = ucwords($column);
        $column = str_replace("Cv", "CV", $column);
        $column = str_replace("Ktm", "KTM", $column);
        Alert::success('Data ' . $column . ' Terhapus!', 'Data Administrasi Telah Diperbarui.');
        return back();
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
        $administrasiOpenned = Administrasi::where('periode_id', '=', $periodeOpenned->id_periode)->filter(request(['search']))->paginate(1)->withQueryString();
        return view('view-admin.administrasi.nilai-administrasi', compact('getTanggalSekarang', 'periodeOpenned', 'administrasiOpenned', 'getAllPeriode'));
    }

    public function updatenilaiAdm(Request $request, $id)
    {
        $administrasiSelected = Administrasi::where('id', '=', $id)->first();
        $administrasiSelected->status_adm = $request->status_adm;
        $administrasiSelected->catatan = $request->catatan;
        $administrasiSelected->save();
        toast('Administrasi ' . $administrasiSelected->user->name . ' sudah di Perbarui.', 'success');
        // Alert::success('Administrasi ' . $administrasiSelected->user->name . ' sudah di Perbarui', 'Data telah tersimpan.');
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
            toast('Administrasi ' . $administrasiSelected->user->name . ' sudah di Nilai.', 'success');
            // Alert::success('Administrasi ' . $administrasiSelected->user->name . ' sudah di Nilai', 'Data telah tersimpan.');
        } elseif ($request->status_adm == 'gagal') {
            if (isset($administrasiSelected->wawancara->id)) {
                $wawancara = Wawancara::where('administrasi_id', '=', $administrasiSelected->id)->first();
                $wawancara->delete();
            }
            toast('Administrasi ' . $administrasiSelected->user->name . ' sudah di Nilai.', 'success');
            // Alert::success('Administrasi ' . $administrasiSelected->user->name . ' sudah di Nilai', 'Data telah tersimpan.');
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
            'tempat_lahir' => 'string|max:255|nullable',
            'tanggal_lahir' => 'date|date_format:Y-m-d|nullable',
            'semester' => 'numeric|between:6,14|nullable',
            'ipk' => 'numeric|between:0,4.00|nullable',
            'keahlian' => 'string|max:255|nullable',
            'alamat' => 'string|max:255|nullable',
            'file_cv' => 'mimes:pdf,png,jpg,pdf|max:5120|nullable',
            'file_esai' => 'mimes:jpeg,png,jpg,pdf|max:5120|nullable',
            'file_portofolio' => 'mimes:jpeg,png,jpg,pdf|max:5120|nullable',
            'file_ktm' => 'mimes:jpeg,png,jpg,pdf|max:5120|nullable',
            'file_transkrip' => 'mimes:jpeg,png,jpg,pdf|max:5120|nullable',
            'no_wa' => 'string|max:255|nullable',
            'instagram' => 'string|max:255|nullable',
            'facebook' => 'string|max:255|nullable',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal melakukan Update.', 'Cek kesalahan Pengisian.');
        }

        $validator->validated();

        $getAdministrasiUser = Administrasi::where('user_id', '=', Auth::user()->id)->where('periode_id', '=', $getPeriodeAktif->id_periode)->first();
        // dd($getAdministrasiUser);
        if ($getAdministrasiUser != null) { //Jika Sudah Ada maka di Update
            $path = $getPeriodeAktif->name . '/' . $getAdministrasiUser->user->id . '/';
            $id = $getAdministrasiUser->id;
            $administrasi = Administrasi::find($id);
            $administrasi->tempat_lahir = $request->tempat_lahir;
            $administrasi->tanggal_lahir = $request->tanggal_lahir;
            $administrasi->semester = $request->semester;
            $administrasi->ipk = $request->ipk;
            $administrasi->keahlian = $request->keahlian;
            $administrasi->alamat = $request->alamat;
            if (isset($request->file_cv)) {

                $file = $request->file('file_cv');
                $new_file_name = 'FileCV-' . date('Ymd-H.i.s.') . $file->extension();
                $upload = $file->move(public_path($path), $new_file_name);

                if ($upload) {
                    $userInfo =   $administrasi->file_cv;
                    if ($userInfo != '') {
                        unlink($path . $userInfo);
                    }

                    $getAdministrasiUser = Administrasi::find($id)->update(['file_cv' => $new_file_name]);
                } else {
                    Alert::error('Gagal Upload!', 'Data Administrasi Gagal Disimpan.');
                    return back();
                }
            }
            if (isset($request->file_esai)) {
                $file = $request->file('file_esai');
                $new_file_name = 'FileEsai-' . date('Ymd-H.i.s.') . $file->extension();
                $upload = $file->move(public_path($path), $new_file_name);

                if ($upload) {
                    $userInfo =   $administrasi->file_esai;
                    if ($userInfo != '') {
                        unlink($path . $userInfo);
                    }

                    $getAdministrasiUser = Administrasi::find($id)->update(['file_esai' => $new_file_name]);
                } else {
                    Alert::error('Gagal Upload!', 'Data Administrasi Gagal Disimpan.');
                    return back();
                }
            }
            if (isset($request->file_portofolio)) {
                $file = $request->file('file_portofolio');
                $new_file_name = 'FilePortofolio-' . date('Ymd-H.i.s.') . $file->extension();
                $upload = $file->move(public_path($path), $new_file_name);

                if ($upload) {
                    $userInfo =   $administrasi->file_portofolio;
                    if ($userInfo != '') {
                        unlink($path . $userInfo);
                    }

                    $getAdministrasiUser = Administrasi::find($id)->update(['file_portofolio' => $new_file_name]);
                } else {
                    Alert::error('Gagal Upload!', 'Data Administrasi Gagal Disimpan.');
                    return back();
                }
            }
            if (isset($request->file_ktm)) {
                $file = $request->file('file_ktm');
                $new_file_name = 'FileKTM-' . date('Ymd-H.i.s.') . $file->extension();
                $upload = $file->move(public_path($path), $new_file_name);

                if ($upload) {
                    $userInfo =   $administrasi->file_ktm;
                    if ($userInfo != '') {
                        unlink($path . $userInfo);
                    }

                    $getAdministrasiUser = Administrasi::find($id)->update(['file_ktm' => $new_file_name]);
                } else {
                    Alert::error('Gagal Upload!', 'Data Administrasi Gagal Disimpan.');
                    return back();
                }
            }
            if (isset($request->file_transkrip)) {
                $file = $request->file('file_transkrip');
                $new_file_name = 'FileTranskrip-' . date('Ymd-H.i.s.') . $file->extension();
                $upload = $file->move(public_path($path), $new_file_name);

                if ($upload) {
                    $userInfo =   $administrasi->file_transkrip;
                    if ($userInfo != '') {
                        unlink($path . $userInfo);
                    }

                    $getAdministrasiUser = Administrasi::find($id)->update(['file_transkrip' => $new_file_name]);
                } else {
                    Alert::error('Gagal Upload!', 'Data Administrasi Gagal Disimpan.');
                    return back();
                }
            }
            $administrasi->no_wa = $request->no_wa;
            $administrasi->instagram = $request->instagram;
            $administrasi->facebook = $request->facebook;
            $administrasi->touch();
            $administrasi->save();
            Alert::success('Data Berhasil Di Update.', 'Data baru telah tersimpan.');
        } else {

            Administrasi::create([
                'no_pendaftaran' => IdGenerator::generate(['table' => 'administrasis', 'field' => 'no_pendaftaran', 'length' => 10, 'prefix' => 'B' . $getPeriodeAktif->id_periode . '-' . $request->user()->id . '-']),
                'user_id' => Auth::user()->id,
                'periode_id' => $getPeriodeAktif->id_periode,
                'tempat_lahir' => $request['tempat_lahir'],
                'tanggal_lahir' => $request['tanggal_lahir'],
                'semester' => $request['semester'],
                'ipk' => $request['ipk'],
                'keahlian' => $request['keahlian'],
                'alamat' => $request['alamat'],
                'file_cv' => $request['file_cv'],
                'file_esai' => $request['file_esai'],
                'file_portofolio' => $request['file_portofolio'],
                'file_ktm' => $request['file_ktm'],
                'file_transkrip' => $request['file_transkrip'],
                'no_wa' => $request['no_wa'],
                'instagram' => $request['instagram'],
                'facebook' => $request['facebook'],
            ]);
            $getAdministrasiUser = Administrasi::where('user_id', '=', Auth::user()->id)->where('periode_id', '=', $getPeriodeAktif->id_periode)->first();
            $path = $getPeriodeAktif->name . '/' . Auth::user()->id . '/';
            $id = $getAdministrasiUser->id;
            // $administrasi = Administrasi::find($id);
            if (isset($request->file_cv)) {

                $file = $request->file('file_cv');
                $new_file_name = 'FileCV-' . date('Ymd-H.i.s.') . $file->extension();
                $upload = $file->move(public_path($path), $new_file_name);
                $getAdministrasiUser = Administrasi::find($id)->update(['file_cv' => $new_file_name]);
            }
            if (isset($request->file_esai)) {
                $file = $request->file('file_esai');
                $new_file_name = 'FileEsai-' . date('Ymd-H.i.s.') . $file->extension();
                $upload = $file->move(public_path($path), $new_file_name);
                $getAdministrasiUser = Administrasi::find($id)->update(['file_esai' => $new_file_name]);
            }
            if (isset($request->file_portofolio)) {
                $file = $request->file('file_portofolio');
                $new_file_name = 'FilePortofolio-' . date('Ymd-H.i.s.') . $file->extension();
                $upload = $file->move(public_path($path), $new_file_name);
                $getAdministrasiUser = Administrasi::find($id)->update(['file_portofolio' => $new_file_name]);
            }
            if (isset($request->file_ktm)) {
                $file = $request->file('file_ktm');
                $new_file_name = 'FileKTM-' . date('Ymd-H.i.s.') . $file->extension();
                $upload = $file->move(public_path($path), $new_file_name);
                $getAdministrasiUser = Administrasi::find($id)->update(['file_ktm' => $new_file_name]);
            }
            if (isset($request->file_transkrip)) {
                $file = $request->file('file_transkrip');
                $new_file_name = 'FileTranskrip-' . date('Ymd-H.i.s.') . $file->extension();
                $upload = $file->move(public_path($path), $new_file_name);
                $getAdministrasiUser = Administrasi::find($id)->update(['file_transkrip' => $new_file_name]);
            }
            $path = $getPeriodeAktif->name . '/' . $request->user()->id . '/' . Auth::user()->picture;
            $path2 = 'pictures' . '/';
            $file = $path2 . Auth::user()->picture;
            File::copy(public_path($file), public_path($path));
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
