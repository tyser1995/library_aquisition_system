<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	// Role, Permission and User
    	$this->call([RoleTableSeeder::class]);
        $this->call([PermissionTableSeeder::class]);
        $this->call([CreateAdminUserSeeder::class]);

        //Purchase Request User
        $this->call([PurchaseRequestApproverUserSeeder::class]);
        $this->call([PurchaseRequestRecommendedUserSeeder::class]);
       
        //Department Type
        $this->call([DepartmentTypeSeeder::class]);

        //Publisher
        $this->call([ListOfPublisherSeeder::class]);
    }
}
