<?php

namespace App\Http\Resources\V1;

use App\Models\EntityName;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EntityNameCollection extends ResourceCollection
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
            "last_page" => EntityName::latest()->paginate()->lastPage(),
            "success" => true,
            "action" => "Consulta entidades",
            'items'=>$this->collection,
            'meta'=>[
                'organization'=>'Arte y tecnologia',
                'authors'=>'Jefri Alexander'
            ],
            'type'=>'entity_names'
           ];
    }
}
