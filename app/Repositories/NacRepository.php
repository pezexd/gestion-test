<?php

namespace App\Repositories;

use App\Models\Nac;
use App\Http\Resources\V1\NacCollection;
use App\Http\Resources\V1\NacResource;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\FunctionGeneralTrait;;


class NacRepository
{
    use FunctionGeneralTrait;

    public function getAll()
    {
        $results = new NacCollection(Nac::orderBy('id', 'DESC')->get());
        return $results;
    }
    public function create($request)
    {
        $nac = Nac::create($request);
        // Guardamos en dataModel
        $this->control_data($nac, 'store');
        $results = new NacResource($nac);
        return $results;
    }

    public function findById($id)
    {
        $nac = Nac::findOrFail($id);
        $result = new NacResource($nac);
        return $result;
    }

    public function update($data, $id)
    {
        $nac = Nac::findOrFail($id);
        $nac->update($data);
        // Guardamos en dataModel
        $this->control_data($nac, 'update');
        $result = new NacResource($nac);
        return $result;
    }

    public function delete($id)
    {
        $nac = Nac::findOrFail($id);
        $nac->delete();

        return response()->json(['message' => 'Se ha eliminado correctamente']);
    }
}
