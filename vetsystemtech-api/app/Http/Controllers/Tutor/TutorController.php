<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use App\Models\Tutor\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;

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
