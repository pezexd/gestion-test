<?php

namespace App\Repositories;

use App\Models\EntityName;
use App\Http\Resources\V1\EntityNameCollection;
use App\Http\Resources\V1\EntityNameResource;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\FunctionGeneralTrait;

class EntityNameRepository
{
    use FunctionGeneralTrait;

    public function getAll()
    {
        $results = new EntityNameCollection(EntityName::orderBy('id', 'DESC')->get());
        return $results;
    }
    public function create($request)
    {
        $entityName = EntityName::create($request);
        // Guardamos en dataModel
        $this->control_data($entityName, 'store');
        $results = new EntityNameResource($entityName);
        return $results;
    }

    public function findById($id)
    {
        $entityName = EntityName::findOrFail($id);
        $result = new EntityNameResource($entityName);
        return $result;
    }

    public function update($data)
    {
        $entityName = EntityName::findOrFail($data['id']);
        $entityName->update($data);
        // Guardamos en dataModel
        $this->control_data($entityName, 'update');
        $result = new EntityNameResource($entityName);
        return $result;
    }

    public function delete($id)
    {
        $entityName = EntityName::findOrFail($id);
        $entityName->delete();

        return response()->json(['items' => 'Se ha eliminado correctamente']);
    }
}
