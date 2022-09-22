<?php

namespace App\Mail;

use App\Models\Profile;
use App\Models\Reports;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $profiles;
    public $linkeds;

    public function __construct($data, $profiles, $linkeds)
    {
        $this->data = $data;
        $this->profiles = $profiles;
        $this->linkeds = $linkeds;
    }

    public function build()
    {
        return $this->view('mail.reportMail', [
            'data' => $this->data,
            'profiles' => $this->profiles,
            'linkeds' => $this->linkeds
        ]);
    }
}
