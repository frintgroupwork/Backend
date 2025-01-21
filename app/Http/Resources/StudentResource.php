<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'birthday' => $this->birthday,
            'gender' => $this->gender,
            'email' => $this->email,
            'address' => $this->address,
            'phonenumber' => $this->phonenumber,
            'university' => $this->university,
            'degree' => $this->degree,
            'year' => $this->year,
            'major' => $this->major,
            'experiences' => ExperienceResource::collection($this->experiences), // Add this line

        ];
    }
}
