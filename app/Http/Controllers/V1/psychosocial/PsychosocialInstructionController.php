<?php

namespace App\Http\Controllers\V1\psychosocial;

use App\Http\Controllers\Controller;
use App\Http\Requests\PsychosocialInstructionRequest;
use App\Http\Requests\UpdatePsychosocialInstructionRequest;
use App\Models\Module;
use App\Models\PsychosocialInstructions\PsychosocialInstruction;
use App\Repositories\PsychosocialInstructionRepository;
use App\Utilities\Resources;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class PsychosocialInstructionController extends Controller
{


    private $PsychosocialInstructionRepository;

    function __construct(PsychosocialInstructionRepository $PsychosocialInstructionRepository)
    {
        $this->PsychosocialInstructionRepository = $PsychosocialInstructionRepository;
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse|void
     *
     */
    public function index(Request $request)
    {
        Gate::authorize('haveaccess');
        try {
            $results = $this->PsychosocialInstructionRepository->getAll();
            return $results->toArray($request);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al listar instrucción psicosocial' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PsychosocialInstructionRequest $request)
    {
        Gate::authorize('haveaccess');
        DB::beginTransaction();
        try {
            DB::commit();

            return $this->PsychosocialInstructionRepository->createPsychosocialInstruction($request);
        } catch (\Exception $ex) {
            DB::rollBack();
            return  $this->createErrorResponse([], 'Algo salio mal al guardar instrucción psicosocial' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        Gate::authorize('haveaccess');
        try {
            $validator = Validator::make(['id' => $id], [
                'id' => ['bail', 'required', 'numeric', Rule::exists(PsychosocialInstruction::class, 'id,deleted_at,NULL')],
            ]);
            if ($validator->fails()) {
                return $this->createResponse($validator->errors(), 'Falló la validación', 400);
            }
            $result = $this->PsychosocialInstructionRepository->getPsychosocialInstructionById($id);
            if (empty($result)) {
                return $this->createResponse($result, 'No se encontró instrución psicosocial', 404);
            }
            return $this->createResponse($result, 'La instrución psicosocial fue encontrada');

        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al ver instrucción psicosocial' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdatePsychosocialInstructionRequest $request, $id)
    {

        Gate::authorize('haveaccess');
        DB::beginTransaction();
        try {
            DB::commit();
            return $this->PsychosocialInstructionRepository->updatePsychosocialInstruction($request, $id);
        } catch (\Exception $ex) {
            DB::rollBack();
            return  $this->createErrorResponse([], 'Algo salio mal al actualizar instrucción psicosocial' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        Gate::authorize('haveaccess');
        try {
            $validator = Validator::make(['id' => $id], [
                'id' => ['bail', 'required', 'numeric', Rule::exists(PsychosocialInstruction::class, 'id,deleted_at,NULL')],
            ]);
            if ($validator->fails()) {
                return $this->createResponse($validator->errors(), 'Falló la validación', 400);
            }
            return $this->PsychosocialInstructionRepository->deletePsychosocialInstruction($id);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al eliminar instrucción psicosocial' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore($id)
    {
        Gate::authorize('haveaccess');
        try {
            $validator = Validator::make(['id' => $id], [
                'id' => ['bail', 'required', 'numeric', Rule::exists(PsychosocialInstruction::class, 'id,deleted_at,NOT_NULL')],
            ]);
            if ($validator->fails()) {
                return $this->createResponse($validator->errors(), 'Falló la validación', 400);
            }
            return $this->PsychosocialInstructionRepository->restorePsychosocialInstruction($id);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], $ex->getMessage());
        }
    }

    /**
     * @return \App\Http\Resources\V1\PsychosocialInstructionCollection|\Illuminate\Http\JsonResponse
     */
    public function getMonitor()
    {
        try {
            return $this->PsychosocialInstructionRepository->getMonitors();
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], $ex->getMessage());
        }
    }
}
