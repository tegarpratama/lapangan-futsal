<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\LapanganFutsal;
use DB;

class FutsalController extends Controller
{
    public function index(Request $request)
    {
        $user = LapanganFutsal::paginate(10);

        return view('futsal.index', [
            'user' => $user,
        ]);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
        $futsal = DB::table('lapangan_futsal')->where('id', $id)->first();
        $operasional = explode(PHP_EOL, $futsal->jam_operasional);

        return view('futsal.show', [
            'futsal' => $futsal,
            'jam' => $operasional
        ]);
    }

    public function edit($id)
    {
        $futsal = DB::table('lapangan_futsal')->where('id', $id)->first();

        return view('futsal.edit', [
            'futsal' => $futsal,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->except(['_token', '_method']);
        $futsal = DB::table('lapangan_futsal')->where('id', $id)->first();

        if ($request->hasFile('gambar')) {
            Storage::disk('public')->delete($futsal->gambar);

            $extension =  $request->gambar->extension();
            $newName = date('Ymd-His') . '.' . $extension;
            $data['gambar'] = 'gambar/' . $newName;
            Storage::putFileAs('public/gambar', $request->gambar, $newName);
        }

        DB::table('lapangan_futsal')->where('id', $id)->update($data);

        return redirect()->route('admin.futsal.index')->with('status', 'Informasi lapangan futsal berhasil ditambahkan');
    }

    public function destroy($id)
    {

    }
}
