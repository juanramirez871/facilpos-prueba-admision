<?php

use App\Http\Controllers\MoviesController;
use Illuminate\Support\Facades\Route;

Route::prefix('movies') -> controller(MoviesController::class) -> group(function () {
    Route::post("/", "createMovies");
    Route::delete("/", "deleteMovies");
    Route::delete("/{movie}", "deleteMovie");
    Route::get("/", "getMovies");
    Route::put("/{movie}", "putMovie");
});
