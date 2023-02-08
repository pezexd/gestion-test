<?php

namespace App\Repositories;

use App\Models\Orientation;
use App\Http\Resources\V1\OrientationCollection;
use App\Http\Resources\V1\OrientationResource;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\FunctionGeneralTrait;


class OrientationRepository
{
    use FunctionGeneralTrait;

    public function getAll()
    {
        $results = new OrientationCollection(Orientation::orderBy('id', 'DESC')->get());
        return $results;
    }
    public function create($request)
    {
        $orientation = Orientation::create($request);
        // Guardamos en dataModel
        $this->control_data($orientation, 'store');
        $results = new OrientationResource($orientation);
        return $results;
    }

    public function findById($id)
    {
        $orientation = Orientation::findOrFail($id);
        $result = new OrientationResource($orientation);
        return $result;
    }

    public function update($data, $id)
    {
        $orientation = Orientation::findOrFail($id);
        $orientation->update($data);
        // Guardamos en dataModel
        $this->control_data($orientation, 'update');
        $result = new OrientationResource($orientation);
        return $result;
    }

    public function delete($id)
    {
        $orientation = Orientation::findOrFail($id);
        $orientation->delete();

        return response()->json(['message' => 'Se ha eliminado correctamente']);
    }
}
