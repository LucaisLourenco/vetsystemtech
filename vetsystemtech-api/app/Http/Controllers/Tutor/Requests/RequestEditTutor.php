<?php

namespace App\Http\Controllers\Tutor\Requests;

use App\Rules\CpfValidator;

class RequestEditTutor extends RequestDeleteTutor
{
    public function rules(): array
    {
        return [
            self::ID => 'required',
            self::CPF => ['unique:' . self::TABLE_TUTOR, new CpfValidator()],
        ];
    }
}
