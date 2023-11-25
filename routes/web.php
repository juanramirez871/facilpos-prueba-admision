<?php
use App\Http\Controllers\MoviesController;
use Illuminate\Support\Facades\Route;

// se agrega la ruta principal que redirige a la ruta /movies
Route::get('/', fn() => redirect("movies"));

// se agrega prefijo movies a todas las rutas dentro de el y tambien se le agrupa el mismo controllador
Route::prefix('movies') -> controller(MoviesController::class) -> group(function () {

    // getMovies, trae todas las rutas que encuentre en la base de datos
    Route::get("/", "getMovies") -> name("movies.get");

    // createMovies, crea todas las peliculas en la base de datos de postgres. en la cartelera que encuentre en este enpoint externo: https://api.themoviedb.org/3/movie/now_playing?language=es&page=1
    Route::post("/", "createMovies") -> name("movies.post");

    // deleteMovies, elimina todas las peliculas en la base de datos de postgres
    Route::delete("/", "deleteMovies") -> name("movies.delete");

    // deleteMovie, elimina solo la pelicula especificada por el parametro
    Route::delete("/{movie}", "deleteMovie") -> name("movie.delete");

    // putMovie, actualiza los datos de la pelicula especificada por el parametro
    Route::put("/{movie}", "putMovie") -> name("movie.put");
});
