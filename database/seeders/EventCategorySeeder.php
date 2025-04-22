<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EventCategory;

class EventCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EventCategory::each(function ($category) {
            $category->delete();
        });

        EventCategory::create([
            'id'=>1,
            'category' => 'Kursus',
        ]);

        EventCategory::create([
            'id'=>2,
            'category' => 'Bengkel',
        ]);

        EventCategory::create([
            'id'=>3,
            'category' => 'Latihan',
        ]);

        EventCategory::create([
            'id'=>4,
            'category' => 'Ceramah',
        ]);

        EventCategory::create([
            'id'=>5,
            'category' => 'Mesyuarat',
        ]);

        EventCategory::create([
            'id'=>6,
            'category' => 'Mesyuarat Atas Talian',
        ]);

    }
}
