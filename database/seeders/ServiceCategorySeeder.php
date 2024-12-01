<?php

namespace Database\Seeders;

use App\Models\OrganisationType;
use App\Models\ServiceCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $serviceCategories = [

            [
                'name' => 'Wedding',
                'description' => null,
                'created_at' => '2024-02-19 09:07:26',
                'updated_at' => '2024-02-19 09:07:26',
            ],

            [
                'name' => 'Party',
                'description' => null,
                'created_at' => '2024-02-19 09:07:50',
                'updated_at' => '2024-02-19 09:07:50',
            ],
            [
                'name' => 'Funeral',
                'description' => null,
                'created_at' => '2024-02-19 09:07:41',
                'updated_at' => '2024-02-19 09:07:41',
            ],


            [
                'name' => 'Photoshoot',
                'description' => null,
                'created_at' => '2024-02-19 09:07:50',
                'updated_at' => '2024-02-19 09:07:50',
            ],

        ];

        foreach ($serviceCategories as $serviceCategory) {
            ServiceCategory::create($serviceCategory);
        }

    }
}
