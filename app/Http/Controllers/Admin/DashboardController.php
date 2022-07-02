<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $admin = DB::table('admin')->count();
        $user = DB::table('user')->count();
        $futsal = DB::table('lapangan_futsal')->count();

        return view('dashboard.index', [
            'admin' => $admin,
            'user' => $user,
            'futsal' => $futsal,
        ]);
    }
}
