<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }
<<<<<<< HEAD

    public function showLoginForm()
    {
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
        return view('auth.login', compact('getPeriodeAktif'));
    }

    protected function authenticated(Request $request, $user)
    {
        if (Auth::user()->role === 'admin') {
            Alert::success('Login Berhasil.', 'Anda Login sebagai ' . Auth::user()->name . " (" . Auth::user()->role . ").");
            return redirect(route('admin'));
        } else {
            $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
            if (isset($getPeriodeAktif) && isset(Auth::user()->picture)) {
                Alert::success('Login Berhasil.', 'Anda Login sebagai ' . Auth::user()->name);
                if ($getPeriodeAktif->status_adm == null) {
                    return redirect(route('tahap.administrasi'));
                } elseif ($getPeriodeAktif->status_adm == "Selesai") {
                    return redirect(route('tahap.wawancara'));
                } elseif ($getPeriodeAktif->status_adm == "Selesai" && $getPeriodeAktif->status_wwn == "Selesai") {
                    return redirect(route('tahap.penugasan'));
                }
            } elseif (isset($getPeriodeAktif) && !isset(Auth::user()->picture)) {
                return redirect(route('profil.mahasiswa'));
            } else {
                Alert::toast('Beasiswa Telah Dinyatakan Selesai, Tidak dapat melakukan Login. Saat ini tidak terdapat Program Beasiswa', 'info');
                Auth::logout();
            }
        }
        return redirect(route('landing'));
    }


    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }
        Alert::toast('Anda sudah Log Out.', 'info');
        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }
=======
>>>>>>> FE Landing Page Sementara
}
