<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ParentSchoolResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        [

            'id'=>$this->id,
            'consecutive'=>$this->consecutive,
            'date'=>$this->date,
            'monitor'=>$this->monitor,
            'start_time'=>$this->start_time,
            'final_time'=>$this->final_time,
            'place_attention'=>$this->place_attention,
            'added_wizards'=>$this->addedWizards,
            'contact'=>$this->contact,
            'objective'=>$this->objective,
            'development'=>$this->development,
            'conclusions'=>$this->conclusions,
            'development_activity_image'=>$this->development_activity_image,
            'evidence_participation_image'=>$this->evidence_participation_image,
            'status'=>$this->status,
            'audited'=>$this->audited,
            'reject_message'=>$this->reject_message,
            'created_at'=>$this->created_at,
            'assistance_monitors'=>$this->assistanceMonitors
        ];
    }
}
