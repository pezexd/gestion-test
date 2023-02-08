<?php

namespace App\Repositories;

use App\Models\CulturalEnsemble;
use App\Http\Resources\V1\CulturalEnsembleCollection;
use App\Http\Resources\V1\CulturalEnsembleResource;
use App\Traits\FunctionGeneralTrait;
use App\Traits\UserDataTrait;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class CulturalEmsembleRepository
{
    use FunctionGeneralTrait,UserDataTrait;

    public function getAll()
    {
        $results = new CulturalEnsembleCollection(CulturalEnsemble::orderBy('id', 'DESC')->get());
        return $results;
    }
    public function create($request)
    {   
        $CulturalEnsemble = CulturalEnsemble::create($request);
        $this->control_data($CulturalEnsemble,'store');
        $results = new CulturalEnsembleResource($CulturalEnsemble);
        return $results;
    }

    public function findById($id)
    {
        $CulturalEnsemble = CulturalEnsemble::findOrFail($id);
        $result = new CulturalEnsembleResource($CulturalEnsemble);
        return $result;
    }

    public function update($data, $id)
    {
        $CulturalEnsemble = CulturalEnsemble::findOrFail($id);
        $CulturalEnsemble->update($data);
        $this->control_data($CulturalEnsemble,'update');
        $result = new CulturalEnsembleResource($CulturalEnsemble);
        return $result;
    }

    public function delete($id)
    {
        $CulturalEnsemble = CulturalEnsemble::findOrFail($id);
        $CulturalEnsemble->delete();

        return response()->json(['message' => 'Se ha eliminado correctamente']);
    }
}
