<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Factories\Sequence;
use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Car::factory()
        ->count(10)
        ->state(new Sequence(
          function ($sequence) {
            return ['user_id' => User::all()->random()];
          },
        ))
        ->create();
    }
}
