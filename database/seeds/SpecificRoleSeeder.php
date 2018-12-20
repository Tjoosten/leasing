<?php

use App\User;
use Spatie\Permission\Models\{Role, Permission}; 
use Illuminate\Database\Seeder;

/**
 * Class SpecificRoleSeeder
 */
class SpecificRoleSeeder extends Seeder
{
    /**
     * Method for adding application specific roles to the application.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::firstOrCreate(['name' => 'leiding']);

        if ($role->wasRecentlyCreated) {
            $role->syncPermissions(Permission::all());
            factory(User::class)->create(['password' => 'secret'])->assignRole($role->name);
        }
    }
}
