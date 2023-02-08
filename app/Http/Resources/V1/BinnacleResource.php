<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class BinnacleResource extends JsonResource
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
            'nac_id' => $this->nac_id,
            'expertise_id' => $this->expertise_id,
            'orientation_id' => $this->orientation_id,
            'cultural_right_id' => $this->cultural_right_id,
            'pec_id' => $this->pec_id,
            'pedagogical_id' => $this->pedagogical_id,
            'binnacle_id' => $this->binnacle_id,
            'lineament_id' => $this->lineament_id,
            'activation_mode' => $this->activation_mode,
            'goals_met' => $this->goals_met,
            'start_time' => $this->start_time,
            'final_hour' => $this->final_hour,
            'activity_name' => $this->activity_name,
            'start_activity' => $this->start_activity,
            'activity_development' => $this->activity_development,
            'end_of_activity' => $this->end_of_activity,
            'observations_activity' => $this->observations_activity,
            'place' => $this->place,
            'experiential_objective' => $this->experiential_objective,
            'explain_goals_met' => $this->explain_goals_met,
            'development_activity_image' => $this->development_activity_image,
            'evidence_participation_image' => $this->evidence_participation_image,
            'activity_date' => $this->activity_date,
            'status' => $this->status,
            'reject_message' => $this->reject_message,
            'beneficiaries_capacity' => $this->beneficiaries_capacity,
            'aforo_file' => $this->aforo_file,
            'assistants' => $this->beneficiaries,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'beneficiaries_or_capacity'=>$this->beneficiaries_or_capacity
            //   'user_review_manager_cultural_id',
            //     'user_review_support_follow_id',
            //       'user_review_instructor_leader_id',  'user_method_support_id'
        ];
    }
}
