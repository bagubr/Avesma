<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleRecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->lastName(), 
            'description'=>$this->faker->text(), 
            'image'=>'image/foo.jpg'
        ];
    }
}
