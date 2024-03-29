<?php

namespace App\Http\Controllers;

use App\Models\Administrasi;
use App\Models\Penugasan;
use Carbon\Carbon;
use App\Models\Univ;
use App\Models\User;
use App\Models\Periode;
use App\Models\Landingpage;
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('view-admin.dashboard');
    // }

    //! === View Halaman Landing Page ===
    public function indexLandingPage()
    {
        Landingpage::where('name', '=', 'views')->first()->increment('keterangan');
        $getTanggalSekarang = Carbon::now()->format('Y-m-d');
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
        $getKontak1 = Landingpage::where('id', '=', 2)->first();
        $getKontak2 = Landingpage::where('id', '=', 3)->first();
        $getPemberian = Landingpage::where('id', '=', 4)->first();
        return view('landing-page', compact('getPeriodeAktif', 'getTanggalSekarang', 'getKontak1', 'getKontak2', 'getPemberian'));
    }

    //! === View Halaman Profil Mahasiswa ===
    public function indexMahasiswa()
    {
        $getAllUniv = Univ::all();
        $getTanggalSekarang = Carbon::now()->format('Y-m-d');
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
        $getAdministrasiUser = Administrasi::with('user')->where('periode_id', '=', $getPeriodeAktif->id_periode)
            ->where('user_id', '=', Auth::user()->id)
            ->first();
        if ($getPeriodeAktif == null && Auth::user()->role == 'mahasiswa') {
            auth()->logout();
        }
        $getUserLoggedIn = Auth::user();
        $getRiwayatUser = Administrasi::where('user_id', '=', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('view-mahasiswa.profil-mahasiswa', compact('getUserLoggedIn', 'getPeriodeAktif', 'getTanggalSekarang', 'getAllUniv', 'getAdministrasiUser', 'getRiwayatUser'));
    }

    //! === View Halaman Dashboard Admin ===
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

    //! === View Halaman Panduan App ===
    public function panduanAplikasi()
    {
        $getAllPeriode = Periode::all();
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
        return view('view-admin.panduan-aplikasi', compact('getPeriodeAktif', 'getAllPeriode'));
    }

    //! === View Halaman Setting ===
    public function viewSetting()
    {
        $getAllUser = User::all();
        $getAllUniv = Univ::all();
        $getAllPeriode = Periode::all();
        $getPeriodeLast = Periode::orderBy('id_periode', 'desc')->value('id_periode');
        $getTanggalSekarang = Carbon::now()->format('Y-m-d');
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
        $getKontak1 = Landingpage::where('id', '=', 2)->first();
        $getKontak2 = Landingpage::where('id', '=', 3)->first();
        $getPemberian = Landingpage::where('id', '=', 4)->first();
        return view('view-admin.setting', compact('getAllUser', 'getPeriodeAktif', 'getTanggalSekarang', 'getAllUniv', 'getAllPeriode', 'getPeriodeLast', 'getKontak1', 'getKontak2', 'getPemberian'));
    }

    //! === View Halaman Preview Teknis Wwn ===
    public function previewTeknisWwn()
    {
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
        return view('view-admin.preview-tekniswwn', compact('getPeriodeAktif'));
    }

    //! === Melakukan Reset Beasiswa ===
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

        $getAllUser = User::where('role', '!=', 'admin')->get();
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
                'nim' => null,
                'univ_id' => null,
                'prodi_id' => null,
                'name' => 'Administrator',
                'picture' => 'admin.png',
                'email_verified_at' => now(),
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'remember_token' => '',
            ],
        );
        Alert::html('Beasiswa Berhasil Direset. Semua Data Telah Terhapus.', " Username Admin = admin@gmail.com<br>Demi keamanan, segera ubah password default Anda di menu Pengaturan.", 'success')->autoClose(false);
        return redirect(route('setting.beasiswa'));
    }

    //! === Update Data Landing Page ===
    public function updateLandingPage(Request $request)
    {
        $getKontak1 = Landingpage::where('id', '=', 2)->first();
        $getKontak1->keterangan = $request->kontak1;
        $getKontak1->save();
        $getKontak2 = Landingpage::where('id', '=', 3)->first();
        $getKontak2->keterangan = $request->kontak2;
        $getKontak2->save();
        $getPemberian = Landingpage::where('id', '=', 4)->first();
        $getPemberian->keterangan = $request->pemberian;
        $getPemberian->save();
        Alert::toast('Data Halaman Utama Berhasil diperbarui.', 'success');
        return redirect(route('setting.beasiswa'));
    }

    //! === View Halaman Data Terhapus ===
    public function trash(Request $request)
    {
        $getAllUniv = Univ::all();
        $getAllPeriode = Periode::all();
        $getAllPeriodeTrashed = Periode::onlyTrashed()->get();
        $getAllUser = User::all();
        $getAllUserTrashed = User::onlyTrashed()->get();
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
        return view('view-admin.trash', compact('getPeriodeAktif', 'getAllUniv', 'getAllPeriode', 'getAllUser', 'getAllPeriodeTrashed', 'getAllUserTrashed'));
    }
}
