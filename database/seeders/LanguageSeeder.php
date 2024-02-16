<?php

namespace Database\Seeders;

use App\Model\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $english = Language::where('language_code', 'en')->first();
        if (!$english) {
            Language::create([
                'name' => 'English',
                'language_code' => 'en',
            ]);
        }
        $japanese = Language::where('language_code', 'ja')->first();
        if (!$japanese) {
            Language::create([
                'name' => 'Japanese',
                'language_code' => 'ja',
            ]);
        }
    }
}
