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
use Symfony\Component\HttpFoundation\Request;

class TutorController extends Controller implements VariableTutor, VariableRequest
{

    public function index(Request $request): JsonResponse
    {
        $pageSize = $request->get(self::PER_PAGE, 25);
        $tutors = Tutor::query()->paginate($pageSize);


        return response()->json($tutors, 200);
    }

    /**
     * @throws \Exception
     */
    public function store(RequestCreateTutor $request): JsonResponse
    {
        try {
            $tutor = (new Tutor());
            $tutor->fill($request->all());
            $tutor->role_id = EnumRoles::USUARIO;
            $tutor->active = EnumGeneralStatus::ATIVADO;
            $tutor->save();
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
        $tutor = Tutor::query()->findOrFail($id);
        return response()->json($tutor);
    }

    public function destroy(RequestDeleteTutor $request): JsonResponse
    {
        try {
            $tutor = Tutor::query()->where(self::ID, $request->all()[self::ID])->first();

            if ($tutor instanceof Tutor) {
                $tutor->delete();
            } else {
                throw new \Exception(MessageTutor::CLT015);
            }
            return response()->json([
                self::MESSAGE => MessageTutor::CLT016,
            ], 201);
        } catch (\Exception $exception) {
            return response()->json([
                self::ERRORS => $exception->getMessage()
            ]);
        }
    }
}
