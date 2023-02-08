<?php

namespace App\Repositories;

use App\Models\Group;
use App\Http\Resources\V1\GroupCollection;
use App\Http\Resources\V1\GroupResource;
use App\Traits\FunctionGeneralTrait;
use App\Traits\UserDataTrait;

class GroupRepository
{
    use UserDataTrait, FunctionGeneralTrait;

    public function getAll()
    {
        $rol_id = $this->getIdRolUserAuth();
        $user_id = $this->getIdUserAuth();
        $query = Group::query();
        $groups = [];
        if ($rol_id == config('roles.instructor') || $rol_id == config('roles.monitor')) {

            $groups =  $query->orderBy('id', 'DESC')->where('user_id', $user_id)->get();
        }
        if ($rol_id == config('roles.root') || $rol_id == config('roles.super_root')) {
            $groups = $query->orderBy('id', 'DESC')->get();
        }

        $results = new GroupCollection($groups);
        return $results;
    }
    public function create($request)
    {
        // $request['user_id'] = $this->getIdUserAuth();
        $group = Group::create($request);
        // Guardamos en dataModel
        $this->control_data($group, 'store');
        $results = new GroupResource($group);
        return $results;
    }

    public function findById($id)
    {
        $group = Group::findOrFail($id);
        $result = new GroupResource($group);
        return $result;
    }

    public function update($data, $id)
    {
        $group = Group::findOrFail($id);
        $group->update($data);
        // Guardamos en dataModel
        $this->control_data($group, 'update');
        $result = new GroupResource($group);
        return $result;
    }

    public function delete($id)
    {
        $group = Group::findOrFail($id);
        $group->delete();
        return response()->json(['items' => 'Se ha eliminado correctamente']);
    }

    public function getGroups()
    {
        $query = Group::query();
        $groups = [];
        $rol_id = $this->getIdRolUserAuth();
        if ($rol_id == config('roles.instructor') || $rol_id == config('roles.monitor')) {
            $groups =  $query->select('id as value', 'name as label')->orderBy('id', 'DESC')->where('user_id', $this->getIdUserAuth())->get();
        }
        if ($rol_id == config('roles.root') || $rol_id == config('roles.super_root')) {
            $groups = $query->select('id as value', 'name as label')->orderBy('id', 'DESC')->get();
        }
        return $groups;
    }
}
