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
            'USER ID: ' => $this->resource->id,
            'NAME: ' => $this->resource->name,
            'EMAIL: ' => $this->resource->email,
            'NUMBER OF CREATED THREADS: ' => count($this->resource->threads),
            'NUMBER OF CREATED POSTS: ' => count($this->resource->posts),
            'NUMBER OF COMMENTS: ' => count($this->resource->comments),
            'USER ROLE: ' => $this->resource->isAdmin
                ? 'This user is a webforum administrator.'
                : ($this->resource->isModerator
                    ? 'This user is a webforum moderator.'
                    : 'This user is a regular webforum user.'),
        ];
    }


    public function getName(): array
    {
        return [
            'NAME: ' => $this->resource->name,
        ];
    }

}
