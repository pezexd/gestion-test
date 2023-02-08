<?php

namespace App\Http\Resources\V1;

use App\Models\DialogueTables\DialogueTable;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DialogueTableCollection extends ResourceCollection
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
            "action" => "Consulta mesa dialogo",
            'items'=>$this->collection,
            'meta'=>[
                'organization'=>'Arte y tecnologia',
                'authors'=>'Jorge Lavao'
            ],
            'type'=>'dialogue_tables'
           ];
    }
}
