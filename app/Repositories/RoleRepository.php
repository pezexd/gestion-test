<?php

namespace App\Repositories;

use App\Models\Role;
use App\Http\Resources\V1\RoleCollection;
use App\Traits\FunctionGeneralTrait;
class RoleRepository
{
    use FunctionGeneralTrait;

    private $model;
    private $safeRolesID = [1, 2];
    function __construct()
    {
        $this->model = new Role();
    }

    function getAll()
    {
        return new RoleCollection($this->model->orderBy('id', 'DESC')->get());
    }

    public function create($data)
    {
        $rol = $this->model->create($data);
        // Guardamos en DataModel
        $this->control_data($rol, 'store');
        return $rol;
    }

    public function show($id)
    {
        return $this->model->find($id);
    }

    public function update($data, $id)
    {
        $rol = $this->model->findOrFail($id);
        $rol->update($data);
        // Guardamos en ModelData
        $this->control_data($rol, 'update');
        return $rol;
    }

    public function delete($id)
    {
        $isSafe = in_array($id, $this->safeRolesID);
        if (!$isSafe) {
            return $this->model->where('id', $id)->delete();
        }
        return [];
    }
}
