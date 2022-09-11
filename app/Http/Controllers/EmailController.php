<?php

namespace App\Http\Controllers;

use App\Jobs\SendAdmJob;
use App\Jobs\SendPngJob;
use App\Jobs\SendWwnJob;
use App\Mail\SendEmailAdministrasi;
use App\Mail\SendEmailPenugasan;
use App\Mail\SendEmailWawancara;
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
    public function sendEmailAdministrasi($name, $emailid)
    {
        $periode = Periode::where('name', '=', $name)->first();
        $userAdm = Administrasi::select('*', 'administrasis.id AS id')->where('periode_id', '=', $periode->id_periode)
            ->where('administrasis.user_id', '=', $emailid)
            ->leftJoin('wawancaras', 'administrasis.id', '=', 'wawancaras.administrasi_id')
            ->leftJoin('penugasans', 'penugasans.wawancara_id', '=', 'wawancaras.id')
            ->leftJoin('users', 'users.id', '=', 'administrasis.user_id')
            ->leftJoin('univs', 'univs.id', '=', 'users.univ_id')
            ->leftJoin('prodis', 'prodis.id', '=', 'users.prodi_id')
            ->orderBy('jadwal_wwn', 'asc')
            ->first();
        Mail::to($userAdm->email)->send(new SendEmailAdministrasi($userAdm, $periode));

        $updateEmailSent = Administrasi::with('user')->where('periode_id', '=', $periode->id_periode)
            ->where('administrasis.user_id', '=', $emailid)->first();
        $updateEmailSent->email_sent_at = now();
        $updateEmailSent->save();

        if ($updateEmailSent) {
            Alert::success('Berhasil!', 'Email Pengumuman Administrasi Telah dikirimkan ke email ' . $userAdm->email . ' dengan Status Peserta: ' . ucfirst($userAdm->status_adm) . '.')->autoClose(false);
        } else {
            Alert::error('Gagal!', 'Email Pengumuman Administrasi Gagal dikirimkan ke email ' . $userAdm->email)->autoClose(false);
        }

        return view('emails.emailAdmPreview', compact('userAdm', 'periode'));
    }

    public function sendEmailWawancara($name, $emailid)
    {
        $periode = Periode::where('name', '=', $name)->first();

        $userWwn = Administrasi::where('periode_id', '=', $periode->id_periode)
            ->where('status_adm', '=', 'lolos')
            ->where('administrasis.user_id', '=', $emailid)
            ->leftJoin('users', 'users.id', '=', 'administrasis.user_id')
            ->leftJoin('wawancaras', 'wawancaras.administrasi_id', '=', 'administrasis.id')
            ->leftJoin('penugasans', 'penugasans.wawancara_id', '=', 'wawancaras.id')
            ->leftJoin('univs', 'univs.id', '=', 'users.univ_id')
            ->leftJoin('prodis', 'prodis.id', '=', 'users.prodi_id')
            ->orderBy('jadwal_wwn', 'asc')
            ->select('*', 'wawancaras.id AS wwnid')
            ->first();

        Mail::to($userWwn->email)->send(new SendEmailWawancara($userWwn, $periode));

        $updateEmailSent = Wawancara::where('wawancaras.id', '=', $userWwn->wwnid)->first();
        $updateEmailSent->email_sent_at = now();
        $updateEmailSent->save();

        if ($updateEmailSent) {
            Alert::success('Berhasil!', 'Email Pengumuman Wawancara Telah dikirimkan ke email ' . $userWwn->email . ' dengan Status Peserta: ' . ucfirst($userWwn->status_wwn) . '.')->autoClose(false);
        } else {
            Alert::error('Gagal!', 'Email Pengumuman Wawancara Gagal dikirimkan ke email ' . $userWwn->email)->autoClose(false);
        }

        return view('emails.emailWwnPreview', compact('userWwn', 'periode'));
    }

    public function sendEmailPenugasan($name, $emailid)
    {
        $periode = Periode::where('name', '=', $name)->first();

        $userPng = Administrasi::where('periode_id', '=', $periode->id_periode)
            ->where('status_wwn', '=', 'lolos')
            ->where('administrasis.user_id', '=', $emailid)
            ->leftJoin('users', 'users.id', '=', 'administrasis.user_id')
            ->leftJoin('wawancaras', 'wawancaras.administrasi_id', '=', 'administrasis.id')
            ->leftJoin('penugasans', 'penugasans.wawancara_id', '=', 'wawancaras.id')
            ->leftJoin('univs', 'univs.id', '=', 'users.univ_id')
            ->leftJoin('prodis', 'prodis.id', '=', 'users.prodi_id')
            ->select('*', 'administrasis.id AS admid', 'penugasans.id AS pngid')
            ->first();

        Mail::to($userPng->email)->send(new SendEmailPenugasan($userPng, $periode));


        $updateEmailSent = Penugasan::where('penugasans.id', '=', $userPng->pngid)->first();
        $updateEmailSent->email_sent_at = now();
        $updateEmailSent->save();

        if ($updateEmailSent) {
            Alert::success('Berhasil!', 'Email Pengumuman Penugasan Telah dikirimkan ke email ' . $userPng->email . ' dengan Status Peserta: ' . ucfirst($userPng->status_png) . '.')->autoClose(false);
        } else {
            Alert::error('Gagal!', 'Email Pengumuman Penugasan Gagal dikirimkan ke email ' . $userPng->email)->autoClose(false);
        }

        return view('emails.emailPngPreview', compact('userPng', 'periode'));
    }
}
