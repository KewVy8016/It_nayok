<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AdminAuthController extends Controller
{


    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
        ]);
    
        if (Auth::guard('admins')->attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
        'status' => 'รหัสผ่านหรืออีเมล์ไม่ถูกต้อง'
         ]);
    }
    public function logout(Request $request)
    {
        Auth::guard('admins')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}