<?php

namespace App\Messages;

enum MessageUser
{
    public const USR001 = 'Credenciais inválidas';
    public const USR002 = 'Não foi possível criar o Token.';
    public const USR003 = 'Não foi possível obter as informações do usuário.';
    public const USR004 = 'Não foi possível realizar logoff.';
    public const USR005 = 'Usuário desconectado com sucesso';
    public const USR006 = 'O campo username é obrigatório.';
    public const USR007 = 'O campo password é obrigatório.';
    public const USR008 = 'Não autorizado para não usuários.';
    public const USR009 = 'Não autorizado para não usuários.';
}
