<?php

namespace App\Repositories;

use App\Models\Expertise;
use App\Http\Resources\V1\ExpertisesCollection;
use App\Http\Resources\V1\ExpertisesResource;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\FunctionGeneralTrait;


class ExpertiseRepository
{
    use FunctionGeneralTrait;

    public function getAll()
    {
        $results = new ExpertisesCollection(Expertise::orderBy('id', 'DESC')->get());
        return $results;
    }
    public function create($request)
    {
        $expertise = Expertise::create($request);
        // Guardamos en dataModel
        $this->control_data($expertise, 'store');
        $results = new ExpertisesResource($expertise);
        return $results;
    }

    public function findById($id)
    {
        $expertise = Expertise::findOrFail($id);
        $result = new ExpertisesResource($expertise);
        return $result;
    }

    public function update($data, $id)
    {
        $expertise = Expertise::findOrFail($id);
        $expertise->update($data);
        // Guardamos en dataModel
        $this->control_data($expertise, 'update');
        $result = new ExpertisesResource($expertise);
        return $result;
    }

    public function delete($id)
    {
        $expertise = Expertise::findOrFail($id);
        $expertise->delete();

        return response()->json(['items' => 'Se ha eliminado correctamente']);
    }
}
