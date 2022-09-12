<?php

namespace App\Http\Controllers;

use App\Models\Administrasi;
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
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class UserController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $getAllPeriode = Periode::all();
        $getUser = User::find($id);
        $getAdministrasiUser = Administrasi::where('user_id', '=', $id)->get();
        return view('view-admin.user.u-show', compact('getUser', 'getAdministrasiUser', 'getAllPeriode'));
    }

    public function showDataPengguna()
    {
        $getAllUniv = Univ::all();
        $getAllPeriode = Periode::all();
        $getAllUser = User::all();
        $getUser = User::filter(request(['search']))->paginate(20)->onEachSide(0)->withQueryString();
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
        return view('view-admin.user.u-index', compact('getPeriodeAktif', 'getAllUniv', 'getAllPeriode', 'getAllUser', 'getUser'));
    }

    public function showDataPenggunaTabel()
    {
        $getAllUniv = Univ::all();
        $getAllPeriode = Periode::all();
        $getAllUser = User::all();
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
        return view('view-admin.user.u-indextable', compact('getPeriodeAktif', 'getAllUniv', 'getAllPeriode', 'getAllUser'));
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
        $validated = $request->validate([
            'name' => 'required|regex:/^[a-z A-Z]+$/u|string|max:255',
            'password' => 'string|min:8|confirmed|nullable',
        ]);
        if ($request->email != Auth::user()->email) {
            $validated = $request->validate([
                'email' => 'unique:users|string|max:255',
            ]);
        }
        $user = User::find($id);
        $user->name = $request->name;
        if ($request->file('Foto') != null) {
            $path = 'pictures' . '/';
            $file = $request->file('Foto');
            $new_image_name = '_PasFoto-' . str_replace(' ', '-', isset($request->name) ? $request->name : $request->user()->name) .  date('-Ymd-H.i.s.') . $file->extension();
            $upload = $file->move(public_path($path), $new_image_name);
            if ($upload) {
                $userInfo =  $request->user()->picture;
                if ($userInfo != '') {
                    if (file_exists($path . $userInfo)) {
                        unlink($path . $userInfo);
                    }
                }

                $user->picture = $new_image_name;
            }
        }
        if ($request->email != Auth::user()->email) {
            $user->email = $request->email;
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
            return redirect(route('setting.beasiswa'));
        }
    }

    public function destroy($id)
    {

        $path = 'pictures/';
        $getAllPeriode = Periode::all();
        $user = User::find($id);
        $user->delete();
        if (!$user) {
            Alert::danger('Gagal', 'Gagal menghapus user.');
            return back();
        } else {
            Alert::toast('Berhasil Menghapus ' . $user->name . '.', 'success');
            return redirect(route('data.pengguna'));
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function forceDestroy($id = null)
    {
        if ($id != null) {
            $path = 'pictures/';
            $getAllPeriode = Periode::withTrashed()->get();
            $user = User::withTrashed()->find($id);
            if (isset($user->picture) != false) {
                $userInfo = $user->picture;
                unlink($path . $userInfo);
            }
            foreach ($getAllPeriode as $periode) {
                $path2 = $periode->name . '/' . $user->id . '/';
                if (is_dir(public_path($path2))) {
                    $dir = public_path($path2);
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
            $user->forceDelete();
            if (!$user) {
                Alert::danger('Gagal', 'Gagal menghapus user.');
                return back();
            } else {
                Alert::success('Berhasil', 'Anda Berhasil Menghapus ' . $user->name . '.');
                return redirect(route('trash'));
            }
        } else {
            $path = 'pictures/';
            $getAllPeriode = Periode::withTrashed()->get();
            $getAllUserTrashed = User::onlyTrashed()->get();
            foreach ($getAllUserTrashed as $user) {

                if (isset($user->picture) != false) {
                    $userInfo = $user->picture;
                    unlink($path . $userInfo);
                }
                foreach ($getAllPeriode as $periode) {
                    $path2 = $periode->name . '/' . $user->id . '/';
                    if (is_dir(public_path($path2))) {
                        $dir = public_path($path2);
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
                $user->forceDelete();
                if (!$user) {
                    Alert::danger('Gagal', 'Gagal menghapus user.');
                    return back();
                }
            }
            if (!$user) {
                Alert::danger('Gagal', 'Gagal menghapus user.');
                return back();
            } else {
                Alert::success('Berhasil', 'Anda Berhasil Menghapus ' . $user->name . '.');
                return redirect(route('trash'));
            }
        }
    }

    public function restore($id = null)
    {
        if ($id != null) {
            $user = User::onlyTrashed()->find($id);
            $user->restore();
            if (!$user) {
                Alert::danger('Gagal', 'Gagal mengembalikan user.');
                return back();
            } else {
                Alert::success('Berhasil', 'Anda Berhasil Mengembalikan User ' . $user->name . '.');
                return redirect(route('trash'));
            }
        } else {
            $user = User::onlyTrashed()->restore();
            if (!$user) {
                Alert::danger('Gagal', 'Gagal mengembalikan user.');
                return back();
            } else {
                Alert::success('Berhasil', 'Anda Berhasil Mengembalikan Semua User.');
                return redirect(route('trash'));
            }
        }
    }

    public function uploadFoto(Request $request)
    {
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
        $validator = Validator::make($request->all(), ['Foto' => 'required|mimes:jpeg,png,jpg|max:512']);

        if ($validator->fails()) {
            $error = $validator->errors();
            $error = json_decode($error, true);
            Alert::error('Foto Gagal Diupload.', '' . $error['Foto'][0]);
        }

        $validated = $request->validate([
            'Foto' => 'required|mimes:jpeg,png,jpg|max:512',
        ]);

        $path = $getPeriodeAktif->name . '/' . $request->user()->id . '/';
        $path2 = 'pictures' . '/';
        $file = $request->file('Foto');
        $new_image_name = '_PasFoto-' . str_replace(' ', '-', $request->user()->name) .  date('-Ymd-H.i.s.') . $file->extension();
        $upload = $file->move(public_path($path2), $new_image_name);
        if (is_dir(public_path($path))) {
            File::copy(public_path($path2) . $new_image_name, public_path($path) . $new_image_name);
        } else {
            File::makeDirectory(public_path($path), 0777, true, true);
            File::copy(public_path($path2) . $new_image_name, public_path($path) . $new_image_name);
        }
        if ($upload) {
            $userInfo =  $request->user()->picture;
            if ($userInfo != '') {
                if (file_exists($path . $userInfo)) {
                    unlink($path . $userInfo);
                }
                if (file_exists($path2 . $userInfo)) {
                    unlink($path2 . $userInfo);
                }
            }

            User::where('id', $request->user()->id)->update(['picture' => $new_image_name]);
            Alert::success('Foto Berhasil Diupload.', 'Anda dapat melanjutkan ke Proses Penerimaan Beasiswa.');
            return redirect(route('profil.mahasiswa'));
        }

        Alert::success('Error Title', 'Error Message');
        return back();
    }

    public function updateMyUser(Request $request)
    {
        $request->validate([
            'name' => ['string', 'regex:/^[a-z A-Z]+$/u', 'max:255'],
            'nim' => ['string', 'max:255'],
            'univ_id_manual' => ['string', 'regex:/^[a-z A-Z]+$/u', 'max:255', 'nullable'],
            'password' => ['string', 'min:8', 'confirmed', 'nullable'],
        ]);

        // if ($request->univ_id_manual != '') {
        //     $request->validate([
        //         'univ_id_manual' => ['string', 'regex:/^[a-z A-Z]+$/u', 'max:255'],
        //     ]);
        // }



        $valueInputManual = $request->univ_id_manual;
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->name = $request->name;
        if (isset(Auth::user()->picture) && Auth::user()->name != $request->name) {
            $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
            $path = $getPeriodeAktif->name . '/' . $request->user()->id . '/';
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

        if ($request->nim != '' && (Auth::user()->nim != $request->nim)) {
            $request->validate([
                'nim' => ['string', 'max:255', 'unique:users'],
            ]);
            $user->nim = $request->nim;
        }

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
            $request->validate([
                'password' => ['sometimes', 'string', 'min:8', 'confirmed'],
            ]);
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
