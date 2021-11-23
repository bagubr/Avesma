<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            "article_category_id" =>  $this->article_category_id,
            "category_name" => $this->category_name,
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
