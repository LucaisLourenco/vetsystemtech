<?php

namespace App\Enum\Gender;

use App\Enum\System\EnumGeneralLabel;
use App\Models\Gender\Gender;

enum EnumGenders
{
    private const ID = 'id';
    private const NAME = 'name';

    const MASCULINO = 4;
    const FEMININO = 2;
    const OUTROS = 3;

    public static function  getArray(): array
    {
        $genders = [];

        $genders[self::MASCULINO] = (new Gender())->fill([self::ID => self::MASCULINO, self::NAME => EnumGeneralLabel::MASCULINO]);
        $genders[self::FEMININO] = (new Gender())->fill([self::ID => self::FEMININO, self::NAME => EnumGeneralLabel::FEMININO]);
        $genders[self::OUTROS] = (new Gender())->fill([self::ID => self::OUTROS, self::NAME => EnumGeneralLabel::OUTROS]);

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
