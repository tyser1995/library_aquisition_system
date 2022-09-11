<?php

namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Super Admin', 
            'email' => 'superadmin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('super1234'),
            'role' => 1,
            'status' => 'Active',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        $user_admin = User::create([
            'name' => 'Admin', 
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'role' => 2,
            'status' => 'Active',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    
        $role = Role::find(1);     
        $permissions = Permission::pluck('id','id')->all();   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);

        $role_admin = Role::find(2);     
        $permissions_admin = Permission::pluck('id','id')->all();   
        $role_admin->syncPermissions($permissions_admin);

        $user_admin->assignRole([$role_admin->id]);
    }
}
