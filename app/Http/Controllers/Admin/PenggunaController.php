<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\LokasiUser;
use DB;

class PenggunaController extends Controller
{
    public function index(Request $request)
    {
        $user = User::paginate(10);

        return view('pengguna.index', [
            'user' => $user,
        ]);
    }

    public function show($id)
    {
        $user = User::find($id)->first();
        $futsal  = LokasiUser::with('futsal')->where('user_id', $id)->get();

        return view('pengguna.show', [
            'futsal' => $futsal,
            'user' => $user
        ]);
    }
}
