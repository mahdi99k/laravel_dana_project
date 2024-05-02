<?php

namespace App\Http\Resources\Data;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JournalResource extends JsonResource
{
    /**
     * Transf orm the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return [
//          "id" => (string) $this->id,
            "name" => $this->name,
            "cat" => $this->cat,
            "is_internal" => $this->is_internal,
            'employer' => $this->employer,
            'internal_rank' => $this->internal_rank,
            'internal_issn' => $this->internal_issn
        ];
    }
}
