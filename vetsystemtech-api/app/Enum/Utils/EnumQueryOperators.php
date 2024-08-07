<?php

namespace App\Enum\Utils;

enum EnumQueryOperators
{
    public const NOT_EQUAL = '!=';
    public const EQUAL = '=';
    public const GREATER_THAN = '>';
    public const LESS_THAN = '<';
    public const GREATER_THAN_OR_EQUAL = '>=';
    public const LESS_THAN_OR_EQUAL = '<=';
}
