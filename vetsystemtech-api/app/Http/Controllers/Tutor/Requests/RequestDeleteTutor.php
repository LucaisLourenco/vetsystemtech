<?php

namespace App\Http\Controllers\Tutor\Requests;

use App\Http\Controllers\Auth\Tutor\Interface\VariableTutor;
use App\Messages\MessageTutor;
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
            self::USERNAME => 'required_without_all:'.self::CPF.','.self::EMAIL,
            self::CPF => 'required_without_all:'.self::USERNAME.','.self::EMAIL,
            self::EMAIL => 'required_without_all:'.self::USERNAME.','.self::CPF,
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
            self::USERNAME.'.unique' => MessageTutor::CLT011,
            self::CPF.'.unique' => MessageTutor::CLT012,
            self::EMAIL.'.unique' => MessageTutor::CLT013,
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
