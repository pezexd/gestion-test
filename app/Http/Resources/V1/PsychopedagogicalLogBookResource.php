<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class PsychopedagogicalLogBookResource extends JsonResource
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
			'consecutive' => $this->consecutive,
            'date'=>Carbon::parse($this->date)->format('Y-m-d'),
			'nac' => $this->nac,
			'nac_id' => $this->nac_id,
            'start_time' => $this->start_time,
			'final_time' => $this->final_time,
            'assistants'=>$this->addedWizards,
            'person_served_name'=>$this->person_served_name,
            'monitor_id'=>$this->monitor_id,
            'objective'=>$this->objective,
            'development'=>$this->development,
            'referrals'=>$this->referrals,
            'conclusions_reflections_commitments'=>$this->conclusions_reflections_commitments,
            'alert_reporting_tracking'=>$this->alert_reporting_tracking,
            'development_activity_image'=>$this->development_activity_image,
            'evidence_participation_image'=>$this->evidence_participation_image,
			'status' => $this->status,
            'reject_message'=>$this->reject_message,
            'created_at' => $this->created_at,
            'user_psychoso_coordinator_id'=>$this->user_psychoso_coordinator_id,
            'user_id'=>$this->user_id,
            'monitors'=>$this->assistanceMonitors,

		];
    }
}
