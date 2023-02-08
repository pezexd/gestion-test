<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\MethodologicalInstructionModel;
use App\Repositories\MethodologicalInstructionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class MethodologicalInstructionController extends Controller
{
    private $methodologicalInstructionRepository;
    function __construct(MethodologicalInstructionRepository $methodologicalInstructionRepository)
    {
        $this->methodologicalInstructionRepository = $methodologicalInstructionRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('haveaccess');
        try {
            $results = $this->methodologicalInstructionRepository->getAll();
            return $results->toArray($request);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al listar instrucción metodologica ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('haveaccess');
        $request['created_by'] = Auth::id();
        try {

            $validator = $this->methodologicalInstructionRepository->getValidate($request->all(), 'create');

            if ($validator->fails()) {
                return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            }
            return $this->methodologicalInstructionRepository->create($request);

        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al guardar instrucción metodologica ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Gate::authorize('haveaccess');
        try {
            $result = $this->methodologicalInstructionRepository->findById($id);
            if (empty($result)) {
                return $this->createResponse($result, 'No se encontró la instruccion metodologica', 202);
            }
            return $this->createResponse($result, 'Instruccion metodologica fue encontrada');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al verr instrucción metodologica ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        Gate::authorize('haveaccess');
        try {

            $validator = $this->methodologicalInstructionRepository->getValidate($request->all(), 'update');

            if ($validator->fails()) {
                return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            }

           return $this->methodologicalInstructionRepository->update($request, $id);

        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al actualizar instrucción metodologica ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('haveaccess');
        try {
            $result = $this->methodologicalInstructionRepository->delete($id);

            return $this->createResponse($result, 'Usuario eliminado');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al eliminar instrucción metodologica ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }
}
