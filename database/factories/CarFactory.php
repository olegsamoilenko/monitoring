<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker;

class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      $letters = $this->faker->randomLetter();
      $numbers = $this->faker->randomNumber(4, true);
        return [
          'post' => $this->faker->numberBetween(1, 11),
          'direction' => $this->faker->randomElement(['На Лубни', 'З Лубнів']),
//          'address' => $this->faker->randomElement(['Слави 43', 'Володимирський 56', 'Біля 3 школи']),
          'number' => $this->faker->randomElement(['АА', 'АК', 'АВ', 'АС', 'АН', 'АО', 'АТ', 'ВА', 'ВС', 'ВІ', 'АХ', 'СА', 'СН']) . $numbers . $this->faker->randomElement(['АА', 'АК', 'АВ', 'АС', 'АН', 'АО', 'АТ', 'ВА', 'ВС', 'ВІ', 'АХ', 'СА', 'СН']),
          'type' => $this->faker->randomElement(['moto', 'micro', 'sedan', 'hatchback', 'coupe', 'wagon', 'cuv', 'suv', 'pickup', 'minivan', 'van_1', 'van_2', 'bus', 'mini_truck', 'taxi']),
//          'type' => $this->faker->randomElement(['Мотоцикл', 'Мікро', 'Седан', 'Хетчбек', 'Купе', 'Універсал', 'Кросовер', 'Позашляховик', 'Пікап', 'Мінівен', 'Бус груз', 'Бус пас', 'автобус', 'Вантажівка', 'Таксі',]),
          'brand' => $this->faker->randomElement(['Acura', 'Alfa Romeo', 'Audi', 'BMW', 'Cadillac', 'Chery', 'Chevrolet', 'Chrysler', 'Citroen', 'Dacia', 'Daewoo', 'DAF', 'Dodge', 'Fiat', 'Ford',]),
          'model' => 'model',
          'color' => $this->faker->randomElement(['white', 'silver', 'gray', 'beige', 'olive', 'green', 'dark_green', 'light_blue', 'blue', 'dark_blue', 'red', 'cherry', 'dark_gray', 'black']),
//          'color' => $this->faker->randomElement(['Білий', 'Сріблястий', 'Сірий', 'Бежевий', 'Оливковий', 'Зелений', 'Темно зелений', 'Світло синій', 'Синій', 'Темно синій', 'Красний', 'Вишневий', 'Темно сірий', 'Чорний',]),
          'comment' => $this->faker->randomElement(['Агрессивно поводив себе', 'Підозрілі особи', '']),
          'user_id' => User::all()->random(),
          'created_at' => $this->faker->dateTimeBetween('-2 week', '+0 week')
        ];
    }

//  public function definition()
//  {
//    return [
//      'post' => $this->faker->numberBetween(1, 11),
//      'direction' => $this->faker->randomElement(['На Лубни', 'З Лубнів']),
//      'number' => 'ВІ0001ВІ',
//      'type' => 'coupe',
//      'brand' => 'BMW',
//      'model' => 'M5',
//      'color' => 'olive',
//      'comment' => $this->faker->text(100),
//      'user_id' => User::all()->random(),
//      'created_at' => $this->faker->dateTimeBetween('-2 week', '+0 week')
//    ];
//  }
}
