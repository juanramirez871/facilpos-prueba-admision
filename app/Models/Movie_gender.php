<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie_gender extends Model
{
    use HasFactory;
    protected $table ='movies_genders';
    protected $fillable = ['movie_id', "gender_id"];
    public $timestamps = false;

    public static function createMovieGender(array $genders, int $idMovie){
        foreach ($genders as $gender) {
            $gendersMovies = self::firstOrNew(['gender_id' => $gender["id"], "movie_id" => $idMovie]);
            $gendersMovies->fill(['movie_id' => $idMovie, 'gender_id' => $gender["id"]]);
            $gendersMovies->save();
        }
    }
}
