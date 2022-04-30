<?php

namespace App\Http\Controllers;

use App\Models\Univ;
use App\Models\User;
use App\Models\Periode;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use function PHPUnit\Framework\isNull;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
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

    public function showDataPengguna()
    {
        $getAllUniv = Univ::all();
        $getAllPeriode = Periode::all();
        $getAllUser = User::filter(request(['search']))->paginate(10)->withQueryString();
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
        return view('view-admin.user.u-index', compact('getPeriodeAktif', 'getAllUniv', 'getAllPeriode', 'getAllUser'));
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
        $path = 'pictures/';
        $user = User::find($id);
        $userInfo =  $user->picture;
        if ($userInfo != '') {
            unlink($path . $userInfo);
        }
        $user->delete();
        if (!$user) {
            Alert::danger('Gagal', 'Gagal menghapus user.');
            return back();
        } else {
            Alert::success('Berhasil', 'Anda Berhasil Menghapus ' . $user->name . '.');
            return redirect(route('data.pengguna'));
        }
    }

    public function uploadFoto(Request $request)
    {
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
        $validator = Validator::make($request->all(), ['Foto' => 'required|mimes:jpeg,png,jpg|max:1024']);

        if ($validator->fails()) {
            $error = $validator->errors();
            $error = json_decode($error, true);
            var_dump($error);
            Alert::error('Foto Gagal Diupload.', '' . $error['Foto'][0]);
        }

        $validated = $request->validate([
            'Foto' => 'required|mimes:jpeg,png,jpg|max:1024',
        ]);

        $path = $getPeriodeAktif->name . '/' . $request->user()->id . '/';
        $path2 = 'pictures' . '/';
        $file = $request->file('Foto');
        $new_image_name = '_PasFoto-' . str_replace(' ', '-', $request->user()->name) .  date('-Ymd-H.i.s.') . $file->extension();
        $upload = $file->move(public_path($path2), $new_image_name);
        File::copy(public_path($path2) . $new_image_name, public_path($path) . $new_image_name);
        if ($upload) {
            $userInfo =  $request->user()->picture;
            if ($userInfo != '') {
                unlink($path . $userInfo);
                unlink($path2 . $userInfo);
            }

            User::where('id', $request->user()->id)->update(['picture' => $new_image_name]);
            Alert::success('Foto Berhasil Diupload.', 'Anda dapat melanjutkan ke Proses Penerimaan Beasiswa.');
            return redirect(route('tahap.administrasi'));
        }

        Alert::success('Error Title', 'Error Message');
        return back();
    }

    public function updateMyUser(Request $request)
    {
        $request->validate([
            'name' => ['string', 'regex:/^[a-z A-Z]+$/u', 'max:255'],
            'nim' => ['string', 'max:255'],

        ]);

        if ($request->univ_id_manual != '') {
            $request->validate([
                'univ_id_manual' => ['string', 'regex:/^[a-z A-Z]+$/u', 'max:255'],
            ]);
        }

        if ($request->password != '') {
            $request->validate([
                'password' => ['string', 'min:8', 'confirmed'],
            ]);
        }

        $valueInputManual = $request->univ_id_manual;
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->name = $request->name;
        if (isset(Auth::user()->picture) && Auth::user()->name != $request->name) {
            $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
            $path = $getPeriodeAktif->name . '/' . $request->user()->id . '-' . str_replace(' ', '-', $request->user()->name) . '/';
            $path2 = 'pictures' . '/';
            $file = $path2 . Auth::user()->picture;
            if (pathinfo((public_path($path) . Auth::user()->picture))) {
                unlink(public_path($path) . Auth::user()->picture);
            }
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $new_image_name = '_PasFoto-' . str_replace(' ', '-', $request->name) .  date('-Ymd-H.i.s.') . $extension;
            $user->picture = $new_image_name;
            rename(public_path($path2) . Auth::user()->picture, public_path($path2) . $new_image_name);
            File::copy(public_path($path2) . $new_image_name, public_path($path) . $new_image_name);
        }
        $user->nim = $request->nim;
        if ($request->univ_id == 'other') {
            $getUniv = Univ::where('nama_universitas', '=', $valueInputManual)->first();
            if (!$getUniv) {
                Univ::create([
                    'nama_universitas' => $valueInputManual,
                ]);
            }
            $getUnivId = Univ::where('nama_universitas', '=', $valueInputManual)->first()->id;
            $user->univ_id = $getUnivId;
        } else {
            $user->univ_id = $request->univ_id;
        }

        if ($request->password != '') {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        if (!$user) {
            Alert::danger('Gagal', 'Anda gagal mengubah user.');
            return back();
        } else {
            Alert::success('Berhasil', 'Akun ' . $user->name . ' berhasil diperbarui.');
            return redirect(route('profil.mahasiswa'));
        }
    }
}
