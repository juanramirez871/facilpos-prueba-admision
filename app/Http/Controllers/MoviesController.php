<?php

namespace App\Http\Controllers;
use App\Helpers\RequestsHttp;
use App\Http\Requests\UpdateMovieRequest;
use App\Models\Gender;
use App\Models\Movie;
use App\Models\Movie_gender;
use Illuminate\Support\Facades\DB;

class MoviesController extends Controller
{
    public function createMovies(){
        DB::beginTransaction();
        try{
            // llama de las peliculas en cartelera
            $moviesBillboard = (RequestsHttp::get("https://api.themoviedb.org/3/movie/now_playing?language=es&page=1"))["results"];

            // recorre las peliculas traidas y obtiene sus id
            $idMovies = array_map(fn($movie) => $movie["id"], $moviesBillboard);

            // se recorre los ids encontrados para hacer la logica de guardar los datos
            foreach ($idMovies as $idMovie) {

                // se llama la información de la pelicula encontrada en carterela
                $dataMovie = RequestsHttp::get("https://api.themoviedb.org/3/movie/$idMovie?language=es");

                // crea los generos necesarios para la pelicula encontrada y devuelve sus nombres y id
                $genders = Gender::createGendersUnique($dataMovie["genres"]);

                // se crea el modelo de la pelicula y guarda la pelicula en la base de datos
                $movieModel = Movie::createMovie($dataMovie);

                // guardar el id de la pelicula y de los generos para poder relacionar los datos
                Movie_gender::createMovieGender($genders, $movieModel["id"]);

                // se agregan los generos con la informacion actualizada
                $movieModel["genres"] = $genders;
            }

            // termina la transacion
            DB::commit();
            return redirect()->back()->with('success', 'Peliculas creadas correctamente');
        }
        catch(\Exception $e){
            // en caso de fallar la peticion regrese todos los cambios de la base de datos que se alcanzaron hacer
            DB::rollback();
            return $this -> errorResponse($e->getMessage(), 400);
        }
    }

    public function deleteMovies(){
        try{
            // se maneja un transacion para evitar dejar datos huerfanos
            DB::beginTransaction();

            // se eliminan las peliculas de la base de datos y sus generos relacionados
            Movie_gender::truncate();
            Movie::truncate();
            DB::commit();
            return redirect()->back()->with('success', 'Peliculas eliminadas correctamente');
        }
        catch(\Exception $e){
            // en caso de fallar la peticion regrese todos los cambios de la base de datos que se alcanzaron hacer
            DB::rollback();
           return $this -> errorResponse($e->getMessage(), 400);
        }
    }

    public function deleteMovie(Movie $movie){
        try{
            DB::beginTransaction();
            // se elimina la pelicula especificada en el parametro de la ruta
            $movie -> delete();
            DB::commit();
            return redirect()->back()->with('success', 'Pelicula eliminadas correctamente');
        }
        catch(\Exception $e){
            DB::rollback();
           return $this -> errorResponse($e->getMessage(), 400);
        }
    }
    public function getMovies(){
        try{
            // se trae las peliculas con los generos relacionados
            $movies = Movie::with('genders') -> get() -> toArray();
            return view('movies', ['movies' => $movies]);
        }
        catch(\Exception $e){
           return $this -> errorResponse($e->getMessage(), 400);
        }
    }

    public function putMovie(UpdateMovieRequest $request, Movie $movie){
        try{
            // llena el modelos especificados en la ruta y actualiza los nuevos datos y los guarda
            $movie -> fill($request -> toArray());
            $movie -> save();
            return $this -> susccesResponse($movie -> toArray(), 200);
        }
        catch(\Exception $e){
           return $this -> errorResponse($e->getMessage(), 400);
        }
    }
}
