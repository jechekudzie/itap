<?php

namespace Database\Seeders;

use App\Models\ContactType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $contactTypes = [
            ["name" => "Mobile"],
            ["name" => "Telephone"],
            ["name" => "Email"],
        ];

        foreach ($contactTypes as $type) {
            ContactType::create($type);
        }
    }
}
