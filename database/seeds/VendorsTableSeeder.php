<?php

use Illuminate\Database\Seeder;
use App\Vendor;

class VendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendor1 = new Vendor();
        $vendor1->name = 'Vendor 1';
        $vendor1->creator_id = 1;
        $vendor1->save();

        $vendor2 = new Vendor();
        $vendor2->name = 'Vendor 2';
        $vendor2->creator_id = 1;
        $vendor2->save();
    }
}
