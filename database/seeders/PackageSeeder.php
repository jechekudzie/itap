<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $modules = [
            'Standard',
            'Medium',
            'Premium',
        ];
        foreach ($modules as $module) {
            Package::create(['name' => ucfirst($module)]);
        }
    }
}
