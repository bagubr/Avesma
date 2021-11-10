<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PokdakanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->domainName(),
            'address'=>$this->faker->address(),
            'latitude'=>$this->faker->latitude(),
            'longitude'=>$this->faker->longitude(),
        ];
    }
}
