<?php

namespace App\Http\Resources\V1;

use App\Models\Module;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ModuleCollection extends ResourceCollection
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
            "success" => true,
            "action" => "Consulta Module",
            'items'=>$this->collection,
            'meta'=>[
                'organization'=>'Module',
                'authors'=>'Jefri'
            ],
            'type'=>'modules'
           ];
    }
}
