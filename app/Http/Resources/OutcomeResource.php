<?php

namespace App\Http\Resources;

use App\Models\Outcome;
use Illuminate\Http\Resources\Json\JsonResource;

class OutcomeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request`  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            "outcome_category_id" => $this->outcome_detail[0]?->outcome_setting->outcome_category_id,
            "outcome_category_name" => $this->outcome_detail[0]?->outcome_setting->outcome_category,
            "pond_detail_id" => $this->pond_detail_id,
            "pond_detail_name" => $this->pond_detail->pond->name,
            "total_nominal" => $this->getTotalNominal($this->pond_detail_id),
            "reported_at" => $this->reported_at,
            "outcome_detail" => OutcomeDetailResource::collection($this->outcome_detail)
        ];
    }
    public function getTotalNominal($pond_detail_id)
    {
        $outcome_tetap = Outcome::where('pond_detail_id', $pond_detail_id)
            ->whereHas('outcome_detail.outcome_setting', function ($sq) {
                $sq->where('outcome_category_id', 1);
            })->orderBy('id', 'desc')->first();
        return $outcome_tetap;
    }
}
