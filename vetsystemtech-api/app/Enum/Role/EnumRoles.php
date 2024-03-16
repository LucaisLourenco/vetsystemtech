<?php

namespace App\Enum\Role;

use App\Enum\System\EnumGeneralLabel;
use App\Models\Gender\Gender;
use App\Models\Role\Role;

enum EnumRoles
{
    private const ID = 'id';
    private const NAME = 'name';

    public const ADMINISTRADOR = 1;
    public const USUARIO = 2;

    public static function  getArray(): array
    {
        $genders = [];

        $genders[self::ADMINISTRADOR] = (new Role())->fill([self::ID => self::ADMINISTRADOR, self::NAME => EnumGeneralLabel::ADMINISTRADOR]);
        $genders[self::USUARIO] = (new Role())->fill([self::ID => self::USUARIO, self::NAME => EnumGeneralLabel::USUARIO]);

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
