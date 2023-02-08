<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class PsychosocialInstructionResource extends JsonResource
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
			'activity_date' => $this->activity_date,
			'consecutive' => $this->consecutive,
			'created_at' => $this->created_at,
			'development_activity_image' => $this->development_activity_image,
			'evidence_participation_image' => $this->evidence_participation_image,
			'final_hour' => $this->final_hour,
			'id' => $this->id,
			'nac_id' => $this->nac_id,
			'nac' => $this->nac,
			'objective_day' => $this->objective_day,
			'reject_message' => $this->reject_message,
			'start_time' => $this->start_time,
			'status' => $this->status,
			'themes_day' => $this->themes_day,
			'user_id' => $this->user_id,
			'assistants' => $this->assistants,
			'monitors' => $this->assistanceMonitors,
		];
	}
}
