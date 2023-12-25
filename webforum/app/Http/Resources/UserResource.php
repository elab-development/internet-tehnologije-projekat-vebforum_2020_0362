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
        $data = [
            'USER ID: ' => $this->resource->id,
            'NAME: ' => $this->resource->name,
            'EMAIL: ' => $this->resource->email,
            'NUMBER OF CREATED THREADS: '=>count($this->resource->threads),
            'NUMBER OF CREATED POSTS: '=>count($this->resource->posts),
            'NUMBER OF COMMENTS: '=>count($this->resource->comments),
        ];

        if ($this->resource->isAdmin) {
            $data['USER ROLE: '] = 'This user is an webforum administrator.';
        }

        if ($this->resource->isModerator) {
            $data['USER ROLE: '] = 'This user is an webforum moderator.';
        }

        if (!($this->resource->isAdmin) && !($this->resource->isModerator)) {
            $data['USER ROLE: '] = 'This user is a regular webforum user.';
        }
        
    }
}
