<?php

namespace App\Repositories;

use App\Models\Outcome;
use Illuminate\Support\Facades\DB;

class OutcomeRepository {
    public static function createInstance($pond_detail_id = null, $reported_at = null, $outcome_setting_id = null, $total_price = null, $name = null) {
        return new Outcome([
            'pond_detail_id'=>$pond_detail_id,
            'reported_at'=>$reported_at,
            'outcome_setting_id'=>$outcome_setting_id,
            'total_price'=>$total_price,
            'name'=>$name
        ]);
    }

    public static function getByReportedAtAndPondDetail($reported_at, $pond_detail_id) {
        return self::queryByReportedAtAndPondDetail($reported_at, $pond_detail_id)->get();
    }

    public static function sumCountByReportedAtAndPondDetail($reported_at, $pond_detail_id) {
        return self::queryByReportedAtAndPondDetail($reported_at, $pond_detail_id)->get()->sum('total_price');
    }

    public static function get(array $filter = []) {
        return self::queryGet($filter)->get();
    }

    public static function total(array $filter = []) {
        return self::queryGet($filter)->get()->sum('total_price');
    }

    private static function queryGet(array $filter = []) {
        return Outcome::when(@$filter['user_id'], function($q) use ($filter) {
            $q->whereHas('pond_detail.pond', function($query) use ($filter) {
                $query->where('user_id', $filter['user_id']);
            });
        })
        ->when(@$filter['pond_detail_id'], function($q) use ($filter) {
            $q->where('pond_detail_id', $filter['pond_detail_id']);
        })
        ->when(@$filter['reported_at'], function($q) use ($filter) {
            $q->whereDate('reported_at', $filter['reported_at']);
        })
        ->when(@$filter['outcome_setting_id'], function($q) use ($filter) {
            $q->where('outcome_setting_id', $filter['outcome_setting_id']);
        })
        ->distinct(['reported_at'])
        ->select()
        ->selectRaw("(select sum(o.total_price) from outcomes o where o.reported_at = outcomes.reported_at and o.pond_detail_id = outcomes.pond_detail_id) as total_price");
    }

    private static function queryByReportedAtAndPondDetail($reported_at, $pond_detail_id) {
        return Outcome::with('outcome_setting')
        ->whereDate('reported_at', $reported_at)
        ->where('pond_detail_id', $pond_detail_id)
        ->distinct(['outcome_setting_id'])
        ->select()
        ->selectRaw("(select sum(o.total_price) from outcomes o where o.reported_at = outcomes.reported_at and o.pond_detail_id = outcomes.pond_detail_id
        and o.outcome_setting_id = outcomes.outcome_setting_id) as total_price");
    }
}
        