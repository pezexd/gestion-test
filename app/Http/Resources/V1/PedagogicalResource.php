<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class PedagogicalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
			'id'=>$this->id,
            'created_by'=>$this->created_by,
			'consecutive'=>$this->consecutive,
            'activity_name'=>$this->activity_name,
            'activity_date'=>$this->get_activity_date(),
			'user_id'=>$this->created_by,
            'monitor'=>$this->monitor,
            // 'monitor_id'=>$this->monitor_id,
            'user'=>$this->user,
            'cultural_right_id'=>$this->cultural_right_id,
            'cultural_right'=>$this->cultural_right,
			'nac_id'=>$this->nac_id,
            'nac'=>$this->nac,
			'expertise_id'=>$this->expertise_id,
            'expertise'=>$this->expertise,
            'experiential_objective'=>$this->experiential_objective,
			'lineament_id'=>$this->lineament_id,
            'orientation_id'=>$this->orientation_id,
            'orientation'=>$this->orientacion,
			'manifestation'=>$this->manifestation,
            'process'=>$this->process,
			'product'=>$this->product,
            'resources' =>$this->resources,
            'status'=>$this->status,
            'reject_message'=>$this->reject_message,
			'created_at'=>$this->created_at,
		];
    }
}
