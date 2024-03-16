<?php

namespace App\Enum\System;

use App\Models\ClassePadrao\ClassePadrao;

class EnumGeneralStatus
{
    const ATIVADO = 1;
    const DESATIVADO = 2;

    public static function  getArray(): array
    {
        $status = [];

        $status[self::ATIVADO] = (new ClassePadrao())
            ->setId(self::ATIVADO)
            ->setDescricao(EnumGeneralLabel::ATIVADO);

        $status[self::DESATIVADO] = (new ClassePadrao())
            ->setId(self::DESATIVADO)
            ->setDescricao(EnumGeneralLabel::DESATIVADO);

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
