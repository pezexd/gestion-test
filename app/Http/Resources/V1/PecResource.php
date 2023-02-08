<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class PecResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'created_by' => $this->created_by,
            'consecutive' => $this->consecutive,
            'nac'=> $this->nac,
            'nac_id'=> $this->nac_id,
            'beneficiaries'=>$this->pecsBeneficiaries,
            'neighborhood'=> $this->neighborhood,
            'neighborhood_id'=> $this->neighborhood_id,
            'place'=> $this->place,
            'place_address'=> $this->place_address,
            'other_place_type'=> $this->other_place_type,
            'activity_date'=> $this->get_activity_date(),
            'start_time'=> $this->start_time,
            'final_hour'=> $this->final_hour,
            'place_type'=> $this->place_type,
            'place_description'=> $this->place_description,
            'place_image1'=> $this->place_image1,
            'place_image2'=> $this->place_image2,
            'status'=> $this->status,
            'reject_message'=> $this->reject_message,
            'created_at' => $this->created_at
        ];
    }
}
