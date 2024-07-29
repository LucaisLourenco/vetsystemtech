<?php

namespace App\Rules;

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

        if (!$this->isValidCpf($cpf)) {
            $fail(MessageSystem::SYS002);
        }
    }

    /**
     * @param string $cpf
     * @return bool
     */
    private function isValidCpf(string $cpf): bool
    {
        if (strlen($cpf) !== 11 || preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        return $this->calculateChecksum($cpf) === substr($cpf, 9);
    }

    /**
     * @param string $cpf
     * @return string
     */
    private function calculateChecksum(string $cpf): string
    {
        $firstDigit = $this->calculateDigit($cpf, 10);
        $secondDigit = $this->calculateDigit($cpf, 11, $firstDigit);
        return $firstDigit . $secondDigit;
    }

    /**
     * @param string $cpf
     * @param int $weight
     * @param int|null $firstDigit
     * @return int
     */
    private function calculateDigit(string $cpf, int $weight, int $firstDigit = null): int
    {
        $sum = 0;
        $length = $firstDigit === null ? 9 : 10;

        for ($i = 0; $i < $length; $i++) {
            $sum += $weight * (int)$cpf[$i];
            $weight--;
        }

        if ($firstDigit !== null) {
            $sum += 2 * $firstDigit;
        }

        $remainder = $sum % 11;
        return $remainder < 2 ? 0 : 11 - $remainder;
    }
}
