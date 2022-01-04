<?php

namespace Database\Factories;

use App\Models\ArticleCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->text(35),
            'description'=>$this->faker->text(),
            'article_category_id'=>ArticleCategory::inRandomOrder()->first()->id,
            'image'=>'image/foo.jpg',
        ];
    }
}
