<?php

namespace App\Http\Resources\Data;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PublisherResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'max_score' => $this->max_score
        ];
    }

}
