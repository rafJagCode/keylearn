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
      $startingProfile = new Profile(['name' => 'Starting Profile']);
      $user->profiles()->save($startingProfile);
      $user
        ->selectedProfile()
        ->associate($startingProfile)
        ->save();
      $words = ['testowanie', 'słów', 'profilu', 'startowego'];
      foreach ($words as $word) {
        $wordToAdd = new Word(['word' => $word]);
        $startingProfile->words()->save($wordToAdd);
      }
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
