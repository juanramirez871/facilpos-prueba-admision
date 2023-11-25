<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;
    // se especifica los campos necesarios para el modelo
    protected $fillable = ['name'];
    // se le especifica que no quiero timestamp
    public $timestamps = false;

    public static function createGendersUnique(array $gendersData){

        // crea los generos enviados y devuelve sus id, si existe ya el registro continua, si no lo crea
        $genders = [];
        foreach ($gendersData as $gender) {
            $genderModel = self::firstOrNew(['name' => $gender['name']]);
            if(isset($genderModel->id)){
                array_push($genders, ["id" => $genderModel -> id, "name" => $genderModel -> name]);
                continue;
            };
            $genderModel->fill($gender);
            $genderModel->save();
            array_push($genders, ["id" => $genderModel -> id, "name" => $genderModel -> name]);
        }
        return $genders;
    }
}
