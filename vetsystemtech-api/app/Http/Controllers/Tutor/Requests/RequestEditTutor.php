<?php

namespace App\Http\Controllers\Tutor\Requests;

use App\Rules\CpfValidator;
use Illuminate\Validation\Rule;

class RequestEditTutor extends RequestCreateTutor
{
    public function rules(): array
    {
        $id = $this->input(self::ID);

        return [
            self::ID => 'required',
            self::CPF => [Rule::unique(self::TABLE_TUTOR)->ignore($id), new CpfValidator()]
        ];
    }
}
