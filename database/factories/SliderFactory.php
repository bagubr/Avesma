<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SliderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->domainWord(),
            'description'=>$this->faker->text(),
            'image'=>'image/foo.jpg',
            'type'=>'ARTICLE'
        ];
    }
}
