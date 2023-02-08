<?php

namespace App\Http\Controllers\V1\psychosocial;

use App\Http\Controllers\Controller;
use App\Http\Requests\ParentSchoolRequest;
use App\Http\Requests\UpdateParentSchoolRequest;
use App\Http\Resources\V1\ParentSchoolCollection;
use App\Models\Module;
use App\Models\ParentSchools\ParentSchool;
use App\Repositories\ParentSchoolRepository;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\V1\ParentSchoolResource;

class ParentSchoolController extends Controller
{


    private $parentSchoolRepository;

    function __construct(ParentSchoolRepository $parentSchoolRepository)
    {
        $this->parentSchoolRepository = $parentSchoolRepository;
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
            $results = $this->parentSchoolRepository->getAll();
            return $this->createResponse($results);
        } catch (Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al listar escuela de padre' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ParentSchoolRequest $request)
    {
        Gate::authorize('haveaccess');
        try {
            return $this->parentSchoolRepository->createParentSchool($request);
        } catch (Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al guardar escuela de padre ' . $ex->getMessage() . ' linea ' . $ex->getCode());
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
                'id' => ['bail', 'required', 'numeric', Rule::exists(ParentSchool::class, 'id,deleted_at,NULL')],
            ]);
            if ($validator->fails()) {
                return $this->createResponse($validator->errors(), 'Falló la validación', 400);
            }
            $result = $this->parentSchoolRepository->getParentSchoolById($id);
            if (empty($result)) {
                return $this->createResponse(new ParentSchoolResource($result), 'No se encontró escuela de padre', 404);
            }
            return $this->createResponse($result, 'La escuela de padre fue encontrada');
        } catch (Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al ver escuela de padre ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateParentSchoolRequest $request, $id)
    {
        Gate::authorize('haveaccess');
        try {
            return $this->parentSchoolRepository->updateParentSchool($request, $id);
        } catch (Exception $ex) {
            $msg = $ex->getMessage();

            if (strpos($msg, 'Data too long')) {
                if (strpos($msg, 'assistant_phone')) {
                    return response()->json(['message' => 'El numero de teléfono para un asistente debe contener un máximo de 10 caracteres.', 'success' => false], 500);
                }
            } else {
                return  $this->createErrorResponse([], 'Algo salio mal al actualizar escuela de padre ' . $ex->getMessage() . ' linea ' . $ex->getCode());
            }
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
                'id' => ['bail', 'required', 'numeric', Rule::exists(ParentSchool::class, 'id,deleted_at,NULL')],
            ]);
            if ($validator->fails()) {
                return $this->createResponse($validator->errors(), 'Falló la validación', 400);
            }
            return $this->parentSchoolRepository->deleteParentSchool($id);
        } catch (Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al eliminar escuela de padre ' . $ex->getMessage() . ' linea ' . $ex->getCode());
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
        try {
            $validator = Validator::make(['id' => $id], [
                'id' => ['bail', 'required', 'numeric', Rule::exists(ParentSchool::class, 'id,deleted_at,NOT_NULL')],
            ]);
            if ($validator->fails()) {
                return $this->createResponse($validator->errors(), 'Falló la validación', 400);
            }
            return $this->parentSchoolRepository->restoreParentSchool($id);
        } catch (Exception $ex) {
            return  $this->createErrorResponse([], $ex->getMessage());
        }
    }

    /**
     * @return \App\Http\Resources\V1\ParentSchoolCollection|\Illuminate\Http\JsonResponse
     */
    public function getMonitor()
    {
        try {
            return $this->parentSchoolRepository->getMonitors();
        } catch (Exception $ex) {
            return  $this->createErrorResponse([], $ex->getMessage());
        }
    }
}
