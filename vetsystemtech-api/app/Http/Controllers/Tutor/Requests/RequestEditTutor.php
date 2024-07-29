<?php

namespace App\Http\Controllers\Tutor\Requests;

use App\Messages\MessageTutor;
use App\Rules\CpfValidator;
use App\Rules\UniqueCpf;

class RequestEditTutor extends RequestDeleteTutor
{
    public function rules(): array
    {
        $id = $this->route(self::ID);

        return [
            self::ID => 'required',
            self::CPF => [new UniqueCpf(self::TABLE_TUTOR, self::CPF, $id), new CpfValidator()]
        ];
    }

    public function messages(): array
    {
        return [
            self::CPF . '.unique' => MessageTutor::CLT012,
        ];
    }
}
