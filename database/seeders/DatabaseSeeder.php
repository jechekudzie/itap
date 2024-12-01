<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ModuleSeeder::class,
           /* OrganisationTypesSeeder::class,
            OrganisationTypeRelationshipSeeder::class,
            OrganisationsSeeder::class,*/
            ServiceCategorySeeder::class,
            ServicesTableSeeder::class,
            PackageCategorySeeder::class,
            PackageSeeder::class,
            LineItemCategoriesTableSeeder::class,
            LineItemsTableSeeder::class,
            CountriesSeeder::class,
            ProvinceSeeder::class,
            CitySeeder::class,
            AddressTypeSeeder::class,
            ContactTypeSeeder::class,
            TitleSeeder::class,
            GenderSeeder::class,
            IdentificationTypeSeeder::class,
            PaymentMethodSeeder::class,

        ]);

    }
}
