<?php

namespace App\Http\Controllers\Tutor\Requests;

use App\Http\Controllers\Auth\Tutor\Interface\VariableTutor;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RequestDeleteTutor extends FormRequest implements VariableTutor
{
    public function authorize()
    {
        return true; // Por padrão, permita que todos acessem esta solicitação
    }

    public function rules()
    {
        return [
            self::CPF => 'required',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            self::ERRORS => $validator->errors()
        ], 422);

        throw new HttpResponseException($response);
    }

}
