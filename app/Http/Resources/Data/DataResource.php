<?php

namespace App\Http\Resources\Data;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DataResource extends JsonResource
{
    public function toArray(Request $request): array
    {

        return [
            "id" => (string) $this->id,
            "name" => $this->name
        ];

    }
}
