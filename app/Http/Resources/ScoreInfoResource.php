<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScoreInfoResource extends JsonResource
{

    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'attributes' => [
                'cert' => $this->cert,
                'type' => $this->type,
                'filter' => $this->filter,
                'data' => $this->data,
                'created_at' => $this->created_at->format('Y-m-d H:i:s')
            ]
        ];


    }

}
