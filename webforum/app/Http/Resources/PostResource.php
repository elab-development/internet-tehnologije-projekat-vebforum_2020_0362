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
            'ID: ' => $this->resource->id,
            'POST NAME: ' => $this->resource->name,
            'TEXT: '=> $this->resource->text,
            'DATE OF CREATION: '=>$this->resource->dateOfCreation,
            'NUMBER OF 👍: '=> $this->resource->numberOfLikes,
            'NUMBER OF 👎: '=> $this->resource->numberOfDislikes,
            'STATUS OF THE POST: '=> $this->resource->status,
            'POST CREATED BY USER: '=> (new UserResource(optional($this->resource->user)))->getName(),
            'POST IS THE PART OF THE THREAD: '=> (new ThreadResource(optional($this->resource->thread)))->getName(),
            'COMMENTS ON THIS POST: '=> CommentResource::collection(optional($this->resource->comments))->toArray($request),
        ];
    }

    public function getName(): array
    {
        return [
            'NAME: ' => $this->resource->name,
        ];
    }
}
