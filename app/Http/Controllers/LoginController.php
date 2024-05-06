<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = [
            'username' => $request['username'],
            'password' => $request['password'],
        ];

        if (Auth::attempt($credentials)) {
            return redirect('/dashboard');
        }
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    public function logout()
    {
        auth()->logout();return redirect('/login');
    }
}
