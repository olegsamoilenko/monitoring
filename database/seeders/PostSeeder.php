<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $max = 10;

      for ($i = 1; $i <= $max; $i++) {
        Post::insert([
          'number' => $i,
          'direction_1' => 'На Лубни',
          'direction_2' => 'З Лубнів',
//          'direction_3' => 'direction_3',
//          'direction_4' => 'direction_4',
        ]);
      }

    }
}
