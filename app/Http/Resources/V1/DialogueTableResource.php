<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class DialogueTableResource extends JsonResource
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
            'user_id'=>$this->user_id,
            'activity_date'=>$this->activity_date,
            'start_time'=>$this->start_time,
            'final_hour'=>$this->final_hour,
            'nac'=>$this->nac,
            'target_workday'=>$this->target_workday,
            'theme'=>$this->theme,
            'schedule_day'=>$this->schedule_day,
            'workday_description'=>$this->workday_description,
            'achievements_difficulties'=>$this->achievements_difficulties,
            'alerts'=>$this->alerts,
            'place_image1'=>$this->place_image1,
            'place_image2'=>$this->place_image2,
            'consecutive'=>$this->consecutive,
            'status'=>$this->status,
            'reject_message'=>$this->reject_message,
            'assistants'=>$this->assistant,
            'created_at' => $this->created_at,
            'user'=>$this->user,
            'manager'=>$this->manager,
            'method_support'=>$this->method_support
		];
    }
}
