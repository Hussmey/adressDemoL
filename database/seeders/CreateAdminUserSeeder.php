<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if the user doesn't exist before creating it
        $user = User::updateOrCreate(
            ['email' => 'ahtash@demo.com'],
            [
                'name' => 'Hussam Ahtash',
                'password' => bcrypt('password')
            ]
        );

        // Check if the role doesn't exist before creating it
        if (!Role::where('name', 'Admin')->exists()) {
            $role = Role::create(['name' => 'Admin']);
            
            // Sync all permissions to the role
            $permissions = Permission::pluck('id', 'id')->all();
            $role->syncPermissions($permissions);
        }

        // Assign the role to the user
        $user->assignRole(['Admin']);
    }
}
