<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class InscriptionsResource extends JsonResource
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
			'id'=>$this->id,
			'created_by'=>$this->created_by,
            'group_id'=>$this->benefiary->group_id,
            'group'=>$this->benefiary->group,
            'consecutive'=>$this->consecutive,
            'status'=>$this->status,
            'reject_message'=>$this->reject_message,
			'created_at' => $this->created_at,
            'apro_file1'=> $this->apro_file1,
            'apro_file2'=> $this->apro_file2,
			'benefiary'=> $this->benefiary ?? [],
            'attendant'=> $this->benefiary->attendant  ?? [],
            'sociodemographic_characterization_benefiary'=>$this->benefiary->socio_demo ?? [],
            'health_data_benefiary'=>$this->benefiary->health_data ?? [],
            'sociodemographic_characterization_attendant'=>$this->benefiary->attendant->socio_demo ?? [],
            'health_data_attendant'=>$this->benefiary->attendant->health_data ?? [],
		];
    }
}
