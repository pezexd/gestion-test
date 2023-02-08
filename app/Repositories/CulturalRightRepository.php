<?php

namespace App\Repositories;

use App\Models\CulturalRight;
use App\Http\Resources\V1\CulturalRightCollection;
use App\Http\Resources\V1\CulturalRightResource;
use App\Traits\FunctionGeneralTrait;
use App\Traits\UserDataTrait;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class CulturalRightRepository
{
    use FunctionGeneralTrait,UserDataTrait;

    public function getAll()
    {
        $results = new CulturalRightCollection(CulturalRight::orderBy('id', 'DESC')->get());
        return $results;
    }
    public function create($request)
    {
        $culturalRight = CulturalRight::create($request);
        $this->control_data($culturalRight,'store');
        $results = new CulturalRightResource($culturalRight);
        return $results;
    }

    public function findById($id)
    {
        $culturalRight = CulturalRight::findOrFail($id);
        $result = new CulturalRightResource($culturalRight);
        return $result;
    }

    public function update($data, $id)
    {
        $culturalRight = CulturalRight::findOrFail($id);
        $culturalRight->update($data);
        $this->control_data($culturalRight,'update');
        $result = new CulturalRightResource($culturalRight);
        return $result;
    }

    public function delete($id)
    {
        $culturalRight = CulturalRight::findOrFail($id);
        $culturalRight->delete();

        return response()->json(['message' => 'Se ha eliminado correctamente']);
    }
}
