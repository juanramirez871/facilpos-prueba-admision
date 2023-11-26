<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Http;

class RequestsHttp {

    /**
         * metodo que simplifica la llamada de los get del enpoint de themoviedb
         *
         * @param  string  $url   la url a consumir.
         * @param  array  $headers array que contiene cabeceras adicionales.
         *
         * @return mixed un json con la informacion del error o la data ya parseada
    */
    public static function get(string $url, array $headers = array()): mixed {
        if(!$headers) $headers = [
            'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI2MjBlMGZmYTdhNDBhN2RjMzFkOGEyYmUwZDE4YzViOSIsInN1YiI6IjYzMWJhYzE0MGYxZTU4MDA5MmRjYzg2ZSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.j6Q4_2RgJ_1bpeIxo4WWAq4XDPG1Owz9fbABy0RP0Do',
            'accept' => 'application/json'
        ];
        $apiUrl = $url;
        $response = Http::withHeaders($headers)->get($apiUrl);
        if ($response->successful()) return $response->json();
        else return response()->json(['error' => $response -> json(), 'title' => "Error in url $url with GET method"], 400);
    }
}
