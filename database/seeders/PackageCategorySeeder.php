<?php

namespace Database\Seeders;


use App\Models\PackageCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $modules = [
            'Combo',
            'Video Only',
            'Photo Only',
        ];
        foreach ($modules as $module) {
            PackageCategory::create(['name' => ucfirst($module)]);
        }
    }
}
