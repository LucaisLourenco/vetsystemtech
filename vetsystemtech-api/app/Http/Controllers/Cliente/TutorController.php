<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Cliente\Tutor;
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
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->tutor = Tutor::create($request->all());
            $this->setSucesso();
            DB::commit();
        } catch (\Exception $exception)
        {
            DB::rollBack();
            return response()->json([
                'error' => $exception->getMessage()
            ]);
        }
        finally {
            if ($this->getSucesso())
            {
                return response()->json([
                    'message' => 'Tutor created successfully',
                    'tutor' => $this->tutor
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
