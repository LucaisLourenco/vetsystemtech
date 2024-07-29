<?php

namespace App\Messages;

enum MessageVeterinarian
{
    public const VTR001 = 'Credenciais inválidas';
    public const VTR002 = 'Não foi possível criar o Token.';
    public const VTR003 = 'Não foi possível obter as informações do usuário.';
    public const VTR004 = 'Não foi possível realizar logoff.';
    public const VTR005 = 'Veterinário desconectado com sucesso.';
}
