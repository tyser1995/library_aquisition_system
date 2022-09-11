<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Reset cached roles and permissions
        //app()[PermissionRegistrar::class]->forgetCachedPermissions();


        $permissions = [
           'user-list',
           'user-create',
           'user-store',
           'user-edit',
           'user-delete',
           'role-list',
           'role-create',
           'role-store',
           'role-edit',
           'role-delete',
           'department_type-list',
           'department_type-create',
           'department_type-store',
           'department_type-edit',
           'department_type-delete',
           'department_name-list',
           'department_name-create',
           'department_name-store',
           'department_name-edit',
           'department_name-delete',
           'purchase_request-list',
           'purchase_request-create',
           'purchase_request-store',
           'purchase_request-edit',
           'purchase_request-delete',
        ];


        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
