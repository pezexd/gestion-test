<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class BinnacleTerritorieResource extends JsonResource
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
            'consecutive' => $this->consecutive,
            'nac'=>$this->nac,
            'roles' => $this->roles,
            'user' => $this->user,
            'activity_date' => $this->activity_date,
            'start_time' => $this->start_time,
            'final_hour' => $this->final_hour,
            'place' => $this->place,
            'strategic_objectives_area' => $this->strategic_objectives_area,
            'purpose_visit' => $this->purpose_visit,
            'topics_covered' => $this->topics_covered,
            'participants_perception' => $this->participants_perception,
            'problems_identified' => $this->problems_identified,
            'recommendations_actions' => $this->recommendations_actions,
            'comments_analysis' => $this->comments_analysis,
            'development_activity_image' => $this->development_activity_image,
            'evidence_participation_image' => $this->evidence_participation_image,
            'created_at' => $this->created_at,
            'status' => $this->status,
            'reject_message' => $this->reject_message,
            'created_by' => $this->created_user,
        ];
    }
}
