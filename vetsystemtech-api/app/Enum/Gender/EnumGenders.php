<?php

namespace App\Enum\Gender;

use App\Enum\System\EnumGeneralLabel;
use App\Models\Gender\Gender;

enum EnumGenders
{
    const MASCULINO = 1;
    const FEMININO = 2;
    const OUTROS = 3;

    public static function  getArray(): array
    {
        $genders = [];

        $genders[self::MASCULINO] = (new Gender())->fill([Gender::$id => self::MASCULINO, Gender::$name => EnumGeneralLabel::MASCULINO]);
        $genders[self::FEMININO] = (new Gender())->fill([Gender::$id => self::FEMININO, Gender::$name => EnumGeneralLabel::FEMININO]);
        $genders[self::OUTROS] = (new Gender())->fill([Gender::$id => self::OUTROS, Gender::$name => EnumGeneralLabel::OUTROS]);

        return $genders;
    }

    public static function getObject(int $idStatus)
    {
        if (array_key_exists($idStatus, ($genders = static::getArray())))
        {
            return $genders[$idStatus];
        }

        return null;
    }
}
