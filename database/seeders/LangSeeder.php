<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            ['code' => 'pl', 'name' => 'Polish', 'main' => false],
            ['code' => 'en', 'name' => 'English', 'main' => true],
            ['code' => 'de', 'name' => 'German', 'main' => false],
            ['code' => 'fr', 'name' => 'French', 'main' => false],
            // Add more languages
        ];

        foreach ($languages as $language) {
            Language::create([
                'code' => $language['code'],
                'name' => $language['name'],
                'main' => $language['main'],
            ]);
        }
    }
}
