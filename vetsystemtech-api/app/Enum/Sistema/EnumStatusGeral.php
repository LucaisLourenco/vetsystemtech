<?php

namespace App\Enum\Sistema;

use App\Models\ClassePadrao\ClassePadrao;

class EnumStatusGeral
{
    const ATIVADO = 1;
    const DESATIVADO = 2;

    public static function  getArray(): array
    {
        $status = [];

        $status[self::ATIVADO] = (new ClassePadrao())
            ->setId(self::ATIVADO)
            ->setDescricao('Ativado');

        $status[self::DESATIVADO] = (new ClassePadrao())
            ->setId(self::DESATIVADO)
            ->setDescricao('Desativado');

        return $status;
    }

    public static function getObject(int $idStatus)
    {
        if (array_key_exists($idStatus, ($status = static::getArray())))
        {
            return $status[$idStatus];
        }

        return null;
    }
}
