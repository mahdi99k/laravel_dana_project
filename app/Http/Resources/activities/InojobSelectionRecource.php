<?php

namespace App\Http\Resources\activities;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InojobSelectionRecource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            "id" => (string) $this->id,
            "attributes" => [
                "user_id" => (string) $this->user_id,
                "inojob_id" => (string) $this->inojob_id,
                "priority" => (string) $this->priority,
                "resume" => $this->resume,
                "employer" => $this->employer
            ]
        ];
    }
}
