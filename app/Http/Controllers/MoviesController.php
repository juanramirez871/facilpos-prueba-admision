<?php

namespace App\Http\Controllers;
use App\Helpers\RequestsHttp;
use App\Models\Gender;
use App\Models\Movie;
use App\Models\Movie_gender;
use Illuminate\Support\Facades\DB;

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
            return $this -> susccesResponse($movies, 200);
        }
        catch(\Exception $e){
            DB::rollback();
            return $this -> errorResponse($e->getMessage(), 400);
        }
    }

    public function deleteMovies(){
        DB::beginTransaction();
        try{

            DB::commit();
        }
        catch(\Exception $e){
            DB::rollback();
           return $this -> errorResponse($e->getMessage(), 400);
        }
    }
}
