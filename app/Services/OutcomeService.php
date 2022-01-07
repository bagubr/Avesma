<?php

namespace App\Services;

use App\Models\Outcome;

class OutcomeService {
    public static function create($reported_at, $pond_detail_id, $data) {
        $outcomes = [];
        foreach($data as $value) {
            $outcomes[] = Outcome::create(array_merge([
                'reported_at'=>$reported_at,
                'pond_detail_id'=>$pond_detail_id
            ], $value));
        }

        return $outcomes;
    }
}
        