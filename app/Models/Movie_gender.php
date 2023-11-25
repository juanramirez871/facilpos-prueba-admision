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

    public static function createMovieGender(array $gendersId, int $idMovies){
        foreach ($gendersId as $genderId) {
            $gendersMovies = self::firstOrNew(['gender_id' => $genderId, "movie_id" => $idMovies]);
            $gendersMovies->fill(['movie_id' => $idMovies, 'gender_id' => $genderId]);
            $gendersMovies->save();
        }
    }
}
