<?php

namespace App\Services;

use App\Models\Pond;
use App\Models\PondDetail;

class PondService {
    public static function create(Pond $pond, PondDetail $pond_detail) : Pond {
        $pond->save();
        $pond->refresh();
        $pond_detail->pond_id = $pond->id;
        $pond_detail->save();
        return $pond;
    }
}
        