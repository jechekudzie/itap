<?php

namespace Database\Seeders;

use App\Models\Organisation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class OrganisationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $organisations = [
            [
                'id' => 1,
                'name' => 'iTAP Media',
                'organisation_type_id' => 1,
                'organisation_id' => null, // Assuming NULL should be represented as null
                'slug' => 'itap-media',
                'created_at' => '2024-02-19 09:07:58',
                'updated_at' => '2024-02-19 09:07:58',
            ],
            [
                'id' => 2,
                'name' => 'Head Office',
                'organisation_type_id' => 2,
                'organisation_id' => 1,
                'slug' => 'head-office',
                'created_at' => '2024-02-19 09:08:26',
                'updated_at' => '2024-02-19 09:08:26',
            ],
        ];

        foreach ($organisations as $organisation) {

            $newOrganisation = Organisation::create($organisation);

            // Create admin role
            $role = $newOrganisation->organisationRoles()->create([
                'name' => 'admin',
                'guard_name' => 'web',
            ]);

            // Check if the organisation name is similar to the ones that should have all permissions
            if (Str::lower($newOrganisation->name) === Str::lower("iTAP Media"))
            {

                // Retrieve all permissions
                $permissions = Permission::all();
            } else {
                // Retrieve all permissions and reject the ones related to 'generic'
                $permissions = Permission::all()->reject(function ($permission) {
                    // Check if the permission name contains 'generic'
                    return Str::contains(Str::lower($permission->name), 'generic');
                });
            }

            // Find or create permissions based on the provided names
            $permissionsToAssign = [];
            foreach ($permissions as $permission) {
                // Ensure $permission->name is a string representing the permission name
                $permissionsToAssign[] = Permission::findOrCreate($permission->name);
            }

            // Sync permissions to the role (this will attach the new permissions and detach any that are not in the array)
            $role->syncPermissions($permissionsToAssign);

        }
    }
}
