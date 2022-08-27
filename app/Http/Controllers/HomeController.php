<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\User;
use App\LapanganFutsal;
use App\LokasiUser;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function store(Request $request)
    {
        User::where('id', auth()->guard('user')->user()->id)->update([
            'latitude' => $request->lathidden,
            'longitude' => $request->lnghidden
        ]);

        return redirect()->route('user.nearby');
    }

    public function nearby()
    {
        $client = new Client();
        $loc = User::find(auth()->guard('user')->user()->id);
        LokasiUser::where('user_id', auth()->guard('user')->user()->id)->delete();

        $data = $client->get(
            'https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=' .
            $loc->latitude . '%2C' . $loc->longitude .
            '&radius=1500&keyword=futsal&key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k'
        );
        $result = json_decode($data->getBody());

        // Save lapangan futsal
        $dataLoc[] = [];
        if (count($result->results) > 0) {
            $i = 0;
            foreach($result->results as $r) {
                if ($i == 4) {
                    break;
                }

                $futsal = LapanganFutsal::where('place_id', $r->place_id)->first();

                if ($futsal == null) {
                    $futsalNew = LapanganFutsal::create([
                        'place_id' => $r->place_id,
                        'nama' => $r->name,
                        'rating' => $r->rating,
                        'user_ratings_total' => $r->user_ratings_total,
                        'latitude' => $r->geometry->location->lat,
                        'longitude' => $r->geometry->location->lng,
                        'alamat' => $r->vicinity
                    ]);

                    $futsalId = $futsalNew->id;
                    LokasiUser::create([
                        'user_id' => auth()->guard('user')->user()->id,
                        'lapangan_futsal_id' => $futsalId
                    ]);

                    $dataLoc[$i] = [
                        'lat' => $r->geometry->location->lat,
                        'lng' => $r->geometry->location->lng
                    ];
                } else {
                    LokasiUser::create([
                        'user_id' => auth()->guard('user')->user()->id,
                        'lapangan_futsal_id' => $futsal->id
                    ]);

                    $dataLoc[$i] = [
                        'lat' => $futsal->latitude,
                        'lng' => $futsal->longitude
                    ];
                }

                $i++;
            }
        }

        return view('nearby', [
            'location' => $loc,
            'data' => $dataLoc
        ]);
    }

    public function calculate(Request $request)
    {
        $up = 1;
        $down = 4;

        for ($i = 4; $i >= 1; $i--) {
            $up *= $up * $i;
        }

        $kombinasi = $up / $down;

        $futsal = LokasiUser::with('futsal')->where('user_id', auth()->guard('user')->user()->id)->get();

        $ab = $this->twopoints_on_earth(
            $futsal[0]->futsal->latitude, $futsal[0]->futsal->longitude,
            $futsal[1]->futsal->latitude, $futsal[1]->futsal->longitude
        );
        $bc = $this->twopoints_on_earth(
            $futsal[1]->futsal->latitude, $futsal[1]->futsal->longitude,
            $futsal[2]->futsal->latitude, $futsal[2]->futsal->longitude
        );
        $cd = $this->twopoints_on_earth(
            $futsal[2]->futsal->latitude, $futsal[2]->futsal->longitude,
            $futsal[3]->futsal->latitude, $futsal[3]->futsal->longitude
        );
        $da = $this->twopoints_on_earth(
            $futsal[3]->futsal->latitude, $futsal[3]->futsal->longitude,
            $futsal[0]->futsal->latitude, $futsal[0]->futsal->longitude
        );

        $total = $ab + $bc + $cd + $da;
        $master = [];
        $best = [];
        $distance = [];
        $test = [];
        $default = 'ABCD';

        for ($i = 0; $i < 6; $i++) {
            $char = str_split($default);

            for ($j = 0; $j < 6; $j++) {
                $newStr = '';

                if ($j == 0) {
                    $newStr = $char[1] . $char[0] . $char[2] . $char[3];
                    $temp1 = $this->twopoints_on_earth(
                        $futsal[$this->convert($char[1])]->futsal->latitude,
                        $futsal[$this->convert($char[1])]->futsal->longitude,
                        $futsal[$this->convert($char[0])]->futsal->latitude,
                        $futsal[$this->convert($char[0])]->futsal->longitude
                    );
                    $temp2 = $this->twopoints_on_earth(
                        $futsal[$this->convert($char[0])]->futsal->latitude,
                        $futsal[$this->convert($char[0])]->futsal->longitude,
                        $futsal[$this->convert($char[2])]->futsal->latitude,
                        $futsal[$this->convert($char[2])]->futsal->longitude
                    );
                    $temp3 = $this->twopoints_on_earth(
                        $futsal[$this->convert($char[2])]->futsal->latitude,
                        $futsal[$this->convert($char[2])]->futsal->longitude,
                        $futsal[$this->convert($char[3])]->futsal->latitude,
                        $futsal[$this->convert($char[3])]->futsal->longitude
                    );
                    $tempTotal = $temp1 + $temp2 + $temp3;
                } else if ($j == 1) {
                    $newStr = $char[0] . $char[2] . $char[1] . $char[3];
                    $temp1 = $this->twopoints_on_earth(
                        $futsal[$this->convert($char[0])]->futsal->latitude,
                        $futsal[$this->convert($char[0])]->futsal->longitude,
                        $futsal[$this->convert($char[2])]->futsal->latitude,
                        $futsal[$this->convert($char[2])]->futsal->longitude
                    );
                    $temp2 = $this->twopoints_on_earth(
                        $futsal[$this->convert($char[2])]->futsal->latitude,
                        $futsal[$this->convert($char[2])]->futsal->longitude,
                        $futsal[$this->convert($char[1])]->futsal->latitude,
                        $futsal[$this->convert($char[1])]->futsal->longitude
                    );
                    $temp3 = $this->twopoints_on_earth(
                        $futsal[$this->convert($char[1])]->futsal->latitude,
                        $futsal[$this->convert($char[1])]->futsal->longitude,
                        $futsal[$this->convert($char[3])]->futsal->latitude,
                        $futsal[$this->convert($char[3])]->futsal->longitude
                    );
                    $tempTotal = $temp1 + $temp2 + $temp3;
                } else if ($j == 2) {
                    $newStr = $char[0] . $char[1] . $char[3] . $char[2];
                    $temp1 = $this->twopoints_on_earth(
                        $futsal[$this->convert($char[0])]->futsal->latitude,
                        $futsal[$this->convert($char[0])]->futsal->longitude,
                        $futsal[$this->convert($char[1])]->futsal->latitude,
                        $futsal[$this->convert($char[1])]->futsal->longitude
                    );
                    $temp2 = $this->twopoints_on_earth(
                        $futsal[$this->convert($char[1])]->futsal->latitude,
                        $futsal[$this->convert($char[1])]->futsal->longitude,
                        $futsal[$this->convert($char[3])]->futsal->latitude,
                        $futsal[$this->convert($char[3])]->futsal->longitude
                    );
                    $temp3 = $this->twopoints_on_earth(
                        $futsal[$this->convert($char[3])]->futsal->latitude,
                        $futsal[$this->convert($char[3])]->futsal->longitude,
                        $futsal[$this->convert($char[2])]->futsal->latitude,
                        $futsal[$this->convert($char[2])]->futsal->longitude
                    );
                    $tempTotal = $temp1 + $temp2 + $temp3;
                } else if ($j == 3) {
                    $newStr = $char[3] . $char[1] . $char[2] . $char[0];
                    $temp1 = $this->twopoints_on_earth(
                        $futsal[$this->convert($char[3])]->futsal->latitude,
                        $futsal[$this->convert($char[3])]->futsal->longitude,
                        $futsal[$this->convert($char[1])]->futsal->latitude,
                        $futsal[$this->convert($char[1])]->futsal->longitude
                    );
                    $temp2 = $this->twopoints_on_earth(
                        $futsal[$this->convert($char[1])]->futsal->latitude,
                        $futsal[$this->convert($char[1])]->futsal->longitude,
                        $futsal[$this->convert($char[2])]->futsal->latitude,
                        $futsal[$this->convert($char[2])]->futsal->longitude
                    );
                    $temp3 = $this->twopoints_on_earth(
                        $futsal[$this->convert($char[2])]->futsal->latitude,
                        $futsal[$this->convert($char[2])]->futsal->longitude,
                        $futsal[$this->convert($char[0])]->futsal->latitude,
                        $futsal[$this->convert($char[0])]->futsal->longitude
                    );
                    $tempTotal = $temp1 + $temp2 + $temp3;
                } else if ($j == 4) {
                    $newStr = $char[0] . $char[3] . $char[2] . $char[1];
                    $temp1 = $this->twopoints_on_earth(
                        $futsal[$this->convert($char[0])]->futsal->latitude,
                        $futsal[$this->convert($char[0])]->futsal->longitude,
                        $futsal[$this->convert($char[3])]->futsal->latitude,
                        $futsal[$this->convert($char[3])]->futsal->longitude
                    );
                    $temp2 = $this->twopoints_on_earth(
                        $futsal[$this->convert($char[3])]->futsal->latitude,
                        $futsal[$this->convert($char[3])]->futsal->longitude,
                        $futsal[$this->convert($char[2])]->futsal->latitude,
                        $futsal[$this->convert($char[2])]->futsal->longitude
                    );
                    $temp3 = $this->twopoints_on_earth(
                        $futsal[$this->convert($char[2])]->futsal->latitude,
                        $futsal[$this->convert($char[2])]->futsal->longitude,
                        $futsal[$this->convert($char[1])]->futsal->latitude,
                        $futsal[$this->convert($char[1])]->futsal->longitude
                    );
                    $tempTotal = $temp1 + $temp2 + $temp3;
                } else if ($j == 5) {
                    $newStr = $char[2] . $char[1] . $char[0] . $char[3];
                    $temp1 = $this->twopoints_on_earth(
                        $futsal[$this->convert($char[2])]->futsal->latitude,
                        $futsal[$this->convert($char[2])]->futsal->longitude,
                        $futsal[$this->convert($char[1])]->futsal->latitude,
                        $futsal[$this->convert($char[1])]->futsal->longitude
                    );
                    $temp2 = $this->twopoints_on_earth(
                        $futsal[$this->convert($char[1])]->futsal->latitude,
                        $futsal[$this->convert($char[1])]->futsal->longitude,
                        $futsal[$this->convert($char[0])]->futsal->latitude,
                        $futsal[$this->convert($char[0])]->futsal->longitude
                    );
                    $temp3 = $this->twopoints_on_earth(
                        $futsal[$this->convert($char[0])]->futsal->latitude,
                        $futsal[$this->convert($char[0])]->futsal->longitude,
                        $futsal[$this->convert($char[3])]->futsal->latitude,
                        $futsal[$this->convert($char[3])]->futsal->longitude
                    );
                    $tempTotal = $temp1 + $temp2 + $temp3;
                }

                if ($tempTotal < $total) {
                    $total = $tempTotal;
                    $default = $newStr;
                    array_push($best, $newStr);
                    array_push($distance, $tempTotal);
                }

                array_push($master, $newStr);
            }
        }

        if (count($best) == 0) {
            array_push($best, 'ABCD');
            array_push($distance, $total);
        }

        $bestWay = $best[count($best) - 1];
        $bestDis = $distance[count($best) - 1];
        $char = str_split($bestWay);

        DB::table('rute_terbaik')->where([
            'user_id' => auth()->guard('user')->user()->id,
        ])->delete();
        DB::table('rute_terbaik')->insert([
            'user_id' => auth()->guard('user')->user()->id,
            'rute' => $char[0] . '-' . $char[1] . '-' . $char[2] . '-' . $char[3],
            'jarak' => $bestDis
        ]);

        return redirect()->route('user.hasil');
    }

    public function hasil(Request $request)
    {
        $bestRute = DB::table('rute_terbaik')->where('user_id', auth()->guard('user')->user()->id)->first();
        $loc = User::find(auth()->guard('user')->user()->id);
        $futsal = DB::table('lapangan_futsal')
            ->join('lokasi_user', 'lapangan_futsal.id', 'lokasi_user.lapangan_futsal_id')
            ->select('lapangan_futsal.latitude', 'lapangan_futsal.longitude', 'lapangan_futsal.nama', 'lapangan_futsal.id','lapangan_futsal.alamat')
            ->where('lokasi_user.user_id', auth()->guard('user')->user()->id)
            ->get();

        $i = 0;
        foreach($futsal as $f) {
            $gambar = DB::table('gambar_lapangan_futsal')->select('gambar')->where('lapangan_futsal_id', $f->id)->get();
            $futsal[$i]->gambar = $gambar;
            $i++;
        }

        return view('hasil', [
            'best' => $bestRute,
            'futsal' => $futsal,
            'location' => $loc
        ]);
    }

    public function detail($id)
    {
        $futsal = DB::table('lapangan_futsal')->where('id', $id)->first();
        $operasional = explode(PHP_EOL, $futsal->jam_operasional);
        $fasilitas = explode(PHP_EOL, $futsal->fasilitas);

        $i = 0;
        foreach($futsal as $f) {
            $gambar = DB::table('gambar_lapangan_futsal')->select('gambar')->where('lapangan_futsal_id', $id)->get();
            $futsal->gambar = $gambar;
            $i++;
        }

        return view('detail', [
            'futsal' => $futsal,
            'jam' => $operasional,
            'fasilitas' => $fasilitas
        ]);
    }

    public function twopoints_on_earth($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo)
    {
        $long1 = deg2rad($longitudeFrom);
        $long2 = deg2rad($longitudeTo);
        $lat1 = deg2rad($latitudeFrom);
        $lat2 = deg2rad($latitudeTo);

        $dlong = $long2 - $long1;
        $dlati = $lat2 - $lat1;

        $val = pow(sin($dlati/2),2) + cos($lat1) * cos($lat2) * pow(sin($dlong / 2), 2);
        $res = 2 * asin(sqrt($val));
        $radius = 3958.756;

        return ($res * $radius);
    }

    public function convert($char) {
        $index;

        switch($char) {
            case 'A' :
                $index = 0;
                break;
            case 'B' :
                $index = 1;
                break;
            case 'C' :
                $index = 2;
                break;
            case 'D' :
                $index = 3;
                break;
        }

        return $index;
    }
}

