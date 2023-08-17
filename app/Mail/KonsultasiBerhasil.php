<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KonsultasiBerhasil extends Mailable
{
    use Queueable, SerializesModels;

    public $schedule;
    public $user;

    public function __construct($schedule, $user)
    {
        $this->schedule = $schedule;
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Jadwal Konsultasi Berhasil Dibuat')
                    ->view('emails.konsultasi_berhasil');
    }
}
