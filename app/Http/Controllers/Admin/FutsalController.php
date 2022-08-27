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
        $futsal = LapanganFutsal::with('gambar')->where('id', $id)->first();
        $operasional = explode(PHP_EOL, $futsal->jam_operasional);
        $fasilitas = explode(PHP_EOL, $futsal->fasilitas);

        return view('futsal.show', [
            'futsal' => $futsal,
            'jam' => $operasional,
            'fasilitas' => $fasilitas
        ]);
    }

    public function edit($id)
    {
        $futsal = LapanganFutsal::with('gambar')->where('id', $id)->first();

        return view('futsal.edit', [
            'futsal' => $futsal,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->except(['_token', '_method', 'gambar']);
        $futsal = DB::table('lapangan_futsal')->where('id', $id)->first();

        if ($request->hasFile('gambar')) {
            $i = 1;
            foreach ($request->file('gambar') as $imagefile) {
                $extension =  $imagefile->extension();
                $newName = $i . date('Ymd-His') . '.' . $extension;
                $dataImage = 'gambar/' . $newName;
                Storage::putFileAs('public/gambar', $imagefile, $newName);

                DB::table('gambar_lapangan_futsal')->insert([
                    'lapangan_futsal_id' => $id,
                    'gambar' => $dataImage
                ]);

                $i++;
            }
        }

        DB::table('lapangan_futsal')->where('id', $id)->update($data);

        return redirect()->route('admin.futsal.index')->with('status', 'Informasi lapangan futsal berhasil ditambahkan');
    }

    public function destroy($id)
    {

    }
}
