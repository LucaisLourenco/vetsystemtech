<?php

namespace App\Http\Controllers\Tutor\Requests;

class RequestEditTutor extends RequestDeleteTutor
{
    public function rules(): array
    {
        return [
            self::ID => 'required',
            self::CPF => 'cpf',
        ];
    }
}
