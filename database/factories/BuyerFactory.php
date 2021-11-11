<?php

namespace Database\Factories;

use App\Models\PondDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class BuyerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pond_detail_id'=>PondDetail::inRandomOrder()->first()->id,
            'name'=>$this->faker->userName(),
            'phone'=>$this->faker->phoneNumber(),
            'status'=>'PENDING'
        ];
    }
}
