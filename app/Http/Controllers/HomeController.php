<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('view-admin.dashboard');
    }

    public function indexLandingPage()
    {
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
        return view('landing-page', compact('getPeriodeAktif'));
    }

    public function indexProfilAdmin()
    {
        return view('profil-admin');
    }

    public function indexProfilMahasiswa()
    {
        return view('profil-mahasiswa');
    }

    public function indexAdmin()
    {
        return view('view-admin.dashboard');
    }

    public function indexMahasiswa()
    {
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
        $getUserLoggedIn = Auth::user();
        return view('view-mahasiswa.home', compact('getUserLoggedIn', 'getPeriodeAktif'));
    }
}
