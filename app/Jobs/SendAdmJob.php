<?php

namespace App\Jobs;

use App\Mail\SendEmailAdministrasi;
use App\Models\Administrasi;
use App\Models\Periode;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use romanzipp\QueueMonitor\Traits\IsMonitored;

class SendAdmJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use IsMonitored;
    protected $mail_data;
    public $timeout = 600; // 10 menit
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mail_data)
    {
        $this->mail_data = $mail_data;
    }

    // public function retryUntil()
    // {
    //     return now()->addMinutes(30);
    // }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $userAdm = $this->mail_data['data'];
        $periode = $this->mail_data['periode'];
        $this->queueData([$userAdm->email, $userAdm->name, $userAdm->nama_universitas, $userAdm->nama_prodi, $userAdm->status_adm]);
        Mail::to($userAdm->email)->send(new SendEmailAdministrasi($userAdm, $periode));
    }
}
