<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PeriodeTimeRestrictedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();

        if ($getPeriodeAktif == null && Auth()->user()->role == 'mahasiswa') {
            auth()->logout();
            Alert::toast('Beasiswa Telah Dinyatakan Selesai. Saat ini tidak terdapat Program Beasiswa', 'info');
            return redirect(route('landing'));
        }
        return $next($request);
    }
}
