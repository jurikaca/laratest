<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // regular user
        $user_one = new User();
        $user_one->username = 'jurikaca';
        $user_one->email = 'juri.kaca@gmail.com';
        $user_one->password = bcrypt('juri15');
        $user_one->isActive = 1;
        $user_one->save();

        // admin
        $user_two = new User();
        $user_two->role = User::ADMIN;
        $user_two->username = 'admin';
        $user_two->email = 'admin@gmail.com';
        $user_two->password = bcrypt('juri15');
        $user_two->isActive = 1;
        $user_two->save();
    }
}
