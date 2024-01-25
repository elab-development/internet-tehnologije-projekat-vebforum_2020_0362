<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email' => $this->resource->email,
            'threads' => count($this->resource->threads),
            'posts' => count($this->resource->posts),
            'comments' => count($this->resource->comments),
            'user_role' => $this->resource->isAdmin
                ? 'admin'
                : ($this->resource->isModerator
                    ? 'moderator'
                    : 'user'),
        ];
    }


    public function getName(): array
    {
        return [
            'name' => $this->resource->name,
        ];
    }

}
