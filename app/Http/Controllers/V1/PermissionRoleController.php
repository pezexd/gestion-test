<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\PermissionRole;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class PermissionRoleController extends Controller
{

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
                'role_id' => 'required',
                'permissions' => 'required|array'
            ]);

            if ($validator->fails()) {
                return $this->createResponse($validator->errors(), 'Falló la validación', 400);
            }
            $role = Role::find($request->role_id);
            $role->permissions()->sync($request->permissions);
            $role = Role::find($request->role_id);

            return $this->createResponse($role, 'Permisos guardados');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al al relacionar un permiso con un rol '.$ex->getMessage() .' linea '. $ex->getCode());
        }
    }
}
