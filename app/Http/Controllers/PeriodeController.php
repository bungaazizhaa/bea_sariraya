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
    //! Menampilkan Halaman List Periode
    public function index()
    {
        $getAllPeriode = Periode::all();
        $getPeriodeLast = Periode::withTrashed()->orderBy('id_periode', 'desc')->value('id_periode');
        $getTanggalSekarang = Carbon::now()->format('Y-m-d');
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
        return view('view-admin.periode.periode-index', compact('getAllPeriode', 'getPeriodeLast', 'getTanggalSekarang', 'getPeriodeAktif'));
    }

    //! Menampilkan Halaman Detail Periode
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
            ->select('*', 'users.id AS iduser', 'administrasis.catatan AS catatanadm', 'wawancaras.catatan AS catatanwwn', 'penugasans.catatan AS catatanpng')
            ->get();
        $getAllAdmLolos = Administrasi::with('user')->where('periode_id', '=', $periodeOpenned->id_periode)->where('status_adm', '=', 'lolos')
            ->leftJoin('wawancaras', 'wawancaras.administrasi_id', '=', 'administrasis.id')
            ->leftJoin('users', 'users.id', '=', 'administrasis.user_id')
            ->select('*', 'administrasis.email_sent_at AS adm_email_at')
            ->orderBy('jadwal_wwn', 'asc')->get();
        $getAllAdmGagal = Administrasi::with('user')->where('periode_id', '=', $periodeOpenned->id_periode)->where('status_adm', '!=', 'lolos')
            ->leftJoin('users', 'users.id', '=', 'administrasis.user_id')
            ->select('*', 'administrasis.email_sent_at AS adm_email_at')
            ->get();
        $administrasiOpenned = Administrasi::with('user')->where('periode_id', '=', $periodeOpenned->id_periode)->pluck('id');
        $getAllWwnLolos = Wawancara::with('user')->whereIn('administrasi_id', $administrasiOpenned)->where('status_wwn', '=', 'lolos')
            ->leftJoin('administrasis', 'administrasis.id', '=', 'wawancaras.administrasi_id')
            ->leftJoin('users', 'users.id', '=', 'administrasis.user_id')
            ->leftJoin('penugasans', 'penugasans.wawancara_id', '=', 'wawancaras.id')
            ->select('*', 'wawancaras.email_sent_at AS wwn_email_at')
            ->get();
        $getAllWwnGagal = Wawancara::with('user')->whereIn('administrasi_id', $administrasiOpenned)->where('status_wwn', '=', 'gagal')
            ->leftJoin('administrasis', 'administrasis.id', '=', 'wawancaras.administrasi_id')
            ->leftJoin('users', 'users.id', '=', 'administrasis.user_id')
            ->select('*', 'wawancaras.email_sent_at AS wwn_email_at')
            ->get();
        $wawancaraOpenned = Wawancara::with('user')->whereIn('administrasi_id', $administrasiOpenned)->pluck('id');
        $getAllPngLolos = Penugasan::whereIn('wawancara_id', $wawancaraOpenned)->where('status_png', '=', 'lolos')
            ->leftJoin('wawancaras', 'wawancaras.id', '=', 'penugasans.wawancara_id')
            ->leftJoin('administrasis', 'wawancaras.administrasi_id', '=', 'administrasis.id')
            ->leftJoin('users', 'users.id', '=', 'administrasis.user_id')
            ->select('*', 'penugasans.email_sent_at AS png_email_at')
            ->get();
        $getAllPngGagal = Penugasan::whereIn('wawancara_id', $wawancaraOpenned)->where('status_png', '=', 'gagal')
            ->leftJoin('wawancaras', 'wawancaras.id', '=', 'penugasans.wawancara_id')
            ->leftJoin('administrasis', 'wawancaras.administrasi_id', '=', 'administrasis.id')
            ->leftJoin('users', 'users.id', '=', 'administrasis.user_id')
            ->select('*', 'penugasans.email_sent_at AS png_email_at')
            ->get();
        return view('view-admin.periode.periodeid-index', compact('periodeOpenned', 'getAllUniv', 'getAllPeriode', 'getTanggalSekarang', 'getAllAdmLolos', 'getAllAdmGagal', 'getAllWwnLolos', 'getAllWwnGagal', 'getAllPngLolos', 'getAllPngGagal', 'getAdministrasiUser'));
    }

    //! Membuat Periode Baru
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
        if (!is_dir($request['name'])) {
            mkdir($request['name']);
        }

        Alert::success('Berhasil membuat Periode Baru!', 'Silahkan melengkapi data program beasiswa.');
        return redirect(route('periode', $request['name']));
    }

    //! Menyimpan Link Grup WA
    public function groupwaUpdate(Request $request, $name)
    {
        $periodeSelected = Periode::where('name', '=', $name)->first();
        $periodeSelected->group_wa = $request->group_wa;
        $periodeSelected->save();
        Alert::toast('Link Group WhatsApp ' . ucfirst($periodeSelected->name) . ' sudah Diperbarui.', 'success');
        return redirect(route('periode', $name));
    }

    //! Menyimpan Deskripsi Teknis Wawancara
    public function tekniswwnUpdate(Request $request, $name)
    {
        $periodeSelected = Periode::where('name', '=', $name)->first();
        $periodeSelected->teknis_wwn = $request->teknis_wwn;
        if ($request == '') {
            $periodeSelected->teknis_wwn = null;
        }
        $periodeSelected->save();
        Alert::toast('Teknis Wawancara ' . ucfirst($periodeSelected->name) . ' sudah Diperbarui.', 'success');
        return redirect(route('periode', $name));
    }

    //! Memperbarui Periode
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
        // if ($periode->id_periode != $request->id_periode) {
        //     $validator = Validator::make($request->all(), [
        //         'id_periode' => 'required|unique:periodes|integer',
        //     ]);
        //     if ($validator->fails()) {
        //         Alert::error('Gagal melakukan Update.', 'Cek kesalahan Pengisian.');
        //         // var_dump($validator);
        //     }
        //     $validator->validated();
        //     $periode->id_periode = $request->id_periode;
        // }
        // if ($name != $request->name) {
        //     $validator = Validator::make($request->all(), [
        //         'name' => 'required|string|max:255|unique:periodes',
        //     ]);
        //     if ($validator->fails()) {
        //         Alert::error('Gagal melakukan Update.', 'Cek kesalahan Pengisian.');
        //         // var_dump($validator);
        //     }
        //     $validator->validated();
        //     $periode->name = $request->name;
        //     rename($name, $request->name);
        // }

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
        Alert::toast('Data Periode Telah Diperbarui.', 'success');
        return redirect(route('periode', $periode->name));
    }

    //! Mengembalikan Periode Terhapus
    public function restore($name = null)
    {
        if ($name != null) {
            $getBatch = Periode::onlyTrashed()->where('name', '=', $name)->first()->restore();
            Alert::toast('Periode ' . ucfirst($name) . ' berhasil di-Restore!', 'success');
        } else {
            $getBatch = Periode::onlyTrashed()->restore();
            Alert::toast('Periode berhasil di-Restore!', 'success');
        }
        return redirect(route('trash'));
    }

    //! Menghapus Sementara Periode
    public function destroy($name)
    {
        $getBatch = Periode::where('name', '=', $name)->first()->delete();

        Alert::toast('Periode ' . ucfirst($name) . ' berhasil di Hapus!', 'success');
        return redirect(route('index.periode'));
    }

    //! Menghapus Permanen Periode
    public function forceDestroy($name = null)
    {
        if ($name != null) {
            $getBatch = Periode::onlyTrashed()->where('name', '=', $name)->first();
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
            $getBatch = Periode::onlyTrashed()->where('name', '=', $name)->first()->forceDelete();
        } else {
            $getBatchTrashed = Periode::onlyTrashed()->get();
            foreach ($getBatchTrashed as $getBatch) {
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
                $getBatch->forceDelete();
            }
        }
        Alert::toast('Periode ' . ucfirst($name) . ' berhasil di Hapus!', 'success');
        return redirect(route('trash'));
    }
}
