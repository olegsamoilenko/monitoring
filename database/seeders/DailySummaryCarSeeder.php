<?php

namespace Database\Seeders;

use App\Models\DailySummaryCar;
use Database\Factories\DailySummaryCarFactory;
use Illuminate\Database\Seeder;

class DailySummaryCarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DailySummaryCar::factory()->count(5)->create();
    }
}
