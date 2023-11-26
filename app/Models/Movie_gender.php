<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie_gender extends Model
{
    use HasFactory;
    protected $table ='movies_genders';
    // se especifica los campos necesarios para este modelo
    protected $fillable = ['movie_id', "gender_id"];
    // se le especifica que no quiero timestamp
    public $timestamps = false;

     /**
         * recorre cada genero enviado y verifica en la base de datos si existe continue, si no que lo cree con su pelicula correspondiente
         *
         * @param  array  $genders   un array con la informacion de los generos.
         *
         * @return int $idMovie el id de la pelica relacionada a los generos
    */
    public static function createMovieGender(array $genders, int $idMovie): void {
        foreach ($genders as $gender) {
            $gendersMovies = self::firstOrNew(['gender_id' => $gender["id"], "movie_id" => $idMovie]);
            if($gendersMovies -> exists) continue;
            $gendersMovies->fill(['movie_id' => $idMovie, 'gender_id' => $gender["id"]]);
            $gendersMovies->save();
        }
    }
}
