<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            "id" => $this->id,
            "phone" => $this->phone,
            "username" => $this->username,
            "about" => $this->about,
            "bio" => $this->bio,
            "birthday" => $this->birthday,
            "count" => $this->count,
            "email" => $this->email,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "image" => $this->image,
            "inojob" => $this->inojob,
            "job" => $this->job,
            "melli" => $this->melli,
            "more" => $this->more,
            "password" => $this->password?true:false,
            "accounts" => $this->accounts,
            "score" => $this->score,
            "social" => $this->social,
            "status" => $this->status,
            "InojobReviews" => $this->inojobReviews
        ];
    }
}
