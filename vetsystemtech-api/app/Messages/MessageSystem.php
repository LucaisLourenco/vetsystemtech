<?php

namespace App\Messages;

enum MessageSystem
{
    public const SYS001 = 'Ocorreu um erro ao processar sua solicitação. Por favor, tente novamente mais tarde.';
    public const SYS002 = 'O CPF informado é inválido.';
    public const SYS003 = 'O CPF informado já está cadastrado.';
}
