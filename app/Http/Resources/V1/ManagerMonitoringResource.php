<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ManagerMonitoringResource extends JsonResource
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
			'created_at'=>$this->created_at,
			'cultural_guidelines'=>$this->cultural_guidelines,
			'difficulty_cultural_process'=>$this->difficulty_cultural_process,
			'id'=>$this->id,
			'monitor_id'=>$this->monitor_id,
			'nac_id'=>$this->nac_id,
			'start_time'=>$this->start_time,
			// 'tutorial_name'=>$this->tutorial_name,
            'activity_date'=>$this->activity_date,
            'consecutive'=>$this->consecutive,
            'cultural_communication'=>$this->cultural_communication,
            'cultural_process'=>$this->cultural_process,
            'final_hour'=>$this->final_hour,
            'nac'=>$this->nac,
            'proposal_improvement'=>$this->proposal_improvement,
            'reject_message'=>$this->reject_message,
            'status'=>$this->status,
            'target_tracking'=>$this->target_tracking,
            'user_id'=>$this->user_id,
            'user'=>$this->user ?? "",
		];
    }
}
