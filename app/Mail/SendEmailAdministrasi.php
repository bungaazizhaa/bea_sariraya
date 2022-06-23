<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailAdministrasi extends Mailable
{
    use Queueable, SerializesModels;
    public $userAdm;
    public $periode;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userAdm, $periode)
    {
        $this->userAdm = $userAdm;
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
            ->subject('Pengumuman Administrasi Beasiswa Sariraya')
            ->cc('alvin.alvrahesta.dev@gmail.com')
            ->view('emails.emailAdm');
    }
}
