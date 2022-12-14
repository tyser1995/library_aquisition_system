<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Publisher;

class ListOfPublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Publisher::create([
            'publisher_name' => 'List of Publisers/Dealers'
        ]);
        Publisher::create([
            'publisher_name' => 'C and E Publishing'
        ]);
        Publisher::create([
            'publisher_name' => 'CD Books International Inc.'
        ]);
        Publisher::create([
            'publisher_name' => 'EESM Bookstore'
        ]);
        Publisher::create([
            'publisher_name' => 'Fastbook Educational Supply'
        ]);
        Publisher::create([
            'publisher_name' => 'Forefront Boook Inc.'
        ]);
        Publisher::create([
            'publisher_name' => 'Global International Educational Link'
        ]);
        Publisher::create([
            'publisher_name' => 'Linar International'
        ]);
        Publisher::create([
            'publisher_name' => 'Megatext'
        ]);
        Publisher::create([
            'publisher_name' => 'Mindshapers'
        ]);
        Publisher::create([
            'publisher_name' => 'New Century Books'
        ]);
        Publisher::create([
            'publisher_name' => 'POT Trading'
        ]);
        Publisher::create([
            'publisher_name' => 'Rex Book Store'
        ]);
        Publisher::create([
            'publisher_name' => 'Super Pages Trading'
        ]);
        Publisher::create([
            'publisher_name' => 'Unlimited Books Library Services'
        ]);
        Publisher::create([
            'publisher_name' => "Vp D Tops"
        ]);
    }
}
