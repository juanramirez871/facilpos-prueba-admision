<?php

namespace App\Http\Controllers;
use App\Helpers\RequestsHttp;
use App\Http\Requests\UpdateMovieRequest;
use App\Models\Gender;
use App\Models\Movie;
use App\Models\Movie_gender;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function createMovies(){
        DB::beginTransaction();
        try{
            $moviesBillboard = (RequestsHttp::get("https://api.themoviedb.org/3/movie/now_playing?language=es&page=1"))["results"];
            $idMovies = array_map(fn($movie) => $movie["id"], $moviesBillboard);
            $movies = [];

            foreach ($idMovies as $idMovie) {
                $dataMovie = RequestsHttp::get("https://api.themoviedb.org/3/movie/$idMovie?language=es");
                $genders = Gender::createGendersUnique($dataMovie["genres"]);
                $movieModel = Movie::createMovie($dataMovie);
                Movie_gender::createMovieGender($genders, $movieModel["id"]);
                $movieModel["genres"] = $genders;
                array_push($movies, $movieModel);
            }
            DB::commit();
            return redirect()->back()->with('success', 'Peliculas creadas correctamente');
        }
        catch(\Exception $e){
            DB::rollback();
            return $this -> errorResponse($e->getMessage(), 400);
        }
    }

    public function deleteMovies(){
        try{
            DB::beginTransaction();
            Movie_gender::truncate();
            Movie::truncate();
            DB::commit();
            return redirect()->back()->with('success', 'Peliculas eliminadas correctamente');
        }
        catch(\Exception $e){
            DB::rollback();
           return $this -> errorResponse($e->getMessage(), 400);
        }
    }

    public function deleteMovie(Movie $movie){
        try{
            DB::beginTransaction();
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
            $movies = Movie::with('genders') -> get() -> toArray();
            return view('movies', ['movies' => $movies]);
        }
        catch(\Exception $e){
           return $this -> errorResponse($e->getMessage(), 400);
        }
    }

    public function putMovie(UpdateMovieRequest $request, Movie $movie){
        try{
            $movie -> fill($request -> toArray());
            $movie -> save();
            return $this -> susccesResponse($movie -> toArray(), 200);
        }
        catch(\Exception $e){
           return $this -> errorResponse($e->getMessage(), 400);
        }
    }
}
