<?php

namespace App\Rules;

use App\Enum\Utils\EnumQueryOperators;
use App\Messages\MessageSystem;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;
use Illuminate\Translation\PotentiallyTranslatedString;

class UniqueCpf implements ValidationRule
{
    protected string $table;
    protected string $column;
    protected ?int $ignoreId;


    public function __construct($table, $column = 'cpf', $ignoreId = null)
    {
        $this->table = $table;
        $this->column = $column;
        $this->ignoreId = $ignoreId;
    }

    /**
     * Run the validation rule.
     *
     * @param \Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $value = preg_replace('/[^0-9]/', '', $value);
        $query = DB::table($this->table)->where($this->column, $value);

        if ($this->ignoreId) {
            $query->where('id', EnumQueryOperators::NOT_EQUAL, $this->ignoreId);
        }

        if ($query->exists()) {
            $fail(MessageSystem::SYS003);
        }
    }
}
