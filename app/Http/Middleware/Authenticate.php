<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Models\Periode;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
            if ($getPeriodeAktif == null) {
                Alert::toast('Saat ini tidak ada Proses Pendaftaran Beasiswa.', 'info');
                return route('landing');
                if (!Auth()->User()->role) {
                    auth()->logout();
                }
            } else {
                return route('login');
            }
        }
    }
}
