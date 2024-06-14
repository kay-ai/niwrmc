<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'view menu-invoices',
            'view menu-payments',
            'view menu-licenses',
            'view menu-customers',
            'view menu-categories',
            'view menu-license-types',
            'view menu-roles',
            'view menu-permissions',
            'view menu-assign-permissions',
            'view menu-users',
            'view applications',
            'view invoice',
            'verify payment',
            'view payment',
            'generate license',
            'delete license',
            'verify payment',
            'view payment',
            'assign role',
            'delete user',
            'create user',
            'create roles',
            'edit roles',
            'delete roles',
            'create permissions',
            'edit permissions',
            'delete permissions',
            'create category',
            'view application-documents',
            'approve license',
            'decline license',
            'assign permission',
            'create license-type',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
