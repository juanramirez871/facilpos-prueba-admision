<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    public $timestamps = false;

    public static function createGendersUnique(array $gendersData){
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
