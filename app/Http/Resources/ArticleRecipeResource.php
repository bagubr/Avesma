<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleRecipeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "image_url" => $this->image_url,
            "type" => $this->type,
            "embed_link" => $this->embed_link ?? '',
            "file" => $this->file ?? '',
            "created_at" => $this->created_at,
        ];    
    }
}
