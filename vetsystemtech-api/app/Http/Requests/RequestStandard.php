<?php

namespace App\Http\Requests;

use App\Http\Controllers\Required\Interfaces\VariableStandard;
use App\Messages\MessageUser;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RequestStandard extends FormRequest implements VariableStandard
{
    public function authorize()
    {
        return true; // Por padrão, permita que todos acessem esta solicitação
    }

    public function rules()
    {
        return [

        ];
    }

    public function messages()
    {
        return [

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
