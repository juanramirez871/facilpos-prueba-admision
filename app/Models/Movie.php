<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    // se especifica los campos necesarios para este modelo
    protected $fillable = ['name', "lenguage", "title", "summary", "poster"];
    // se le especifica que no quiero timestamp
    public $timestamps = false;

    /**
         * se crea una pelicula
         *
         * @param  array  $moviesData   un array con la informacion de las peliculas a guardar.
         *
         * @return array $movieModel    la pelicula creada
    */
    public static function createMovie(array $moviesData): array {
        $movieModel = self::create([
            "name" => $moviesData["title"],
            "lenguage" => $moviesData["original_language"],
            "title" => $moviesData["original_title"],
            "summary" => $moviesData["overview"],
            "poster" => $moviesData["poster_path"]
        ]);

        return $movieModel -> toArray();
    }

    public function genders()
    {
        // movies se trae todos sus generos relacionados atravez de la tabla intermedia
        return $this->belongsToMany(Gender::class, 'movies_genders');
    }
}
