<?php

namespace App\Http\Controllers\Tutor\Requests;

use App\Http\Controllers\Auth\Tutor\Interface\VariableTutor;
use App\Messages\MessageTutor;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RequestCreateTutor extends FormRequest implements VariableTutor
{
    public function authorize(): bool
    {
        return true; // Por padrão, permita que todos acessem esta solicitação
    }

    public function rules(): array
    {
        return [
            self::NAME => 'required',
            self::USERNAME => 'required|unique:' . self::TABLE_TUTOR,
            self::PASSWORD => 'required',
            self::CPF => 'required|unique:' . self::TABLE_TUTOR . 'cpf',
            self::EMAIL => 'required|unique:' . self::TABLE_TUTOR,
        ];
    }

    public function messages(): array
    {
        return [
            self::NAME . '.required' => MessageTutor::CLT006,
            self::USERNAME . '.required' => MessageTutor::CLT007,
            self::PASSWORD . '.required' => MessageTutor::CLT008,
            self::CPF . '.required' => MessageTutor::CLT009,
            self::EMAIL . '.required' => MessageTutor::CLT010,
            self::USERNAME . '.unique' => MessageTutor::CLT011,
            self::CPF . '.unique' => MessageTutor::CLT012,
            self::EMAIL . '.unique' => MessageTutor::CLT013,
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
