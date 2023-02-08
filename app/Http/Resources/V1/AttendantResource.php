<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class AttendantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    // (property) form_accudent: {
    //     full_name: string;
    //     relationship: string;
    //     type_document: string;
    //     document_number: string;
    //     zone: string;
    //     phone: string;
    //     email: string;
    // }
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'relationship' => $this->relationship,
            'type_document' => $this->type_document,
            'document_number' => $this->document_number,
            'zone' => $this->zone,
            'phone' => $this->phone,
            'email' => $this->email,
        ];
    }
}
