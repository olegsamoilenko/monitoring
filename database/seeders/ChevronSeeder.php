<?php

namespace Database\Seeders;

use App\Models\Chevron;
use Illuminate\Database\Seeder;

class ChevronSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $max = 31;

      for ($i = 1; $i <= $max; $i++) {
        Chevron::insert([
          'number' => $i,
        ]);
      }
    }
}
