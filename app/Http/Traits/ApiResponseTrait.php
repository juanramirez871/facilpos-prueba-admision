<?php

namespace App\Http\Traits;
use Illuminate\Http\JsonResponse;

trait ApiResponseTrait {
    public function errorResponse(string $errorMessage, int $code, string $title = null): JsonResponse
    {
        if($title) return response()->json(['error' => $errorMessage, 'title' => $title], $code);
        else return response()->json(['error' => $errorMessage], $code);
    }

    public function susccesResponse(array $data = [], $code = Response::HTTP_OK): JsonResponse
    {
        return response()->json($data, $code);
    }
}
