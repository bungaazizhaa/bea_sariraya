<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Univ;
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
        $getTanggalSekarang = Carbon::now()->format('Y-m-d');
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
        return view('landing-page', compact('getPeriodeAktif', 'getTanggalSekarang'));
    }

    public function indexProfilAdmin()
    {
        return view('view-admin.profil-admin');
    }

    public function indexAdmin()
    {
        return view('view-admin.dashboard');
    }

    public function indexMahasiswa()
    {
        $getAllUniv = Univ::all();
        $getTanggalSekarang = Carbon::now()->format('Y-m-d');
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
        $getUserLoggedIn = Auth::user();
        return view('view-mahasiswa.profil-mahasiswa', compact('getUserLoggedIn', 'getPeriodeAktif', 'getTanggalSekarang', 'getAllUniv'));
    }
}
