<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateMovieRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // se le dice las reglas obligatorias que necesita el request
        return [
            "name" => "required|string",
            "lenguage" => "required|string",
            "title" => "required|string",
            "summary" => "required|string",
            "poster" => "required|string",
        ];
    }

    protected function failedValidation(validator $validator)
    {
        // en caso de error en la validacion del request, enviar este mensaje
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 400));
    }
}
