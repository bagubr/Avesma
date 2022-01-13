<?php

namespace Database\Factories;

use App\Models\FishSpecies;
use App\Models\Pond;
use Illuminate\Database\Eloquent\Factories\Factory;

class PondDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pond_id'=>Pond::inRandomOrder()->first()->id,
            'fish_species_id'=>FishSpecies::inRandomOrder()->first()->id,
            'seed_count'=>$this->faker->randomNumber(),
            'seed_size'=>$this->faker->randomFloat(),
            'feed_type'=>$this->faker->randomLetter(),
        ];
    }
}
