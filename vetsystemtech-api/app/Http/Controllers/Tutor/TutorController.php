<?php

namespace App\Http\Controllers\Tutor;

use App\Enum\Role\EnumRoles;
use App\Enum\System\EnumGeneralStatus;
use App\Http\Controllers\Auth\Tutor\Interface\VariableTutor;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Tutor\Requests\RequestCreateTutor;
use App\Http\Controllers\Tutor\Requests\RequestDeleteTutor;
use App\Http\Controllers\Utils\Interfaces\VariableRequest;
use App\Messages\MessageTutor;
use App\Models\Tutor\Tutor;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class TutorController extends Controller implements VariableTutor, VariableRequest
{
    /**
     * @var Tutor|null
     */
    protected Tutor|null $tutor;

    protected bool $sucesso = false;

    public function index(Request $request): JsonResponse
    {
        $pageSize = $request->input(self::PER_PAGE, 25);
        $tutors = Tutor::paginate($pageSize);

        
        return response()->json($tutors, 200);
    }

    /**
     * @throws \Exception
     */
    public function store(RequestCreateTutor $request)
    {

        try {
            $tutor = (new Tutor);
            $tutor->fill($request->all());
            $tutor->role_id = EnumRoles::USUARIO;
            $tutor->active = EnumGeneralStatus::ATIVADO;
            $tutor->save();
            $this->setSucesso();
            return response()->json([
                self::MESSAGE => MessageTutor::CLT014,
                self::TUTOR => $tutor
            ], 201);
        } catch (\Exception $exception) {
            return response()->json([
                self::ERRORS => $exception->getMessage()
            ]);
        }
    }

    public function show(int $id): JsonResponse
    {
        $tutor = Tutor::findOrFail($id);

        return response()->json($tutor);
    }

    public function destroy(RequestDeleteTutor $request)
    {

        try {
            DB::beginTransaction();

            $tutor = Tutor::where(self::ID, $request->all()[self::ID])->first();

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
