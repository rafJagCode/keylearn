<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'email' => ['required', 'unique:users'],
            'password' =>['required']
        ]);
        User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
    }
}
