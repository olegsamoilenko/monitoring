<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DailySummaryCarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

      $numbers = $this->faker->randomNumber(4, true);
      return [
        'number' => $this->faker->randomElement(['АА', 'АК', 'АВ', 'АС', 'АН', 'АО', 'АТ', 'ВА', 'ВС', 'ВІ', 'АХ', 'СА', 'СН']) . $numbers . $this->faker->randomElement(['АА', 'АК', 'АВ', 'АС', 'АН', 'АО', 'АТ', 'ВА', 'ВС', 'ВІ', 'АХ', 'СА', 'СН']),
        'type' => $this->faker->randomElement(['moto', 'micro', 'sedan', 'hatchback', 'coupe', 'wagon', 'cuv', 'suv', 'pickup', 'minivan', 'van_1', 'van_2', 'bus', 'mini_truck', 'taxi']),
//          'type' => $this->faker->randomElement(['Мотоцикл', 'Мікро', 'Седан', 'Хетчбек', 'Купе', 'Універсал', 'Кросовер', 'Позашляховик', 'Пікап', 'Мінівен', 'Бус груз', 'Бус пас', 'автобус', 'Вантажівка', 'Таксі',]),
        'brand' => $this->faker->randomElement(['Acura', 'Alfa Romeo', 'Audi', 'BMW', 'Cadillac', 'Chery', 'Chevrolet', 'Chrysler', 'Citroen', 'Dacia', 'Daewoo', 'DAF', 'Dodge', 'Fiat', 'Ford',]),
        'model' => 'model',
        'color' => $this->faker->randomElement(['white', 'silver', 'gray', 'beige', 'olive', 'green', 'dark_green', 'light_blue', 'blue', 'dark_blue', 'red', 'cherry', 'dark_gray', 'black']),
//          'color' => $this->faker->randomElement(['Білий', 'Сріблястий', 'Сірий', 'Бежевий', 'Оливковий', 'Зелений', 'Темно зелений', 'Світло синій', 'Синій', 'Темно синій', 'Красний', 'Вишневий', 'Темно сірий', 'Чорний',]),
        'comment' => $this->faker->randomElement(['Повний обшук', 'Затримати, визвати опер групу', 'Фіксувати переміщення']),
        'created_at' => $this->faker->dateTimeBetween('-2 week', '+0 week')
      ];
    }
}
