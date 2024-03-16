<?php

namespace App\Http\Controllers\Tutor;

use App\Enum\Gender\EnumGenders;
use App\Enum\Role\EnumRoles;
use App\Enum\System\EnumGeneralStatus;
use App\Http\Controllers\Auth\Tutor\Interface\VariableTutor;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Tutor\Requests\RequestCreateTutor;
use App\Models\Tutor\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;

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
        try {
            DB::beginTransaction();
            $tutor = (new Tutor)->fill($request->all());
            $tutor->role_id = EnumRoles::USUARIO;
            $tutor->active = EnumGeneralStatus::ATIVADO;
            $tutor->inserir();
            $this->setSucesso();
            DB::commit();
        } catch (\Exception $exception)
        {
            DB::rollBack();
            return response()->json([
                self::ERRORS => $exception->getMessage()
            ]);
        } catch (JWTException $exception)
        {
            DB::rollBack();
            return response()->json([
                'error' => 'Token JWT não encontrado'
            ], Response::HTTP_UNAUTHORIZED);
        } finally {
//            if ($this->getSucesso())
//            {
//                return response()->json([
//                    'message' => 'Tutor created successfully',
//                    'tutor' => $this->tutor
//                ], 201);
//            }
        }
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
