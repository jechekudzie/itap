<?php

namespace Database\Seeders;

use App\Models\LineItemCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineItemCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = [
            'TEAM', 'COVERAGE', 'DELIVERABLES', 'ACCESSORIES'
        ];

        foreach ($categories as $categoryName) {
            LineItemCategory::create([
                'name' => $categoryName,
            ]);
        }
    }
}
