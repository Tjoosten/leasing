<?php

use App\User; 
use Spatie\Permission\Models\{Permission, Role}; 
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

/**
 * Class AclTableSeeder
 */
class AclTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->seedDefaultPermissions(); // Staat eerst wegens de permissies die later gebruikt in de toegangs rollen. 

        if ($this->command->confirm('Create roles for the user(s), default is admin, leiding and huurder.', true)) {
            // Confirm and ask for application specific roles in the application. 
            $inputRoles = $this->command->ask('Enter roles in comma separated format.', 'admin, leiding, huurder');
            $this->createRoleIfNotExists($inputRoles);
        } else {
            // Only the default user is needed
            $this->createOnlyNormalUserRole();
        }
    }

    /**
     * Implementatie van de standaard permissies in de database van de applicatie. 
     * 
     * @return void
     */
    protected function seedDefaultPermissions(): void 
    {
        foreach ($this->defaultPermissions() as $permission) {
            Permission::firstOrCreate(['name' => trim($permission)]);
        }
    }

    /**
     * Functie voor de oplijsting van standaard permissies in de applicatie. 
     * 
     * @return array 
     */
    public function defaultPermissions(): array
    {
        return [];
    }

    /**
     * Function for attaching permissions and creating a role if it not already exists in the database. 
     * 
     * @param  string $roles The one dimensional array for the given roles.
     * @return void
     */
    protected function createRoleIfNotExists(string $roles): void 
    {
        foreach (explode(',', $roles) as $role) {
            $role = Role::firstOrCreate(['name' => trim($role)]);

            if ($this->isAdmin($role->name)) { // Assign all permissions
                $role->syncPermissions(Permission::all());
                $this->command->info('Admin granted all permissions');
            } else { // For others by default only read access
                $role->syncPermissions($this->getUserPermissions());
            }

            $this->createUser($role); // Create one user for each role.
        }
    }
    
    /**
     * Creating a normal user in the storage
     * 
     * @return void
     */
    protected function createUser(Role $role): void 
    {
        $user = factory(User::class)->create(['password' => 'secret'])->assignRole($role->name);

        if ($this->isAdmin($role->name)) {
            $this->command->info('Here are your admin details to login:'); 
            $this->command->warn($user->email); 
            $this->command->warn('Password is "secret"');
        }
    }
    
    /**
     * Function for getting the permissions that assigned to normal users. 
     * 
     * @return void
     */
    protected function getUserPermissions(): Collection
    {
        return Permission::where('name', 'LIKE', 'view_%')->get();
    }

    /**
     * Determine if the created role is admin or not. 
     * 
     * @param  string $role The name from the given role. 
     * @return bool
     */
    protected function isAdmin(string $role): bool 
    {
        return $role === 'admin'; 
    }
}
