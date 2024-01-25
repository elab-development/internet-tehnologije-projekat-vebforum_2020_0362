<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'text'=> $this->resource->text,
            'date'=>$this->resource->dateOfCreation,
            'likes'=> $this->resource->numberOfLikes,
            'dislikes'=> $this->resource->numberOfDislikes,
            'status'=> $this->resource->status,
            'user'=> (new UserResource(optional($this->resource->user)))->getName(),
            'thread'=> (new ThreadResource(optional($this->resource->thread)))->getName(),
            'comments'=> CommentResource::collection(optional($this->resource->comments))->toArray($request),
        ];
    }

    public function getName(): array
    {
        return [
            'NAME: ' => $this->resource->name,
        ];
    }
}
