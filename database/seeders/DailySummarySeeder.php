<?php

namespace Database\Seeders;

use App\Models\DailySummary;
use Illuminate\Database\Seeder;

class DailySummarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DailySummary::factory()->create();
    }
}
