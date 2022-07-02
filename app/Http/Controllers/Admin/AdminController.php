<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Hash;
use App\Admin;
use DB;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $user = Admin::paginate(10);

        return view('admin.index', [
            'user' => $user,
        ]);
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $data = $request->except(['_token', '_method']);
        $data['password'] = Hash::make('password');
        DB::table('admin')->insert($data);

        return redirect()->route('admin.admin.index')->with('status', 'Admin berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = DB::table('admin')->where('id', $id)->first();

        return view('admin.edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->except(['_token', '_method']);
        DB::table('admin')->where('id', $id)->update($data);

        return redirect()->route('admin.admin.index')->with('status', 'Admin berhasil diperbarui');
    }

    public function destroy($id)
    {
        DB::table('admin')->where('id', $id)->delete();

        return redirect()->route('admin.admin.index')->with('status', 'Admin berhasil dihapus');
    }
}
