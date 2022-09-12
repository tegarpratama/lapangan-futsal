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

        $futsal = DB::table('lapangan_futsal')
            ->join('lokasi_user', 'lapangan_futsal.id', 'lokasi_user.lapangan_futsal_id')
            ->select('lapangan_futsal.latitude', 'lapangan_futsal.longitude', 'lapangan_futsal.nama', 'lapangan_futsal.id','lapangan_futsal.alamat')
            ->where('lokasi_user.user_id', $id)
            ->get();

        $i = 0;
        foreach($futsal as $f) {
            $gambar = DB::table('gambar_lapangan_futsal')->select('gambar')->where('lapangan_futsal_id', $f->id)->get();
            $futsal[$i]->gambar = $gambar;
            $i++;
        }

        return view('pengguna.show', [
            'futsal' => $futsal,
            'user' => $user
        ]);
    }
}
