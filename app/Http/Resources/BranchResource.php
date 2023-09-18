<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BranchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'Branch_id' => $this->id,
            'name' => $this->name,
            'location' => $this->location,
            'company_id' => $this->company_id,
            'created_at' => date_format(date_create($this->created_at),'y-m-d h:i:s a'),
            'updated_at' => date_format(date_create($this->updated_at),'y-m-d h:i:s a'),
        ];
    }
}
