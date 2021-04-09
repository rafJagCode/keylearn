<?php

namespace App\Http\Controllers;

use App\Exceptions\ProfileNameDuplicated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;
use App\Models\Word;

class ProfileController extends Controller
{
  public function createProfile(Request $request)
  {
    $user = $request->user();
    if (
      $user
        ->profiles()
        ->where('name', $request->name)
        ->exists()
    ) {
      throw new ProfileNameDuplicated('Profile with that name already exists');
    }
    $profile = new Profile(['name' => $request->name]);
    $user->profiles()->save($profile);
    foreach ($request->words as $word) {
      $newWord = new Word(['word' => $word]);
      $profile->words()->save($newWord);
    }
    return response()->json($profile);
  }
  public function deleteProfile(Request $request)
  {
    $user = $request->user();
    $profile = Profile::findOrFail($request->id);
    if ($profile->id === $user->selected_profile_id) {
      $startingProfile = $user
        ->profiles()
        ->where('name', 'Starting Profile')
        ->firstOrFail();
      $user
        ->selectedProfile()
        ->associate($startingProfile)
        ->save();
    }
    $profile->delete();
    return response()->json($profile);
  }
  public function getProfiles(Request $request)
  {
    $user = $request->user();
    $profiles = $user
      ->profiles()
      ->with('words', 'charsStatistics', 'wordsStatistics')
      ->get();
    return response()->json($profiles);
  }
  public function updateProfile(Request $request)
  {
    $profile = Profile::findOrFail($request->id);
    $profile->name = $request->name;
    $profile->save();
    return response()->json($profile);
  }
  public function useProfile(Request $request)
  {
    $profile = Profile::findOrFail($request->id);
    $request
      ->user()
      ->selectedProfile()
      ->associate($profile)
      ->save();
    return response()->json($profile);
  }
}
