<?php

namespace App\Rules;

use App\Helpers\DocumentsValidate;
use App\Messages\MessageSystem;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CpfValidator implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param \Closure(string): void $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $cpf = preg_replace('/\D/', '', $value);

        if (!DocumentsValidate::isValidCpf($cpf)) {
            $fail(MessageSystem::SYS002);
        }
    }
}
