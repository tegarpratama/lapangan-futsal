<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Hash;
use App\User;
use DB;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:user,email',
            'password' => 'required|min:6',
            'password_confirm' => 'required|same:password'
        ]);

        $data = $request->except(['_token', 'password_confirm']);
        $data['password'] = Hash::make($request->password);

        User::create($data);

        return redirect()->route('login.index')->with('success', 'Regristasi berhasil, silahkan login.');
    }
}
