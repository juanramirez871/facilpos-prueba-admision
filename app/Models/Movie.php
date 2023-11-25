<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $fillable = ['name', "lenguage", "title", "summary", "poster"];
    public $timestamps = false;
    public static function createMovie(array $moviesData){
        $movieModel = self::create([
            "name" => $moviesData["title"],
            "lenguage" => $moviesData["original_language"],
            "title" => $moviesData["original_title"],
            "summary" => $moviesData["overview"],
            "poster" => $moviesData["poster_path"]
        ]);

        return $movieModel -> toArray();
    }
}
