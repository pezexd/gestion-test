<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class MonthlyMonitoringReportsResource extends JsonResource
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
            'date' => $this->date,
            'file' => $this->file,
            'created_at' => $this->created_at,
            'status' => $this->status,
            'reject_message' => $this->reject_message,
        ];
    }
}
