<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PurchaseRequestRecommendedUser;

class PurchaseRequestRecommendedUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        PurchaseRequestRecommendedUser::create(['recommended_user' => 'Faculty']);
        PurchaseRequestRecommendedUser::create(['recommended_user' => 'Librarian']);
        PurchaseRequestRecommendedUser::create(['recommended_user' => 'Administrator']);
        PurchaseRequestRecommendedUser::create(['recommended_user' => 'Staff']);
    }
}
