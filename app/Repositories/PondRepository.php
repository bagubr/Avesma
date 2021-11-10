<?php

namespace App\Repositories;

use App\Models\Pond;
use Illuminate\Database\Eloquent\Collection;

class PondRepository {
    public static function get($user_id, $name, $fish_species_name) : Collection {
        return Pond::with('pond_detail.fish_species')->when($user_id, function($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })
        ->when($name, function($query) use ($name) {
            $query->where('name', 'ilike', '%'.$name.'%');
        })
        ->when($fish_species_name, function($query) use ($fish_species_name) {
            $query->whereHas('pond_detail', function($q) use ($fish_species_name) {
                $q->where('name', 'ilike', "%$fish_species_name%");
            }); 
        })
        ->get();
    }

    public static function createModel($user_id=null,$name=null,$area=null,$latitude=null,$longitude=null,$address=null,$status='TEST') : Pond {
        return new Pond([
            'user_id'=>$user_id,
            'name'=>$name,
            'area'=>$area,
            'latitude'=>$latitude,
            'longitude'=>$longitude,
            'address'=>$address,
            'status'=>$status
        ]);
    }
}
        