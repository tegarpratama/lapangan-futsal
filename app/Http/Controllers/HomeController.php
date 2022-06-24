<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\User;
use App\LapanganFutsal;
use App\LokasiUser;

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
                if ($i == 3) {
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
                        'lapangan_futsal_id' => $futsalId,
                        'jarak' => $this->twopoints_on_earth(
                            $loc->latitude, $loc->longitude, $r->geometry->location->lat, $r->geometry->location->lng
                        )
                    ]);

                    $dataLoc[$i] = [
                        'lat' => $r->geometry->location->lat,
                        'lng' => $r->geometry->location->lng
                    ];
                } else {
                    LokasiUser::create([
                        'user_id' => auth()->guard('user')->user()->id,
                        'lapangan_futsal_id' => $futsal->id,
                        'jarak' => $this->twopoints_on_earth(
                            $loc->latitude, $loc->longitude, $futsal->latitude, $futsal->longitude
                        )
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

    public function twopoints_on_earth($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo)
    {
        $long1 = deg2rad($longitudeFrom);
        $long2 = deg2rad($longitudeTo);
        $lat1 = deg2rad($latitudeFrom);
        $lat2 = deg2rad($latitudeTo);

        //Haversine Formula
        $dlong = $long2 - $long1;
        $dlati = $lat2 - $lat1;

        $val = pow(sin($dlati/2),2) + cos($lat1) * cos($lat2) * pow(sin($dlong / 2), 2);

        $res = 2 * asin(sqrt($val));

        $radius = 3958.756;

        return ($res * $radius);
    }
}

