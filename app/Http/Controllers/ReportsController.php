<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Reports;
use App\Models\ReportsProfiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function index(Request $r)
    {
        $data = Reports::all()->sortBy('id');

        return view('reports.reports', [
            'data' => $data
        ]);
    }

    public function createIndex(Request $r, Reports $reports)
    {
        return view(
            'reports.create',
            [
                'users' => $reports->all()->sortBy('id')
            ]
        );
    }

    public function create(Request $r, Reports $reports)
    {
        $reports->title       = $r->title;
        $reports->description = $r->description;

        $reports->save();

        return 'Report created!';
    }

    public function view(Reports $reports, Profile $profile, $id)
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
            ->get();

        return view('reports.view', [
            'data' => $reports->all()->where('id', $id),
            'profiles' => $profile->all()->sortBy('id'),
            'linkeds' => $linkeds
        ]);
    }

    public function update(Request $r, Reports $reports, $id)
    {
        $data = [
            'id'           => $id,
            'title'        => $r->title,
            'description'  => $r->description,
        ];

        $reports->where('id', $id)->update($data);

        return redirect('/reports');
    }

    public function delete(Reports $reports, ReportsProfiles $reportsprofiles, $id)
    {
        $reportsprofiles->where('report_id', $id)->delete();
        $reports->where('id', $id)->delete();

        return redirect('/reports');
    }

    public function linkProfileIndex(Reports $reports, Profile $profile, $id)
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
            ->get();

        return view('reports.linkprofile', [
            'data' => $reports->all()->where('id', $id),
            'profiles' => $profile->all()->sortBy('id'),
            'linkeds' => $linkeds
        ]);
    }

    public function linkProfileDelete($report_id, $profile_id)
    {
        DB::table('reports_profiles')
            ->where('report_id', '=', $report_id)
            ->where('profile_id', '=', $profile_id)
            ->delete();

        return redirect("/reports/linkprofile/$report_id");
    }

    public function linkProfileLink(Request $r, ReportsProfiles $reportsprofiles)
    {
        $data = $reportsprofiles
            ->all()
            ->where('report_id', '=', $r->report_id)
            ->where('profile_id', '=', $r->profile_id);

        foreach ($data as $_data) {
            if ($_data != '') {
                return 'Profile already linked!';
            }
        }

        $reportsprofiles->report_id  = $r->report_id;
        $reportsprofiles->profile_id = $r->profile_id;

        $reportsprofiles->save();

        return 'Profile linked!';
    }
}
