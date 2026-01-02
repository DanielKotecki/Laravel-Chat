<?php

namespace Database\Seeders;

use App\Models\AgeRange;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgeRangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ages = ["18-21", "22-29", "30-39", "40+"];
        foreach ($ages as $age) {
            AgeRange::create(['age_range' => $age]);
        }
    }
}
