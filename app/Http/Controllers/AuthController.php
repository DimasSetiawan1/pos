<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password
        ];

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();

            if(Auth::user()->role == 'admin')
            {
                return redirect('/dashboard-admin');
            }

            if(Auth::user()->role == 'kasir')
            {
                return redirect('/dashboard-kasir');
            }
        }

        return back()->with('error','Username atau Password Salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}