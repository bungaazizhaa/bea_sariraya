<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailWawancara extends Mailable
{
    use Queueable, SerializesModels;
    public $userWwn;
    public $periode;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userWwn, $periode)
    {
        $this->userWwn = $userWwn;
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
            ->subject('Pengumuman Wawancara Beasiswa Sariraya')
            ->cc('alvin.alvrahesta.dev@gmail.com')
            ->view('emails.emailWwn');
    }
}
