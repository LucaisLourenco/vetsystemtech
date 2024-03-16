<?php

namespace App\Http\Controllers\Auth\User\Interface;

use App\Http\Controllers\Obrigatorio\Interface\VariableRequired;

interface VariableAuthUser extends VariableRequired
{
    const PASSWORD = 'password';
    const USERNAME = 'username';
    const ERROR = 'error';
    const TOKEN = 'token';
    const MESSAGE = 'message';
    const API = 'api';
}
