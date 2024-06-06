<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'street-list',
            'street-create',
            'street-edit',
            'street-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'postcode-list',
            'postcode-create',
            'postcode-edit',
            'postcode-delete',
            'postcodearea-list',
            'postcodearea-create',
            'postcodearea-edit',
            'postcodearea-delete',
            'house-list',
            'house-create',
            'house-edit',
            'house-delete',
            'city-list',
            'city-create',
            'city-edit',
            'city-delete',
            'area-list',
            'area-create',
            'area-edit',
            'area-delete',
            'addresses-view',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }   
    }
}
