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

        // Contents
        // $this->call([RegionsTableSeeder::class]);
        //$this->call([CountriesTableSeeder::class]);
        //$this->call([NationalitiesTableSeeder::class]);
        //$this->call([ContentTypesTableSeeder::class]);

        //Itinaray
        //$this->call([ItineraryTypesSeeder::class]);
    }
}
