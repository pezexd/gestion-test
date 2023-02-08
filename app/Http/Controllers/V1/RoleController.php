<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    private $roleRepository;
    function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
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
            $results = $this->roleRepository->getAll();
            return $results->toArray($request);
        } catch (\Exception $ex) {
            $this->createErrorResponse([], 'Algo salio mal al listar roles ' . $ex->getMessage() . ' linea ' . $ex->getCode());
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
                'name' => 'required|string|max:255',
                'slug' => 'required|string|unique:roles,id,' . $request->role,
                'description' => 'required'
            ]);
            if ($validator->fails()) {
                return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            }
            $result = $this->roleRepository->create($request->all());

            return $this->createResponse($result, 'Rol creado');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al guardar rol ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        Gate::authorize('haveaccess');
        try {
            $result = $this->roleRepository->show($request->role);
            if (empty($result)) {
                return $this->createResponse($result, 'No se encontró el rol', 404);
            }
            return $this->createResponse($result, 'El rol fue encontrado');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al ver rol ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Gate::authorize('haveaccess');
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required', 'string', 'max:255',
                'slug' => 'required|string',
                'description' => 'required'
            ]);
            if ($validator->fails()) {
                return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            }

            $data = $request->all();
            $result = $this->roleRepository->update($data, $request->role);

            return $this->createResponse($result, 'Rol actualizado');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al actualizar rol ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('haveaccess');
        try {
            $result = $this->roleRepository->delete($id);

            if (empty($result)) {
                return $this->createResponse($result, 'El rol no puede ser eliminado.');
            }

            return $this->createResponse($result, 'Rol eliminado');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al eliminar rol ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }
}
