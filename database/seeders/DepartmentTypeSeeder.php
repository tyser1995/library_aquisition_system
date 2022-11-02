<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DepartmentType;

class DepartmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DepartmentType::create([
            'created_by_users_id' => 1,
            'department_type' => 'Department'
        ]);
        DepartmentType::create([
            'created_by_users_id' => 1,
            'department_type' => 'Library Section'
        ]);
    }
}
