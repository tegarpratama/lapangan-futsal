<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class MapController extends Controller
{
    public function index()
    {
        $client = new Client();
        $data = $client->get('https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=-6.346054%2C106.691656&radius=1500&keyword=futsal&key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k');
        $result = json_decode($data->getBody());

        return response()->json([
            'status' => 'success',
            'data' => $result
        ], 200);
    }
}
