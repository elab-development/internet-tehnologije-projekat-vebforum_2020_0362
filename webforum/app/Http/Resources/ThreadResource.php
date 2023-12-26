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
            'ID: ' => $this->resource->id,
            'THREAD NAME: ' => $this->resource->name,
            'DESCRIPTION: '=> $this->resource->description,
            'DATE OF CREATION: '=>$this->resource->dateOfCreation,
            'THREAD CREATED BY USER: '=> (new UserResource(optional($this->resource->user)))->getName(),
        ];
    }

    public function getName(): array
    {
        return [
            'NAME: ' => $this->resource->name,
        ];
    }
}
