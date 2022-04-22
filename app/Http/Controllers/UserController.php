<?php

namespace App\Http\Controllers;

use App\Models\Univ;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function uploadFoto(Request $request)
    {
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

        $path = 'pictures/';
        $file = $request->file('Foto');
        $new_image_name = 'UIMG' . date('-Y-m-d-') . uniqid() . '-' . $request->user()->name . '.jpg';
        $upload = $file->move(public_path($path), $new_image_name);

        if ($upload) {
            $userInfo =  $request->user()->picture;
            if ($userInfo != '') {
                unlink($path . $userInfo);
            }

            User::where('id', $request->user()->id)->update(['picture' => $new_image_name]);
            Alert::success('Foto Berhasil Diupload.', 'Anda dapat melanjutkan ke Proses Penerimaan Beasiswa.');
            return redirect(route('home'));
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
        $id = Auth::user()->id;
        $user = User::find($id);
        if ($request->univ_id == "other") {
            $getUniv = Univ::where('nama_universitas', '=', $request->univ_id_manual)->first();
            if ($getUniv) {
                $user->univ_id = $getUniv->univ_id;
            } else {
                Univ::create([
                    'nama_universitas' => $request->univ_id_manual,
                ]);
                $getUniv = Univ::where('nama_universitas', '=', $request->univ_id_manual)->first();
                $user->univ_id = $getUniv->univ_id;
            }
        }

        $id = Auth::user()->id;
        $user = User::find($id);
        $user->name = $request->name;
        $user->nim = $request->nim;

        $request->univ_id != "other" ? $user->univ_id = $getUniv->univ_id : '';

        if ($request->password != '') {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        if (!$user) {
            Alert::danger('Gagal', 'Anda gagal mengubah user.');
            return back();
        } else {
            Alert::success('Berhasil', 'Akun ' . $user->name . ' berhasil diperbarui.');
            return redirect(route('home'));
        }
    }
}
