<?php

namespace App\Http\Controllers\Auth;

use App\Models\Univ;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Prodi;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $getAllProdi = Prodi::all();
        $getAllUniv = Univ::all();
        return view('Auth.register', compact('getAllProdi', 'getAllUniv'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if (isset($data['Input_Universitas'])) {
            return Validator::make($data, [
                'name' => ['required', 'string', 'regex:/^[a-z A-Z]+$/u', 'max:255'],
                'nim' => ['required', 'string', 'max:255'],
                'univ_id' => ['required'],
                'prodi_id' => ['required'],
                'Input_Universitas' => ['string', 'regex:/^[a-z A-Z]+$/u', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        } else {
            return Validator::make($data, [
                'name' => ['required', 'string', 'regex:/^[a-z A-Z]+$/u', 'max:255'],
                'nim' => ['required', 'string', 'max:255'],
                'univ_id' => ['required'],
                'prodi_id' => ['required'],
                // 'Input_Universitas' => ['string', 'regex:/^[a-z A-Z]+$/u', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        Alert::success('Registrasi Berhasil.', 'Silahkan lengkapi data Anda!');
        if ($data['univ_id'] == "other") {
            $getUniv = Univ::where('nama_universitas', '=', $data['Input_Universitas'])->first();

            if ($getUniv) {
                return User::create([
                    'name' => $data['name'],
                    'nim' => $data['nim'],
                    'univ_id' => $getUniv->id,
                    'prodi_id' => $data['prodi_id'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                ]);
            } else {
                Univ::create([
                    'nama_universitas' => $data['Input_Universitas'],
                ]);
                $getUniv = Univ::where('nama_universitas', '=', $data['Input_Universitas'])->first();
                return User::create([
                    'name' => $data['name'],
                    'nim' => $data['nim'],
                    'univ_id' => $getUniv->id,
                    'prodi_id' => $data['prodi_id'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                ]);
            }
        } else {
            return User::create([
                'name' => $data['name'],
                'nim' => $data['nim'],
                'univ_id' => $data['univ_id'],
                'prodi_id' => $data['prodi_id'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
        }
    }
}
