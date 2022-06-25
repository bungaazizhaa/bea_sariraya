<?php

namespace App\Http\Controllers;

use App\Jobs\SendAdmJob;
use App\Jobs\SendPngJob;
use App\Jobs\SendWwnJob;
use App\Models\Administrasi;
use App\Models\Penugasan;
use App\Models\Periode;
use App\Models\Univ;
use App\Models\Wawancara;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class EmailController extends Controller
{
    public function sendEmailAdministrasi($name)
    {

        $periodeSelected = Periode::where('name', '=', $name)->first();

        if ($periodeSelected->teknis_wwn == null) {
            Alert::error('Gagal! Mohon isi Teknis Wawancara ' . ucfirst($periodeSelected->name) . ' terlebih Dahulu! ', 'Terimakasih.');
            return back();
        }
        $periodeSelected->status_adm = 'Selesai';
        $periodeSelected->ts_adm = now();
        $periodeSelected->save();

        if ($periodeSelected) {
            $periodeOpenned = Periode::where('name', '=', $name)->first();
            $getAdministrasiUser = Administrasi::with('user')->where('periode_id', '=', $periodeOpenned->id_periode)
                ->leftJoin('wawancaras', 'wawancaras.administrasi_id', '=', 'administrasis.id')
                ->leftJoin('penugasans', 'penugasans.wawancara_id', '=', 'wawancaras.id')
                ->leftJoin('users', 'users.id', '=', 'administrasis.user_id')
                ->leftJoin('univs', 'univs.id', '=', 'users.univ_id')
                ->leftJoin('prodis', 'prodis.id', '=', 'users.prodi_id')
                ->orderBy('jadwal_wwn', 'asc')->get();

            foreach ($getAdministrasiUser as $userAdm) {
                $mail_data = [
                    'name' => $name,
                    'data' => $userAdm,
                    'periode' => $periodeOpenned
                ];
                $delay = DB::table('jobs')->count() * 4;
                $job = (new SendAdmJob($mail_data))
                    ->delay(Carbon::now()->addSeconds($delay));
                dispatch($job);
            }
            Alert::success('Tahap Administrasi ' . ucfirst($periodeSelected->name) . ' sudah Diumumkan.', 'Email sedang dikirim. Selanjutnya adalah Tahap Wawancara.');
            return redirect(route('periode', $name));
        } else {
            Alert::error('Tahap Administrasi ' . ucfirst($periodeSelected->name) . ' Gagal Diumumkan.', 'Cek data kembali.');
            return redirect(route('periode', $name));
        }
    }

    public function sendEmailWawancara($name)
    {

        $periodeSelected = Periode::where('name', '=', $name)->first();

        $periodeSelected->status_wwn = 'Selesai';
        $periodeSelected->ts_wwn = now();
        $periodeSelected->save();

        if ($periodeSelected) {
            $periodeOpenned = Periode::where('name', '=', $name)->first();
            $getWawancaraUser = Administrasi::with('user')->where('periode_id', '=', $periodeOpenned->id_periode)
                ->where('status_adm', '=', 'lolos')
                ->leftJoin('wawancaras', 'wawancaras.administrasi_id', '=', 'administrasis.id')
                ->leftJoin('penugasans', 'penugasans.wawancara_id', '=', 'wawancaras.id')
                ->leftJoin('users', 'users.id', '=', 'administrasis.user_id')
                ->leftJoin('univs', 'univs.id', '=', 'users.univ_id')
                ->leftJoin('prodis', 'prodis.id', '=', 'users.prodi_id')
                ->orderBy('jadwal_wwn', 'asc')->get();

            foreach ($getWawancaraUser as $userWwn) {
                $mail_data = [
                    'name' => $name,
                    'data' => $userWwn,
                    'periode' => $periodeOpenned
                ];
                $delay = DB::table('jobs')->count() * 4;
                $job = (new SendWwnJob($mail_data))
                    ->delay(Carbon::now()->addSeconds($delay));
                dispatch($job);
            }
            Alert::success('Tahap Wawancara ' . ucfirst($periodeSelected->name) . ' sudah Diumumkan.', 'Email sedang dikirim. Selanjutnya adalah Tahap Penugasan.');
            return redirect(route('periode', $name));
        } else {
            Alert::error('Tahap Wawancara ' . ucfirst($periodeSelected->name) . ' Gagal Diumumkan.', 'Cek data kembali.');
            return redirect(route('periode', $name));
        }
    }

    public function sendEmailPenugasan($name)
    {

        $periodeSelected = Periode::where('name', '=', $name)->first();
        if ($periodeSelected->group_wa == null) {
            Alert::error('Gagal! Mohon isi link Group WhatsApp ' . ucfirst($periodeSelected->name) . ' terlebih Dahulu! ', 'Terimakasih.');
            return back();
        }
        $periodeSelected->status_png = 'Selesai';
        $periodeSelected->ts_png = now();
        $periodeSelected->save();

        if ($periodeSelected) {
            $periodeOpenned = Periode::where('name', '=', $name)->first();

            $getPenugasanUser = Administrasi::with('user')->where('periode_id', '=', $periodeOpenned->id_periode)
                ->where('status_wwn', '=', 'lolos')
                ->leftJoin('wawancaras', 'wawancaras.administrasi_id', '=', 'administrasis.id')
                ->leftJoin('penugasans', 'penugasans.wawancara_id', '=', 'wawancaras.id')
                ->leftJoin('users', 'users.id', '=', 'administrasis.user_id')
                ->leftJoin('univs', 'univs.id', '=', 'users.univ_id')
                ->leftJoin('prodis', 'prodis.id', '=', 'users.prodi_id')
                ->get();

            foreach ($getPenugasanUser as $userPng) {
                $mail_data = [
                    'name' => $name,
                    'data' => $userPng,
                    'periode' => $periodeOpenned
                ];
                $delay = DB::table('jobs')->count() * 4;
                $job = (new SendPngJob($mail_data))
                    ->delay(Carbon::now()->addSeconds($delay));
                dispatch($job);
            }
            Alert::success('Tahap Penugasan ' . ucfirst($periodeSelected->name) . ' sudah Diumumkan.', 'Email sedang dikirim. Selanjutnya menunggu peserta untuk bergabung dengan Group Whatsapp');
            return redirect(route('periode', $name));
        } else {
            Alert::error('Tahap Penugasan ' . ucfirst($periodeSelected->name) . ' Gagal Diumumkan.', 'Cek data kembali.');
            return redirect(route('periode', $name));
        }
    }
}
