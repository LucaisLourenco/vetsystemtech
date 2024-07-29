<?php

namespace App\Messages;

enum MessageTutor
{
    public const CLT001 = 'Credenciais inválidas';
    public const CLT002 = 'Não foi possível criar o Token.';
    public const CLT003 = 'Não foi possível obter as informações do usuário.';
    public const CLT004 = 'Não foi possível realizar logoff.';
    public const CLT005 = 'Cliente desconectado com sucesso.';
    public const CLT006 = 'O campo NAME é obrigatório.';
    public const CLT007 = 'O campo USERNAME é obrigatório.';
    public const CLT008 = 'O campo PASSWORD é obrigatório.';
    public const CLT009 = 'O campo CPF é obrigatório.';
    public const CLT010 = 'O campo EMAIL é obrigatório.';
    public const CLT011 = 'Já existe cliente cadastrado para o USERNAME informado.';
    public const CLT012 = 'Já existe cliente cadastrado para o CFP informado.';
    public const CLT013 = 'Já existe cliente cadastrado para o E-MAIL informado.';
    public const CLT014 = 'Cliente cadastrado com sucesso.';
    public const CLT015 = 'Cliente não encontrado na base de dados do sistema.';
    public const CLT016 = 'Cliente excluído com sucesso.';
    public const CLT017 = 'Cliente atualizado com sucesso.';
}
