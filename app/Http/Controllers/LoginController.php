<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'title' => 'Login',
            'active' => 'Login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials  = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials, ['role_id' => 1])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        elseif (Auth::attempt($credentials, ['role_id' => 2])){
            $request->session()->regenerate();
            return redirect()->intended('/dashboard-ustad');
        }elseif (Auth::attempt($credentials, ['role_id' => 3])){
            $request->session()->regenerate();
            return redirect()->intended('/dashboard-santri');
        }

        return back()->with('loginError','Login failed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
