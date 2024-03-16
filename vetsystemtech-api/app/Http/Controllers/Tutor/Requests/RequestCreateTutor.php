<?php

namespace App\Http\Controllers\Tutor\Requests;

use App\Http\Controllers\Auth\Tutor\Interface\VariableTutor;
use App\Messages\MessageUser;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RequestCreateTutor extends FormRequest implements VariableTutor
{
    public function authorize()
    {
        return true; // Por padrão, permita que todos acessem esta solicitação
    }

    public function rules()
    {
        return [
            self::NAME => 'required',
            self::USERNAME => 'required',
            self::PASSWORD => 'required',
            self::CPF => 'required',
            self::EMAIL => 'required',
            self::ID_ROLE => 'required',
            self::ID_GENDER => 'required',
        ];
    }

    public function messages()
    {
        return [
            self::USERNAME.'.required' => MessageUser::USR006,
            self::PASSWORD.'.required' => MessageUser::USR007,
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
