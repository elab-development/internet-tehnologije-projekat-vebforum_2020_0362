<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ThreadResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'description'=> $this->resource->description,
            'date'=>$this->resource->dateOfCreation,
            'user'=> (new UserResource(optional($this->resource->user)))->getName(),
        ];
    }

    public function getName(): array
    {
        return [
            'name' => $this->resource->name,
        ];
    }
}
