<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;

class ProfileController extends Controller
{
    public function createProfile(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $profile = Profile::create(['name'=>$request->name, 'user_id'=>$user->id]);
        $user->profiles()->save($profile);
        return response()->json($profile);
    }
    public function deleteProfile(Request $request)
    {
        $user = $request->user();
        $profile = Profile::findOrFail($request->id);
        if($profile->id === $user->selected_profile_id){
            $startingProfile = $user->profiles()->where('name', 'Starting Profile')->firstOrFail();
            $user->selectedProfile()->associate($startingProfile)->save();
        };
        $profile->delete();
        return response()->json($profile);
    }
    public function getProfiles(Request $request)
    {
        $user = User::findOrFail($request->id);
        $profiles = $user->profiles()->get();
        return response()->json($profiles);
    }
    public function updateProfile(Request $request){
        $profile = Profile::findOrFail($request->id);
        $profile->name = $request->name;
        $profile->save();
        return response()->json($profile);
    }
    public function useProfile(Request $request)
    {
        $profile = Profile::findOrFail($request->id);
        $request->user()->selectedProfile()->associate($profile)->save();
        return response()->json($profile);
    }
}
