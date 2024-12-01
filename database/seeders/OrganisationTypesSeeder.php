<?php

namespace Database\Seeders;

use App\Models\OrganisationType;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganisationTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $organisationTypes = [

                [
                    'id' => 1,
                    'name' => 'System Users',
                    'description' => null,
                    'slug' => 'system-users',
                    'created_at' => '2024-02-19 09:07:26',
                    'updated_at' => '2024-02-19 09:07:26',
                ],
                [
                    'id' => 2,
                    'name' => 'Branch',
                    'description' => null,
                    'slug' => 'branch',
                    'created_at' => '2024-02-19 09:07:41',
                    'updated_at' => '2024-02-19 09:07:41',
                ],
                [
                    'id' => 3,
                    'name' => 'Department',
                    'description' => null,
                    'slug' => 'department',
                    'created_at' => '2024-02-19 09:07:50',
                    'updated_at' => '2024-02-19 09:07:50',
                ],

        ];

        foreach ($organisationTypes as $type) {
            OrganisationType::create($type);
        }

    }
}
