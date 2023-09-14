<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'company_id' => $this->id,
            'name' => $this->name,
            'owner' => $this->owner,
            'tax number' => $this->tax_number,
            'create at' => date_format(date_create($this->created_at),'y-m-d h:i:s a'),
            'branches' => $this->branch
        ];
    }
}
