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
            'ID: ' => $this->resource->id,
            'COMMENT TEXT: '=> $this->resource->text,
            'DATE OF CREATION: '=>$this->resource->dateOfCreation,
            'NUMBER OF 👍: '=> $this->resource->numberOfLikes,
            'NUMBER OF 👎: '=> $this->resource->numberOfDislikes,
            'COMMENT CREATED BY USER: '=> (new UserResource(optional($this->resource->user)))->getName(),
            'COMMENT IS PART OF THIS POST: '=> (new PostResource(optional($this->resource->post)))->getName(),
        ];
    }
}
