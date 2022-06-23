<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailPenugasan extends Mailable
{
    use Queueable, SerializesModels;
    public $userPng;
    public $periode;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userPng, $periode)
    {
        $this->userPng = $userPng;
        $this->periode = $periode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this
            ->subject('Pengumuman Akhir Beasiswa Sariraya')
            ->cc('alvin.alvrahesta.dev@gmail.com')
            ->view('emails.emailPng');
    }
}
