<?php

namespace App\Http\Traits;
use Illuminate\Http\JsonResponse;

trait ApiResponseTrait {

    public function errorResponse(string $errorMessage, int $code, string $title = null): JsonResponse
    {
        // metodo que simplifica el envio de un error
        if($title) return response()->json(['error' => $errorMessage, 'title' => $title], $code);
        else return response()->json(['error' => $errorMessage], $code);
    }
}
