<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name'=>$this->name,
            'email'=>$this->email,
            'roles' => $this->roles,
            'status'=>$this->status,
            'created_at'=> $this->created_at,
            'profile'=>$this->profile,
            'psychosocial'=>$this->profile->psychosocial,
            'gestor'=>$this->profile->gestor,
            'methodological_support'=>$this->profile->methodological_support,
            'support_tracing_monitoring'=>$this->profile->support_tracing_monitoring,
            'instructor_leader'=>$this->profile->instructor_leader,
            'ambassador_leader'=>$this->profile->ambassador_leader
        ];
    }
}
