<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Cliente\Tutor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TutorController extends Controller
{
    /**
     * @var Tutor|null
     */
    protected Tutor|null $tutor;

    protected bool $sucesso = false;

    /**
     * @throws \Exception
     */
    public function store(Request $request): void
    {
        try {
            DB::beginTransaction();
            $this->tutor = Tutor::create($request->all());
            $this->setSucesso();
            DB::commit();
        } catch (\Exception $exception)
        {
            DB::rollBack();
            $this->tratarErro($exception);
        } finally {
            if ($this->getSucesso())
            {
                $this->tratarSucesso($this->tutor);
            }
        }
    }

    protected function tratarErro(\Exception $exception): JsonResponse
    {
        return response()->json([
            'error' => $exception->getMessage()
        ], $exception->getCode());
    }

    protected function tratarSucesso(Tutor $tutor): JsonResponse
    {
        return response()->json([
            'message' => 'Tutor created successfully',
            'tutor' => $tutor
        ], 201);
    }

    protected function getSucesso()
    {
        return $this->getSucesso();
    }

    protected function setSucesso(bool $sucesso = true): void
    {
        $this->sucesso = $sucesso;
    }
}
