<?php

namespace App\Repositories;

use App\Models\Permission;
use App\Http\Resources\V1\PermissionCollection;
use App\Traits\FunctionGeneralTrait;

class PermissionRepository
{
    use FunctionGeneralTrait;
    private $model;
    function __construct()
    {
        $this->model = new Permission();
    }

    public function getAll()
    {
        if (request()->has('group_by')) {
            return new PermissionCollection($this->model->get()->groupBy('controller'));
        }
        return new PermissionCollection($this->model->orderBy('id', 'DESC')->get());
    }
    public function create($data)
    {
        $permission = $this->model->create($data);
        $this->control_data($permission, 'store');
        return $permission;
    }

    public function show($id)
    {
        return $this->model->find($id);
    }

    public function update($data, $id)
    {
        $permission = $this->model->findOrFail($id);
        $permission->update($data);
        $this->control_data($permission, 'update');
        return $permission;
    }

    public function delete($id)
    {
        return $this->model->where('id', $id)->delete();
    }
}
