<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Http;

class RequestsHttp {
    public static function get(string $url, $headers = array()): array {
        if(!$headers) $headers = [
            'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI2MjBlMGZmYTdhNDBhN2RjMzFkOGEyYmUwZDE4YzViOSIsInN1YiI6IjYzMWJhYzE0MGYxZTU4MDA5MmRjYzg2ZSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.j6Q4_2RgJ_1bpeIxo4WWAq4XDPG1Owz9fbABy0RP0Do',
            'accept' => 'application/json'
        ];
        $apiUrl = $url;
        $response = Http::withHeaders($headers)->get($apiUrl);
        if ($response->successful()) return $response->json();
        else return ["title" => "Error in url $url with GET method", "message" => $response -> json()];
    }
}
