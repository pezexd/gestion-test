<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
class PollResource extends JsonResource
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
			'gender'=>$this->gender,
            'age'=>$this->age,
			'birth_date'=>$this->birth_date,
            'marital_state'=>$this->marital_state,
            'stratum'=>$this->stratum,
			'neighborhood'=>$this->neighborhood,
            'neighborhood_id'=>$this->neighborhood_id,
            'other_neighborhoods'=>$this->other_neighborhoods ?? "",
			'phone'=>$this->phone,
            'email'=>$this->email,
			'number_children'=>$this->number_children,
            'dependents' =>$this->dependents,
			'relationship_head_household'=>$this->relationship_head_household,
            'ethnicity'=>$this->ethnicity,
            'victim_armed_conflict'=>$this->victim_armed_conflict,
            'single_registry_victims'=>$this->single_registry_victims,
            'study'=>$this->study,
            'educational_level'=>$this->educational_level,
            'medical_service'=>$this->medical_service,
            'entity_name'=>$this->entity_name,
            'entity_name_id'=>$this->entity_name_id,
            'health_condition'=>$this->health_condition,
            'takes_medication'=>$this->takes_medication,
            'suffers_disease'=>$this->suffers_disease,
            'type_disease'=>$this->type_disease,
            'other_disease_type'=>$this->other_disease_type,
            'disability'=>$this->disability,
            'disability_type'=>$this->disability_type,
            'other_disability_type' => $this->other_disability_type,
            'assessed_disability'=>$this->assessed_disability,
            'receives_therapy'=>$this->receives_therapy,
            'expertises'=>$this->expertises,
            'artistic_experience'=>$this->artistic_experience,
            'artistic_group'=>$this->artistic_group,
            'artistic_group_name'=>$this->artistic_group_name,
            'role_artistic_group'=>$this->role_artistic_group,
            'user_id'=>$this->user_id,
            'created_at'=>Carbon::parse($this->create_at)->format('Y-m-d')
		];
    }
}
