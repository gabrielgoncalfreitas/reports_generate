<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Reports;
use App\Models\ReportsProfiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    # Returns the reports main page
    public function index(Request $r)
    {
        $data = Reports::all()->sortBy('id');

        return view('reports.reports', [
            'data' => $data
        ]);
    }

    # Returns the reports create page
    public function createReport(Reports $reports)
    {
        return view('reports.create', [
            'users' => $reports->all()->sortBy('id')
        ]);
    }

    # Create a report
    public function create(Request $r, Reports $reports)
    {
        $reports->title       = $r->title;
        $reports->description = $r->description;

        $reports->save();

        return "/reports/linkprofile/" . $reports->all()->sortByDesc('id')->first()->id;
    }

    # View report
    public function view(Reports $reports, Profile $profile, $id)
    {
        # Join all profiles linkeds on the report
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

        return view('reports.view', [
            'reports' => $reports->all()->where('id', $id), # All reports from reports table
            'profiles' => $profile->all()->sortBy('id'), # All profiles from profiles table
            'linkeds' => $linkeds # All profiles linkeds on the report
        ]);
    }

    # Change report
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

    # Delete report and all linked profiles
    public function delete(Reports $reports, ReportsProfiles $reportsprofiles, $id)
    {
        $reportsprofiles->where('report_id', $id)->delete();
        $reports->where('id', $id)->delete();

        return redirect('/reports');
    }

    # Return the link profile page
    public function linkProfileIndex(Reports $reports, Profile $profile, $id)
    {
        # Join all profiles linkeds on the report
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
            ->sortBy('profile_id');;

        return view('reports.linkprofile', [
            'reports' => $reports->all()->where('id', $id), # All reports from reports table
            'profiles' => $profile->all()->sortBy('id'), # All profiles from profiles table
            'linkeds' => $linkeds # All profiles linkeds on the report
        ]);
    }

    # Delete a linked profile from report
    public function linkProfileDelete($report_id, $profile_id)
    {
        # Return only profiles from this report
        DB::table('reports_profiles')
            ->where('report_id', '=', $report_id)
            ->where('profile_id', '=', $profile_id)
            ->delete();

        return redirect("/reports/linkprofile/$report_id");
    }

    # Link profile to report
    public function linkProfileLink(Request $r, ReportsProfiles $reportsprofiles)
    {
        $data = $reportsprofiles
            ->all()
            ->where('report_id', '=', $r->report_id)
            ->where('profile_id', '=', $r->profile_id);

        # Check if the profile is already linked
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
