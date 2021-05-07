<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Profile;
use App\Models\Word;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
  public function register(Request $request)
  {
    try {
      $request->validate([
        'email' => ['required', 'unique:users'],
      ]);

      $user = User::create([
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'selected_profile_id' => null,
      ]);
      $startingProfile = new Profile([
        'name' => 'Starting Profile',
        'auto_difficulty' => false,
        'use_words_from_api' => true,
        'test_length' => 20,
      ]);
      $user->profiles()->save($startingProfile);
      $user
        ->selectedProfile()
        ->associate($startingProfile)
        ->save();
      return response()->json($user);
    } catch (QueryException $e) {
      throw new Exception('Server is having trouble right now. Please try again later', $e->getCode(), $e);
    } catch (ValidationException $e) {
      throw new Exception('This email address is already being used', $e->getCode(), $e);
    } catch (Exception $e) {
      throw new Exception('Something went wrong', $e->getCode(), $e);
    }
  }
}
