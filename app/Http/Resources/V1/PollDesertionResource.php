<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class PollDesertionResource extends JsonResource
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
            'beneficiary' => $this->beneficiary,
            'beneficiary_id' => $this->beneficiary_id,
            'date' => $this->date,
            'nac' => $this->nac,
            'nac_id' => $this->nac_id,
            'beneficiary_attrition_factors' => $this->beneficiary_attrition_factors,
            'beneficiary_attrition_factor_other' => $this->beneficiary_attrition_factor_other ?? '',
            'disinterest_apathy' => $this->disinterest_apathy,
            'disinterest_apathy_explanation' => $this->disinterest_apathy_explanation,
            'reintegration' => $this->reintegration,
            'reintegration_explanation' => $this->reintegration_explanation,
            'created_at' => $this->created_at,
            'user_id' => $this->user_id,
            'user' => $this->user
        ];
    }
}
