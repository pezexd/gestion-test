<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PermissionCollection extends ResourceCollection
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
            "action" => "Consulta Permisos",
            'items'=>$this->collection,
            'meta'=>[
                'organization'=>'Permission',
                'authors'=>'Jefri'
            ],
            'type'=>'permission'
           ];
    }
}
