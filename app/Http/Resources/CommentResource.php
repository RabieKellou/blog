<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return [
        //     'id' => $this->id,
        //     'content' => $this->content,
        //     'comment_date' => $this->updated_at,
        //     'user' => new CommentUserResource($this->user)
        // ];

        // return the comment  with user only if the comment has a user associated with it
        return [
            'id' => $this->id,
            'content' => $this->content,
            'comment_date' => $this->updated_at,
            'user' => new CommentUserResource($this->whenLoaded('user'))
        ];
        // return parent::toArray($request);
    }
}
