<?php

namespace Database\Factories;

use App\Models\Procedure;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleProcedureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'procedure_id'=>Procedure::inRandomOrder()->first()->id,
            'title'=>$this->faker->domainName(),
            'description'=>$this->faker->text(),
            'image'=>'image/foo.jpg',
            'file'=>'image/foo.jpg',
            'type'=>'FILE',
        ];
    }
}
