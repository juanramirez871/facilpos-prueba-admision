<?php

namespace App\Http\Controllers;
use App\Helpers\RequestsHttp;
use App\Models\Gender;
use App\Models\Movie;
use App\Models\Movie_gender;
use Illuminate\Support\Facades\DB;

class MoviesController extends Controller
{
    public function createMovie(){
        DB::beginTransaction();
        try{
            $dataMovie = RequestsHttp::get("https://api.themoviedb.org/3/movie/2?language=s");
            $gendersId = Gender::createGendersUnique($dataMovie["genres"]);
            $movieModel = Movie::createMovie($dataMovie);
            Movie_gender::createMovieGender($gendersId, $movieModel["id"]);
            DB::commit();
            return $this -> susccesResponse($movieModel, 200);
        }
        catch(\Exception $e){
            DB::rollback();
           return $this -> errorResponse($e->getMessage(), 400);
        }
    }

    public function deleteMovie(){
        DB::beginTransaction();
        try{

        }
        catch(\Exception $e){
            DB::rollback();
           return $this -> errorResponse($e->getMessage(), 400);
        }
    }
}
