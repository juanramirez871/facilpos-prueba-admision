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
        $gendersId = [];
        foreach ($gendersData as $gender) {
            $genderModel = self::firstOrNew(['name' => $gender['name']]);
            $genderModel->fill($gender);
            $genderModel->save();
            array_push($gendersId, $genderModel -> id);
        }
        return $gendersId;
    }
}
