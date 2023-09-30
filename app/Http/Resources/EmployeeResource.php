<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->user,
            'job title' => $this->job_title,
            'salary' => $this->salary,
            'hire date' => date_format(date_create($this->hire_date),'y-m-d h:i:s a'),
        ];
    }
}
