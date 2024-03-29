<?php

namespace App\Http\Controllers;

use App\Exceptions\ProfileNameDuplicated;
use App\Exceptions\NoNameSelected;
use App\Exceptions\NoWordsSelected;
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
    if (!strlen($request->name)) {
      throw new NoNameSelected('You must choose a name');
    }
    if (!$request->useWordsFromApi) {
      if (!count($request->words)) {
        throw new NoWordsSelected('You must choose at least on word');
      }
    }
    $profile = new Profile([
      'name' => $request->name,
      'auto_difficulty' => $request->isAutoDifficultyEnabled,
      'use_words_from_api' => $request->useWordsFromApi,
      'test_length' => $request->testLength,
    ]);
    $user->profiles()->save($profile);
    foreach ($request->words as $word) {
      $newWord = new Word(['word' => $word]);
      $profile->words()->save($newWord);
    }
    return response()->json($profile);
  }

  public function updateProfile(Request $request)
  {
    $user = $request->user();
    if (
      $user
        ->profiles()
        ->where('id', '!=', $request->id)
        ->where('name', $request->name)
        ->exists()
    ) {
      throw new ProfileNameDuplicated('Profile with that name already exists');
    }
    if (!strlen($request->name)) {
      throw new NoNameSelected('You must choose a name');
    }
    if (!$request->useWordsFromApi) {
      if (!count($request->words)) {
        throw new NoWordsSelected('You must choose at least on word');
      }
    }
    $profile = Profile::findOrFail($request->id);
    $profile->update([
      'name' => $request->name,
      'auto_difficulty' => $request->isAutoDifficultyEnabled,
      'use_words_from_api' => $request->useWordsFromApi,
      'test_length' => $request->testLength,
    ]);
    $profile->words()->delete();
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
  //   public function updateProfile(Request $request)
  //   {
  //     $profile = Profile::findOrFail($request->id);
  //     $profile->name = $request->name;
  //     $profile->save();
  //     return response()->json($profile);
  //   }
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
