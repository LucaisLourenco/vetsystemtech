<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Auth\Tutor\Interface\VariableTutor;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Tutor\Requests\RequestCreateTutor;
use App\Http\Controllers\Tutor\Requests\RequestDeleteTutor;
use App\Http\Controllers\Tutor\Requests\RequestEditTutor;
use App\Http\Controllers\Tutor\Traits\TraitSupportTutor;
use App\Http\Controllers\Utils\Interfaces\VariableRequest;
use App\Messages\MessageSystem;
use App\Messages\MessageTutor;
use App\Models\Tutor\Tutor;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class TutorController extends Controller implements VariableTutor, VariableRequest
{
    use TraitSupportTutor;

    public function index(Request $request): JsonResponse
    {
        $pageSize = $request->get(self::PER_PAGE, 25);
        $tutors = Tutor::query()->paginate($pageSize);
        return response()->json($tutors);
    }

    /**
     * @throws \Exception
     */
    public function store(RequestCreateTutor $request): JsonResponse
    {
        try {
            $tutor = $this->createTutorByRequest($request);
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

    public function update(RequestEditTutor $request, $id): JsonResponse
    {
        try {
            $tutor = Tutor::query()->where(self::ID, $id)->firstOrFail();
            $tutor->update($request->all());
            return response()->json([
                self::MESSAGE => MessageTutor::CLT017,
                self::TUTOR => $tutor
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json(MessageTutor::CLT015, 404);
        } catch (\Exception $exception) {
            return response()->json([
                self::ERRORS => $exception->getMessage()
            ], 500);
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
            $tutor = Tutor::query()->where(self::ID, $request->all()[self::ID])->firstOrFail();
            $tutor->delete();
            return response()->json([
                self::MESSAGE => MessageTutor::CLT016,
            ], 201);
        } catch (ModelNotFoundException $exception) {
            return response()->json(MessageTutor::CLT015, 404);
        } catch (\Exception $exception) {
            return response()->json(MessageSystem::SYS001, 500);
        }
    }
}
