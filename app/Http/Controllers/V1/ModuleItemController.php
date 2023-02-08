<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\ModuleItem;
use App\Repositories\ModuleItemRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class ModuleItemController extends Controller
{
    private $moduleRepository;
    function __construct(ModuleItemRepository $moduleRepository)
    {
        $this->moduleRepository = $moduleRepository;
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
            $results = $this->moduleRepository->getAll();
            return $results->toArray($request);
        } catch (\Exception $ex) {
            return $this->createErrorResponse([], 'Algo salio mal al listar modulo item ' . $ex->getMessage() . ' linea ' . $ex->getCode());
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
        try {

            $validator = $this->moduleRepository->getValidate($request->all(), 'create');

            if ($validator->fails()) {
                return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            }

            $result = $this->moduleRepository->create($request->all());

            return $this->createResponse($result, 'Módulo item creado');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al guardar modulo item ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Gate::authorize('haveaccess');
        try {

            $result = $this->moduleRepository->show($id);

            if (empty($result)) {
                return $this->createResponse($result, 'No se encontró el módulo item', 404);
            }
            return $this->createResponse($result, 'El módulo item fue encontrado');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al ver modulo item ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Gate::authorize('haveaccess');
        try {

            $validator = $this->moduleRepository->getValidate($request->all(), 'update');

            if ($validator->fails()) {
                return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            }

            $result = $this->moduleRepository->update($request->all(), $request->item);

            return $this->createResponse($result, 'Módulo item actualizado');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al actualizar modulo item ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('haveaccess');
        try {
            $result = $this->moduleRepository->delete($id);

            if (empty($result)) {
                return $this->createResponse($result, 'El módulo item no puede ser eliminado.', 201);
            }

            return $this->createResponse($result, 'Módulo item eliminado');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al eliminar modulo item ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }
}
