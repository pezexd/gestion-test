<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Asistant;
use App\Repositories\AsistantRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;


class AsistantController extends Controller
{
    private $assistantRepository;
    function __construct(AsistantRepository $assistantRepository)
    {
        $this->assistantRepository = $assistantRepository;
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
            $results = $this->assistantRepository->getAll();
            return $results->toArray($request);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal ' . $ex->getMessage() . ' linea ' . $ex->getCode());
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
            $validator = $this->assistantRepository->getValidate($request->all(), 'create');
            if ($validator->fails()) {
                return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            }

            $result = $this->assistantRepository->create($request->all());

            return $this->createResponse($result, 'Asistente creado');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DialogueTables\AsistantDialogueTable  $assistant
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        Gate::authorize('haveaccess');
        try {
            $result = $this->assistantRepository->show($request->assistant);
            if (empty($result)) {
                return $this->createResponse($result, 'No se encontró asistente', 404);
            }
            return $this->createResponse($result, 'La asistente fue encontrado');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al listar asistente ' . $ex->getMessage() . ' linea' . $ex->getCode());
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DialogueTables\AsistantDialogueTable  $assistant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Gate::authorize('haveaccess');
        try {
            $validator = $this->assistantRepository->getValidate($request->all(), 'update');
            if ($validator->fails()) {
                return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            }
            $data = $request->all();
            $result = $this->assistantRepository->update($data, $request->assistant);

            return $this->createResponse($result, 'Asistente editado');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al actualizar asistente ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DialogueTables\AsistantDialogueTable  $assistant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('haveaccess');
        try {
            $result = $this->assistantRepository->delete($id);

            return $this->createResponse($result, 'Asistente eliminado');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al eliminar asistente ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }
}
