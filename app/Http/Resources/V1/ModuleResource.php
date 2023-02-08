<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ModuleResource extends JsonResource
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
			'name '=>$this->name,
            'slug'=>$this->slug,
            'description'=>$this->description,
            'icon'=>$this->icon,
            'available'=>$this->available,
            'hasItems'=>$this->hasItems,
            'position'=>$this->position
		];
    }
}
