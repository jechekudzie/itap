<?php

namespace Database\Seeders;

use App\Models\AddressType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $addressTypes = [
            ["name" => "Physical"],
            ["name" => "Residential"],
            ["name" => "Business"],
        ];

        foreach ($addressTypes as $type) {
            AddressType::create($type);
        }
    }
}
