<?php

namespace App\Http\Resources\V1;

use App\Models\Notification;
use Illuminate\Http\Resources\Json\ResourceCollection;

class NotificationCollection extends ResourceCollection
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
            "last_page" => Notification::latest()->paginate()->lastPage(),
            "success" => true,
            "action" => "Consulta de notificaciones",
            'items'=>$this->collection,
            'meta'=>[
                'organization'=>'Arte y tecnología',
                'authors'=>'Pezedev'
            ],
            'type'=>'Notification'
           ];
    }
}
