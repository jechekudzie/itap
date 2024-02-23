<?php

namespace Database\Seeders;

use App\Models\OrganisationType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrganisationTypeRelationshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $relationships = [
            [
                'id' => 1,
                'organisation_type_id' => 1,
                'child_id' => 2,
                'notes' => null, // Assuming NULL values should be represented as null
                'created_at' => '2024-02-19 09:07:41',
                'updated_at' => '2024-02-19 09:07:41',
            ],
            [
                'id' => 2,
                'organisation_type_id' => 2,
                'child_id' => 3,
                'notes' => null,
                'created_at' => '2024-02-19 09:07:50',
                'updated_at' => '2024-02-19 09:07:50',
            ],

        ];

        DB::table('organisation_type_organisation_type')->insert($relationships);


    }
}
