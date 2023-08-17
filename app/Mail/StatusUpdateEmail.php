<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Schedule;

class StatusUpdateEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $schedule;
    public $newStatus;

    public function __construct(Schedule $schedule, $newStatus)
    {
        $this->schedule = $schedule;
        $this->newStatus = $newStatus;
    }

    public function build()
    {
        return $this->subject('Pembaruan Status Konsultasi')
                    ->view('emails.status_update');
    }
}
