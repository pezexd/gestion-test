<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\CulturalEnsemble;

class CulturalEnsembleCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "last_page" => CulturalEnsemble::latest()->paginate()->lastPage(),
            "success" => true,
            "action" => "Consulta ensamble cultural",
            'items'=>$this->collection,
            'meta'=>[
                'organization'=>'Arte y tecnologia',
                'authors'=>'Jean Pool Ramirez'
            ],
            'type'=>'cultural_ensemble'
           ];
    }
}
