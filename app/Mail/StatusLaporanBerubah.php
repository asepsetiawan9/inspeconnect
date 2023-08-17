<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StatusLaporanBerubah extends Mailable
{
    use Queueable, SerializesModels;

    public $report;
    public $statusLaporan;

    public function __construct($report, $statusLaporan)
    {
        $this->report = $report;
        $this->statusLaporan = $statusLaporan;
        // dd($statusLaporan);
    }

    public function build()
    {
        
        return $this->subject('Status Laporan Berubah')
                    ->view('emails.status_laporan_berubah');
    }
}
