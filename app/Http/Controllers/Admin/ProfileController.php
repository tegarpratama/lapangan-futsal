<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Hash;
use App\Admin;
use DB;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Admin::findOrFail(auth()->guard('admin')->user()->id);

        return view('profile.index', [
            'profile' => $profile
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $profile = Admin::findOrFail(auth()->guard('admin')->user()->id);
        $profile->update($data);

        return redirect()->route('admin.profile.index')->with('status', 'Profil anda berhasil diperbarui.');
    }
}
