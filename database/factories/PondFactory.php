<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PondFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'=>User::inRandomOrder()->first(),
            'name'=>$this->faker->lastName(),
            'area'=>$this->faker->randomNumber(),
            'latitude'=>$this->faker->latitude(),
            'longitude'=>$this->faker->longitude(),
            'address'=>$this->faker->address(),
        ];
    }
}
