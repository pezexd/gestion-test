<?php

namespace App\Repositories;

use App\Models\Neighborhood;
use App\Http\Resources\V1\NeighborhoodCollection;
use App\Http\Resources\V1\NeighborhoodResource;
use App\Traits\FunctionGeneralTrait;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\FunctionGeneralTraitS;


class NeighborhoodRepository
{
    use FunctionGeneralTrait;

    public function getAll()
    {
        $results = new NeighborhoodCollection(Neighborhood::orderBy('id', 'DESC')->get());
        return $results;
    }
    public function create($request)
    {
        $neighborhood = Neighborhood::create($request);
        // Guardamos en dataModel
        $this->control_data($neighborhood, 'store');
        $results = new NeighborhoodResource($neighborhood);
        return $results;
    }

    public function findById($id)
    {
        $neighborhood = Neighborhood::findOrFail($id);
        $result = new NeighborhoodResource($neighborhood);
        return $result;
    }

    public function update($data, $id)
    {
        $neighborhood = Neighborhood::findOrFail($id);
        $neighborhood->update($data);
        // Guardamos en dataModel
        $this->control_data($neighborhood, 'update');
        $result = new NeighborhoodResource($neighborhood);
        return $result;
    }

    public function delete($id)
    {
        $neighborhood = Neighborhood::findOrFail($id);
        $neighborhood->delete();

        return response()->json(['message' => 'Se ha eliminado correctamente']);
    }
}
