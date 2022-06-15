<?php

namespace App\Http\Controllers;

use App\Models\Administrasi;
use App\Models\Penugasan;
use Carbon\Carbon;
use App\Models\Univ;
use App\Models\User;
use App\Models\Periode;
use App\Models\Wawancara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Exists;
use RealRashid\SweetAlert\Facades\Alert;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

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
    // public function index()
    // {
    //     return view('view-admin.dashboard');
    // }

    /* SEMENTARA */

    public function indexLandingPage()
    {
        $getTanggalSekarang = Carbon::now()->format('Y-m-d');
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
        return view('landing-page', compact('getPeriodeAktif', 'getTanggalSekarang'));
    }

    public function previewTeknisWwn()
    {
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
        return view('view-admin.preview-tekniswwn', compact('getPeriodeAktif'));
    }

    public function panduanAplikasi()
    {
        $getAllPeriode = Periode::all();
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
        return view('view-admin.panduan-aplikasi', compact('getPeriodeAktif', 'getAllPeriode'));
    }

    public function indexAdmin()
    {
        $getAllUser = User::all();
        $getAllUniv = Univ::all();
        $getAllPeriode = Periode::all();
        $getAllAdministrasi = Administrasi::all();
        $getAllWawancara = Wawancara::all();
        $getPeriodeLast = Periode::orderBy('id_periode', 'desc')->value('id_periode');
        $getTanggalSekarang = Carbon::now()->format('Y-m-d');
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
        return view('view-admin.dashboard', compact('getAllUser', 'getPeriodeAktif', 'getTanggalSekarang', 'getAllUniv', 'getAllPeriode', 'getPeriodeLast', 'getAllAdministrasi', 'getAllWawancara'));
    }

    public function viewSetting()
    {
        $getAllUser = User::all();
        $getAllUniv = Univ::all();
        $getAllPeriode = Periode::all();
        $getPeriodeLast = Periode::orderBy('id_periode', 'desc')->value('id_periode');
        $getTanggalSekarang = Carbon::now()->format('Y-m-d');
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
        return view('view-admin.setting', compact('getAllUser', 'getPeriodeAktif', 'getTanggalSekarang', 'getAllUniv', 'getAllPeriode', 'getPeriodeLast'));
    }

    public function indexMahasiswa()
    {
        $getAllUniv = Univ::all();
        $getTanggalSekarang = Carbon::now()->format('Y-m-d');
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
        if ($getPeriodeAktif == null && Auth::user()->role == 'mahasiswa') {
            auth()->logout();
        }
        $getUserLoggedIn = Auth::user();
        return view('view-mahasiswa.profil-mahasiswa', compact('getUserLoggedIn', 'getPeriodeAktif', 'getTanggalSekarang', 'getAllUniv'));
    }

    public function resetBeasiswa()
    {
        $getAllBatch = Periode::All();
        foreach ($getAllBatch as $batch) {
            if (isset($getAllBatch)) {
                if (is_dir(public_path($batch->name))) {
                    $dir = public_path($batch->name);
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
        }

        $getAllUser = User::all();
        foreach ($getAllUser as $user) {
            if (count($getAllUser) > 0) {
                $file = 'pictures/' . $user->picture;
                if (isset($user->picture)) {
                    unlink(public_path($file));
                }
            }
        }
        foreach ($getAllUser as $user) {
            // if ($user->role != 'admin') {
            User::find($user->id)->delete();
            // }
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        Penugasan::truncate();
        Wawancara::truncate();
        Administrasi::truncate();
        Periode::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        // User::statement('SET FOREIGN_KEY_CHECKS=1;');
        // Administrasi::statement('SET FOREIGN_KEY_CHECKS=1;');
        // Wawancara::statement('SET FOREIGN_KEY_CHECKS=1;');
        // Penugasan::statement('SET FOREIGN_KEY_CHECKS=1;');
        // Periode::statement('SET FOREIGN_KEY_CHECKS=1;');
        User::create(
            [
                'role' => 'admin',
                'nim' => '000',
                'univ_id' => '1',
                'prodi_id' => '1',
                'name' => 'Administrator',
                'picture' => null,
                'email_verified_at' => now(),
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'remember_token' => '',
            ],
        );
        Alert::html('Beasiswa Berhasil Direset. Semua Data Telah Terhapus.', " Username Admin = admin@gmail.com ", 'success');
        return redirect(route('admin'));
    }
}
