<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Super Admin']);
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Library Aquisition']);
        Role::create(['name' => 'President']);
        Role::create(['name' => 'VPAA']);
        Role::create(['name' => 'VPFA']);
        Role::create(['name' => 'Director of Library']);
        Role::create(['name' => 'Custodian']);
        Role::create(['name' => 'Dean']);
        Role::create(['name' => 'Faculty']);
    }
}