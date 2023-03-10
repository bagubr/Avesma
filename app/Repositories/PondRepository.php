<?php

namespace App\Repositories;

use App\Http\Resources\PondResource;
use App\Models\Pond;
use Illuminate\Database\Eloquent\Collection;
use ReflectionClass;

class PondRepository
{
    public static function get(array $filter = [])
    {
        return PondResource::collection(self::queryGet($filter)->get());
    }

    public static function find($id)
    {
        return self::queryGet([
            'id' => $id
        ])->first();
    }

    private static function queryGet(array $filter = [])
    {
        return Pond::with('pond_detail.fish_species.fish_category')
            ->when(@$filter['user_id'], function ($query) use ($filter) {
                $query->where('user_id', $filter['user_id']);
            })
            ->when(@$filter['name'], function ($query) use ($filter) {
                $query->where('name', 'ilike', '%' . $filter['name'] . '%');
            })
            ->when(@$filter['fish_species_id'], function ($query) use ($filter) {
                $query->whereHas('pond_detail', function ($q) use ($filter) {
                    $q->where('id', $filter['fish_species_id']);
                });
            })
            ->when(@$filter['id'], function ($query) use ($filter) {
                $query->where('id', $filter['id']);
            });
    }

    public static function createModel($user_id = null, $description = null, $name = null, $area = null, $latitude = null, $longitude = null, $address = null, $cycle_id = null): Pond
    {
        return new Pond([
            'user_id' => $user_id,
            'cycle_id' => $cycle_id,
            'name' => $name,
            'area' => $area,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'address' => $address,
            'status' => Pond::STATUS1,
            'description' => $description
        ]);
    }

    public static function getStatuses()
    {
        $filter = array_filter((new ReflectionClass(Pond::class))->getConstants(), function ($i, $x) {
            if (str_contains($x, "STATUS")) return true;
        }, ARRAY_FILTER_USE_BOTH);
        $filter = array_values($filter);
        return $filter;
    }
}
