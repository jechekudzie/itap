<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = [
            'WEDDING' => ['WHITE WEDDING', 'LOBOLA', 'ENGAGEMENT'],
            'PARTY' => ['BIRTHDAY', 'GRADUATION', 'HOME GATHERING'],
            'FUNERAL' => ['BURIAL', 'MEMORIAL', 'UNVEILING'],
            'PHOTOSHOOT' => ['HOME SHOOT', 'STUDIO', 'OUTDOOR VENUE'],
        ];

        // Iterate over each category and their services
        foreach ($categories as $categoryName => $services) {
            // Retrieve the category ID by the category name
            $category = DB::table('service_categories')->where('name', $categoryName)->first();
            $categoryId = $category ? $category->id : null;

            // Only proceed if the category was found
            if ($categoryId) {
                foreach ($services as $serviceName) {
                    // Insert the service with the corresponding category ID

                    Service::create([
                        'name' => $serviceName,
                        'service_category_id' => $categoryId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                }
            }
        }
    }
}
