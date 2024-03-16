<?php

namespace App\Http\Requests;

use App\Http\Controllers\Auth\User\Interface\VariableAuthUser;
use App\Messages\MessageUser;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class LoginRequest extends FormRequest implements VariableAuthUser
{
    public function authorize()
    {
        return true; // Por padrão, permita que todos acessem esta solicitação
    }

    public function rules()
    {
        return [
            self::USERNAME => 'required',
            self::PASSWORD => 'required',
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
