<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Repositories\PermissionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
    private $permissionRepository;
    function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
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
            $results = $this->permissionRepository->getAll();
            return $results->toArray($request);
        } catch (\Exception $ex) {
            return $this->createErrorResponse([], 'Algo salio mal al listar permisos' . $ex->getMessage() . ' linea ' . $ex->getCode());
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
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'slug' => ['required', 'string', Rule::unique(Permission::class)],
                'description' => ['required']
            ]);
            if ($validator->fails()) {
                return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            }

            $result = $this->permissionRepository->create($request->all());

            return $this->createResponse($result, 'Permiso creado');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al guardar permiso ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        Gate::authorize('haveaccess');
        try {
            $result = $this->permissionRepository->show($request->permission);
            if (empty($result)) {
                return $this->createResponse($result, 'No se encontró el permiso', 404);
            }
            return $this->createResponse($result, 'El permiso fue encontrado');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al ve permiso ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Gate::authorize('haveaccess');
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'slug' => 'required|string|unique:permissions,id,' . $request->permission,
                'description' => 'required'
            ]);

            if ($validator->fails()) {
                return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            }
            $data = $request->all();
            $result = $this->permissionRepository->update($data, $request->permission);

            return $this->createResponse($result, 'Permiso editado');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al actualizar permiso ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('haveaccess');
        try {
            $result = $this->permissionRepository->delete($id);

            return $this->createResponse($result, 'Permiso eliminado');
        } catch (\Exception $ex) {
            return $this->createErrorResponse([], 'Algo salio mal al eliminar permiso' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }
}
