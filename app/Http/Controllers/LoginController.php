<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('/admin');
        } else if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('/');
        }

        return back()->with('status', 'Email atau password salah!');
    }

    public function logout()
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            return redirect('/');
        } else if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
            return redirect('/');
        }
    }
}
