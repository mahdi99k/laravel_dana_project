<?php

namespace App\Http\Resources\activities;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InojobResource extends JsonResource
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
            "id"=> (string) $this->id,
            "attributes" => [
                "title" => $this->title,
                "employer" => $this->employer,
                "emp" => $this->emp,
                "status" => $this->status,
                "description" => $this->description,
                "image" => $this->image,
                "location" => $this->location,
                "degree" => $this->degree,
                "pin" => $this->pin,
                "major" => $this->major,
                "date" => $this->date,
                "count" => $this->count,
                "facilities" => $this->facilities,
                "properties" => $this->properties,
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at
            ]
        ];
    }
}
