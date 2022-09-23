<?php

namespace App\Http\Controllers\Mails;

use App\Http\Controllers\Controller;
use App\Mail\ReportMail;
use App\Models\Profile;
use App\Models\Reports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendMailController extends Controller
{
    public function sendMail(Reports $reports, Profile $profile, $id)
    {
        $linkeds = DB::table('reports')
            ->where('reports.id', '=', $id)
            ->join('reports_profiles', 'reports.id', '=', 'reports_profiles.report_id')
            ->join('profiles', 'reports_profiles.profile_id', '=', 'profiles.id')
            ->select([
                'reports.id',
                'reports.title',
                'reports.description',
                'reports_profiles.profile_id',
                'profiles.first_name',
                'profiles.last_name',
                'profiles.dbo',
                'profiles.gender'
            ])
            ->get()
            ->sortBy('profile_id');

        $mail = new ReportMail(
            $reports->all()->where('id', $id),
            $profile->all()->sortBy('id'),
            $linkeds
        );

        Mail::to('gabriel.goncal.freitas@gmail.com')->send($mail);

        return redirect('/reports');
    }
}
