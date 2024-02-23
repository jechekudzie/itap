<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $modules = [
            'Generic',
            'Services',
            'Service Categories',
            'Packages',
            'Booking',
        ];

        foreach ($modules as $module) {
            Module::create(['name' => ucfirst($module)]);
        }
    }
}
