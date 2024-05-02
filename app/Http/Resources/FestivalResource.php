<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FestivalResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'festival_type_id' => $this->festival_type_id,
                'festival_level_id' => $this->festival_level_id,
            ]
        ];
    }
}
