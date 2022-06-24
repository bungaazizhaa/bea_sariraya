<?php

namespace App\Jobs;

use App\Mail\SendEmailWawancara;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use romanzipp\QueueMonitor\Traits\IsMonitored;

class SendWwnJob implements ShouldQueue
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

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $userWwn = $this->mail_data['data'];
        $periode = $this->mail_data['periode'];
        $this->queueData([$userWwn->email]);
        Mail::to($userWwn->email)->send(new SendEmailWawancara($userWwn, $periode));
    }
}
