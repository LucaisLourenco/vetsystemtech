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
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class TutorController extends Controller implements VariableTutor
{
    /**
     * @var Tutor|null
     */
    protected Tutor|null $tutor;

    protected bool $sucesso = false;

    public function index(): JsonResponse
    {
        $tutors = Tutor::all();
        return response()->json([self::TUTORS => $tutors], 200);
    }

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
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                self::ERRORS => $exception->getMessage()
            ]);
        } finally {
            if ($this->getSucesso()) {
                return response()->json([
                    self::MESSAGE => MessageTutor::CLT014,
                    self::TUTOR => $tutor
                ], 201);
            }
        }
    }

    public function destroy(RequestDeleteTutor $request)
    {

        try {
            DB::beginTransaction();

            $tutor = Tutor::where(self::CPF, $request->all()[self::CPF])->first();

            if ($tutor instanceof Tutor) {
                $tutor->delete();
            } else {
                throw new \Exception(MessageTutor::CLT015);
            }
            $this->setSucesso();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                self::ERRORS => $exception->getMessage()
            ]);
        } finally {
            if ($this->getSucesso()) {
                return response()->json([
                    self::MESSAGE => MessageTutor::CLT016,
                ], 201);
            }
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
