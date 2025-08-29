<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request ){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|',
        ]);

        if(Auth::attempt($request->only('email', 'password'))){
            $request->session()->regenerate();
            if(Auth::user()->role === 'admin'){
                return redirect()->route('admin.dashboard.index')->with('success', 'You are logged in successfully.');
            }else{
                return redirect()->route('student.dashboard.index')->with('success', 'You are logged in successfully.');
            }
        }

        return back()->with('error', 'The provided credentials do not match our records.')
            ->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'You have been logged out successfully.');
    }

}
