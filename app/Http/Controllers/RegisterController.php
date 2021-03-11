<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Profile;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'email' => ['required', 'unique:users'],
            'password' =>['required']
        ]);
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'selected_profile_id' => null
            ]);
        $startingProfile = Profile::create(['name' => 'Starting Profile', 'user_id' => $user->id]);
        $user->profiles()->save($startingProfile);
        $user->selectedProfile()->associate($startingProfile)->save();
        return response()->json($user);
    }
}
