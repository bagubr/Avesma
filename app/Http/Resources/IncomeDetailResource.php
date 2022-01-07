<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IncomeDetailResource extends JsonResource
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
            'pond_detail_product_id' => $this->pond_detail_product_id,
            'product_name' => $this->pond_detail_products->name,
            'weight' => $this->weight,
            'price' => $this->price,
            'total_price' => $this->total_price,
        ];
    }
}
