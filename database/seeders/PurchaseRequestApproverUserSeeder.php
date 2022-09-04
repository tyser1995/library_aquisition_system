<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PurchaseRequestApproverUser;

class PurchaseRequestApproverUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        PurchaseRequestApproverUser::create(['approver_user' => 'Dean']);
        PurchaseRequestApproverUser::create(['approver_user' => 'Director of Libraries']);
        PurchaseRequestApproverUser::create(['approver_user' => 'Principal']);
    }
}
