<?php

namespace App\Http\Controllers\Tutor;

use App\Enum\Role\EnumRoles;
use App\Enum\System\EnumGeneralStatus;
use App\Http\Controllers\Auth\Tutor\Interface\VariableTutor;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Tutor\Requests\RequestCreateTutor;
use App\Http\Controllers\Tutor\Requests\RequestDeleteTutor;
use App\Messages\MessageTutor;
use App\Models\Tutor\Tutor;
use Illuminate\Support\Facades\DB;

class TutorController extends Controller implements VariableTutor
{
    /**
     * @var Tutor|null
     */
    protected Tutor|null $tutor;

    protected bool $sucesso = false;

    /**
     * @throws \Exception
     */
    public function store(RequestCreateTutor $request)
    {
        $tutor = (new Tutor);

        try {
            DB::beginTransaction();
            $tutor->fill($request->all());
            $tutor->role_id = EnumRoles::USUARIO;
            $tutor->active = EnumGeneralStatus::ATIVADO;
            $tutor->save();
            $this->setSucesso();
            DB::commit();
        } catch (\Exception $exception)
        {
            DB::rollBack();
            return response()->json([
                self::ERRORS => $exception->getMessage()
            ]);
        } finally {
            if ($this->getSucesso())
            {
                return response()->json([
                    self::MESSAGE => MessageTutor::CLT014,
                    self::TUTOR => $tutor
                ], 201);
            }
        }
    }

    public function destroy(RequestDeleteTutor $request)
    {
        var_dump($request);
        return false;
    }

    protected function getSucesso(): bool
    {
        return $this->sucesso;
    }

    protected function setSucesso(bool $sucesso = true): void
    {
        $this->sucesso = $sucesso;
    }
}
