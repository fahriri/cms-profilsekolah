<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\School;
use App\Models\Section;

class SectionSeeder extends Seeder
{
    public function run(): void
    {
        $defaultSections = [
            ['name' => 'Banner', 'key' => 'banner', 'position' => 1],
            ['name' => 'Profil', 'key' => 'profil', 'position' => 2],
            ['name' => 'Berita', 'key' => 'berita', 'position' => 3],
            ['name' => 'Statistik', 'key' => 'statistik', 'position' => 4],
        ];

        $schools = School::all();

        foreach ($schools as $school) {

            foreach ($defaultSections as $section) {

                Section::firstOrCreate([
                    'school_id' => $school->id,
                    'key' => $section['key'],
                ], [
                    'name' => $section['name'],
                    'position' => $section['position'],
                    'is_active' => true,
                ]);
            }
        }
    }
}
