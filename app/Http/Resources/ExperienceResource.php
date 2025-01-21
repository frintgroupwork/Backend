<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExperienceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id, // Ensure ID is displayed first
            'experience_name' => $this->experience_name,
            'company' => $this->company,
            'position' => $this->position,
            'duration' => $this->duration,
            'student_id' => $this->student_id,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ];
    }
}
