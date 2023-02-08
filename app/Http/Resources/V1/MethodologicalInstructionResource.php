<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class MethodologicalInstructionResource extends JsonResource
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
            'place' => $this->place,
            'assistants'=>$this->assistants,
            'activity_date' => $this->activity_date,
            'start_time' => $this->start_time,
            'final_hour' => $this->final_hour,
            'expertise_id' => $this->expertise_id,
            'nac_id' => $this->nac_id,
            'created_by' => $this->created_by,
            'goals_met' => $this->goals_met,
            'explanation' => $this->explanation,
            'pedagogical_comments' => $this->pedagogical_comments,
            'technical_practical_comments' => $this->technical_practical_comments,
            'methodological_comments' => $this->methodological_comments,
            'others_observations' => $this->others_observations,
            'place_file1' => $this->place_file1,
            'place_file2' => $this->place_file2,
            'status' => $this->status,
            'consecutive' => $this->consecutive,
            'reject_message' => $this->reject_message,
            'assistants' => $this->assistants,
            'created_at' => $this->created_at
		];
    }
}
