<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'text'=> $this->resource->text,
            'date'=>$this->resource->dateOfCreation,
            'likes'=> $this->resource->numberOfLikes,
            'dislikes'=> $this->resource->numberOfDislikes,
            'user'=> (new UserResource(optional($this->resource->user)))->getName(),
            'post'=> (new PostResource(optional($this->resource->post)))->getName(),
        ];
    }
}
