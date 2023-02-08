<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class BeneficiaryResource extends JsonResource
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
            'nac_id'=> $this->nac_id,
            'neighborhood_id'=> $this->neighborhood_id,
            'user_id'=>$this->user_id,
            'full_name'=> $this->full_name,
            'referrer_name'=> $this->referrer_name,
            'institution_entity_referred'=> $this->institution_entity_referred,
            'accept'=> $this->accept,
            'linkage_project'=> $this->linkage_project,
            'participant_type'=> $this->participant_type,
            'type_document'=> $this->type_document,
            'document_number'=> $this->document_number,
            'neighborhood_new'=> $this->neighborhood_new,
            'zone'=> $this->zone,
            'stratum'=> $this->stratum,
            'phone'=> $this->phone,
            'email'=> $this->email,
            'file'=> $this->file,
            'status'=> $this->status,
            'reject_message'=> $this->reject_message,
        ];
    }
}
