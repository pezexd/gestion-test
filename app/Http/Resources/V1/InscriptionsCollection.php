<?php

namespace App\Http\Resources\V1;

use App\Models\Inscriptions\Inscription;
use Illuminate\Http\Resources\Json\ResourceCollection;

class InscriptionsCollection extends ResourceCollection
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
            // "last_page" => Inscription::latest()->paginate()->lastPage(),
            "success" => true,
            "action" => "Consulta inscripciones",
            'items'=>$this->collection,
            'meta'=>[
                'organization'=>'Arte y tecnologia',
                'authors'=>'Jefri Alexander'
            ],
            'type'=>'dialogue_tables'
           ];
    }
}
