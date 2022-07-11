<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DailySummaryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'text' => "Вносити переміщення нив, джипів. <br> Перевіряти всі червоні дев'ятки. ",
        ];
    }
}
