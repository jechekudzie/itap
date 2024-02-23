<?php

namespace Database\Seeders;

use App\Models\LineItem;
use App\Models\LineItemCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $items = [
            'TEAM' => [
                ['name' => 'Videographers', 'price' => 0, 'is_billable' => 1],
                ['name' => 'Photographer', 'price' => 0, 'is_billable' => 1],
                ['name' => 'Drone', 'price' => 0, 'is_billable' => 1],
            ],
            'COVERAGE' => [
                ['name' => 'hours ', 'price' => 0, 'is_billable' => 1],
                ['name' => 'Pre-Shoot/Photos ', 'price' => 0, 'is_billable' => 0],
                ['name' => 'Preps ', 'price' => 0, 'is_billable' => 0],
                ['name' => 'Ceremony ', 'price' => 0, 'is_billable' => 0],
                ['name' => 'Reception', 'price' => 0, 'is_billable' => 0],
            ],
            'DELIVERABLES' => [
                ['name' => 'Full Video (HD Quality)', 'price' => 0, 'is_billable' => 0],
                ['name' => 'Full Video (4K Quality)', 'price' => 0, 'is_billable' => 1],
                ['name' => 'Highlight Reel', 'price' => 0, 'is_billable' => 0],
                ['name' => 'Digital Invite', 'price' => 0, 'is_billable' => 0],
                ['name' => 'High Resolution Images', 'price' => 0, 'is_billable' => 0],
            ],
            'ACCESSORIES' => [
                ['name' => 'USB', 'price' => 0,'is_billable' => 1],
                ['name' => 'Canvas X (A2)', 'price' => 0, 'is_billable' => 1],
                ['name' => 'Canvas XX (A1)', 'price' => 0, 'is_billable' => 1],
                ['name' => 'Canvas XXL (A0)', 'price' => 0, 'is_billable' => 1],
                ['name' => 'Photobook', 'price' => 0, 'is_billable' => 1],
                ['name' => 'small prints', 'price' => 0, 'is_billable' => 1],
                ['name' => 'Photo-clock', 'price' => 0, 'is_billable' => 1],
            ],
        ];


        foreach ($items as $categoryName => $lineItems) {
            // Retrieve the category ID by the category name
            $category = LineItemCategory::where('name', $categoryName)->first();
            $categoryId = $category ? $category->id : null;

            if ($categoryId) {
                foreach ($lineItems as $item) {
                    LineItem::create([
                        'line_item_category_id' => $categoryId,
                        'name' => $item['name'],
                        'price' => $item['price'],
                        'is_billable' =>$item['is_billable'] ?? 0,
                        // created_at and updated_at will be set automatically
                    ]);
                }
            }
        }
    }
}
