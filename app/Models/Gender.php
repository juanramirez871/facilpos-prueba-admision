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

    /**
         * crea los generos enviados y devuelve sus id, si existe ya el registro continua, si no, lo crea
         *
         * @param  array  $genderData   un array con la informacion de los generos.
         *
         * @return array $genders devuelve los generos con la informacion segun la db
    */
    public static function createGendersUnique(array $gendersData): array
{
    $genders = [];

    foreach ($gendersData as $gender) {
        $genderModel = self::firstOrNew(['name' => $gender['name']]);
        if ($genderModel->exists) {
            $genders[] = $genderModel->only(['id', 'name']);
            continue;
        }
        $genderModel->fill($gender);
        $genderModel->save();
        $genders[] = $genderModel->only(['id', 'name']);
    }
    return $genders;
}
}
