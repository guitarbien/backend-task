<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class Todo
 * @package App\Http\Resources
 */
class Todo extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'title'      => $this->title,
            'content'    => $this->content,
            'attachment' => $this->attachment,
            'created_at' => $this->created_at,
            'done_at'    => $this->done_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
