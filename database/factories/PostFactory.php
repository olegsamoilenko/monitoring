<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'number' => $this->faker->unique()->numberBetween(1, 12),
          'direction_1' => 'На Лубни',
          'direction_2' => 'З Лубнів',
//          'direction_3' => 'direction_3',
//          'direction_4' => 'direction_4',
        ];
    }
}
