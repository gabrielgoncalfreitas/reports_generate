<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\ReportsProfiles;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Profile $profile)
    {
        return view('profile.profiles', [
            'data' => $profile->all()->sortBy('id')
        ]);
    }

    public function create(Profile $profile, Request $r)
    {
        $profile->first_name = $r->first_name;
        $profile->last_name  = $r->last_name;
        $profile->dbo        = $r->dbo;
        $profile->gender     = $r->gender;

        $profile->save();

        return 'Profile created!';
    }


    public function update(Request $r, Profile $profile, $id)
    {
        $data = [
            'id'         => $id,
            'first_name' => $r->first_name,
            'last_name'  => $r->last_name,
            'dbo'        => $r->dbo,
            'gender'     => $r->gender,
        ];

        $profile->where('id', $id)->update($data);

        return redirect('/');
    }

    public function delete(profile $profile, ReportsProfiles $reportsprofiles, $id)
    {
        $reportsprofiles->where('profile_id', $id)->delete();
        $profile->where('id', $id)->delete();

        return redirect('/');
    }
}
