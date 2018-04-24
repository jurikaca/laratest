<?php

use Illuminate\Database\Seeder;
use App\Type;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type1 = new Type();
        $type1->name = 'Phone';
        $type1->creator_id = 1;
        $type1->save();

        $type2 = new Type();
        $type2->name = 'Tablet';
        $type2->creator_id = 1;
        $type2->save();

        $type3 = new Type();
        $type3->name = 'Laptop';
        $type3->creator_id = 1;
        $type3->save();
    }
}
