<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PsychopedagogicalLogBookRequest;
use App\Http\Requests\UpdatePsychopedagogicalLogBookRequest;
use App\Models\PsychopedagogicalLogbooks\PsychopedagogicalLogbook;
use App\Repositories\PsychopedagogicalLogBookRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class PsychopedagogicalLogBookController extends Controller
{
    private $psychopedagogicalLogBookRepository;

    function __construct(PsychopedagogicalLogBookRepository $psychopedagogicalLogBookRepository)
    {
        $this->psychopedagogicalLogBookRepository = $psychopedagogicalLogBookRepository;
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
            $results = $this->psychopedagogicalLogBookRepository->getAll();
            return $results->toArray($request);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al listar las bitácoras psicopedagógica ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PsychopedagogicalLogBookRequest $request)
    {
        Gate::authorize('haveaccess');
        try {
            return $this->createResponse($this->psychopedagogicalLogBookRepository->create($request),  'Se ha guardado exitosamente');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al guardar la bitácora psicopedagógica ' . $ex->getMessage() . ' linea ' . $ex->getCode());
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
                'id' => ['bail', 'required', 'numeric', Rule::exists(PsychopedagogicalLogbook::class, 'id,deleted_at,NULL')],
            ]);
            if ($validator->fails()) {
                return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            }
            $result = $this->psychopedagogicalLogBookRepository->getById($id);
            if (empty($result)) {
                return $this->createResponse($result, 'No se encontró la bitácora psicopedagógica', 404);
            }
            return $this->createResponse($result, 'La bitácora psicopedagógica fue encontrada');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al ver la bitácora psicopedagógica ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdatePsychopedagogicalLogBookRequest $request, $id)
    {
        Gate::authorize('haveaccess');
        try {
            return  $this->createResponse($this->psychopedagogicalLogBookRepository->update($request, $id), 'Se ha actualizado exitosament');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al actualizar la bitácora psicopedagógica ' . $ex->getMessage() . ' linea ' . $ex->getCode());
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
                'id' => ['bail', 'required', 'numeric', Rule::exists(PsychopedagogicalLogbook::class, 'id,deleted_at,NULL')],
            ]);
            if ($validator->fails()) {
                return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            }
            return  $this->createResponse($this->psychopedagogicalLogBookRepository->delete($id), 'Se ha eliminado exitosament');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al eliminar la bitácora psicopedagógica ' . $ex->getMessage() . ' linea ' . $ex->getCode());
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
                'id' => ['bail', 'required', 'numeric', Rule::exists(PsychopedagogicalLogbook::class, 'id,deleted_at,NOT_NULL')],
            ]);
            if ($validator->fails()) {
                return $this->createResponse($validator->errors(), 'Falló la validación', 400);
            }
            return $this->psychopedagogicalLogBookRepository->restore($id);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al restaurar la bitácora psicopedagógica ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }
}
