<?php

namespace App\Http\Controllers;

use App\Exceptions\IncorrectLoginCredentials;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;

class LoginController extends Controller
{
	public function login(Request $request)
	{
		try {
			$request->validate([
				'email' => ['required', 'email'],
				'password' => ['required'],
			]);
			if (Auth::attempt($request->only('email', 'password'))) {
				return response()->json(Auth::user(), 200);
			} else {
				throw new IncorrectLoginCredentials('Provided credentials are incorrect');
			}
		} catch (IncorrectLoginCredentials $e) {
			throw $e;
		} catch (QueryException $e) {
			throw new Exception('Server is having trouble right now. Please try again later', $e->getCode(), $e);
		} catch (Exception $e) {
			throw new Exception('Something went wrong', $e->getCode(), $e);
		}
	}

	public function logout()
	{
		Auth::logout();
	}
}
