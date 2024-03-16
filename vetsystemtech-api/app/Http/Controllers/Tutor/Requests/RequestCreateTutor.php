<?php

namespace App\Http\Controllers\Tutor\Requests;

use App\Http\Controllers\Auth\Tutor\Interface\VariableTutor;
use App\Messages\MessageTutor;
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
        ];
    }

    public function messages()
    {
        return [
            self::NAME.'.required' => MessageTutor::CLT006,
            self::USERNAME.'.required' => MessageTutor::CLT007,
            self::PASSWORD.'.required' => MessageTutor::CLT008,
            self::CPF.'.required' => MessageTutor::CLT009,
            self::EMAIL.'.required' => MessageTutor::CLT010,
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
