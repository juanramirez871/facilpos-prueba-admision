<?php
use App\Http\Controllers\MoviesController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect("movies"));
Route::prefix('movies') -> controller(MoviesController::class) -> group(function () {
    Route::get("/", "getMovies") -> name("movies.get");
    Route::post("/", "createMovies") -> name("movies.post");
    Route::delete("/", "deleteMovies") -> name("movies.delete");
    Route::delete("/{movie}", "deleteMovie") -> name("movie.delete");
    Route::put("/{movie}", "putMovie") -> name("movie.put");
});
