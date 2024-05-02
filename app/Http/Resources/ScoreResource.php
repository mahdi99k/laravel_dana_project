<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScoreResource extends JsonResource
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
            "id" => (string) $this->id,
            "attributes" => [
                'cert' => $this->cert,
                'type' => $this->type,
                'data' =>  $this->data,
                'filter' => $this->filter,
                'file1' => $this->file1,
                'file2' => $this->file2,
                'status' => $this->status,
                'cantBook' => $this->cantBook,
                'cantArticle' => $this->cantArticle,
            ]
        ];
    }
}
