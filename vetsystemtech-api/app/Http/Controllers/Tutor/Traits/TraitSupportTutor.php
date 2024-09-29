<?php

namespace App\Http\Controllers\Tutor\Traits;

use App\Enum\Role\EnumRoles;
use App\Enum\System\EnumGeneralStatus;
use App\Http\Controllers\Tutor\Requests\RequestCreateTutor;
use App\Models\Tutor\Tutor;

trait TraitSupportTutor
{
    protected function createTutorByRequest(RequestCreateTutor $requestCreateTutor): Tutor
    {
        $tutor = (new Tutor());
        $tutor->fill($requestCreateTutor->all());
        $tutor->role_id = EnumRoles::USUARIO;
        $tutor->active = EnumGeneralStatus::ATIVADO;
        $tutor->save();
        return $tutor;

        //teste
    
    }
}
