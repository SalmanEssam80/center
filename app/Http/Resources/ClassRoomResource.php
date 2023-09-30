<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassRoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'class_id' => $this->id,
            'name' => $this->name,
            'configration' => $this->configration,
            'capacity' => $this->capacity,
            'branch' => $this->branch_id,
            'create at' => date_format(date_create($this->created_at),'y-m-d h:i:s a'),
            'update at' => date_format(date_create($this->updated_at),'y-m-d h:i:s a'),
        ];
    }
}
