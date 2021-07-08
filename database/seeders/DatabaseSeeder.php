<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        DB::table('languages')->insert([
            'name' => 'English',
            'code' => 'en-US',
            'flag' => '/storage/public/images/flag_img/60a7b11981ddd.jpg',
            'status' => '1',
            'is_default' => '1',
        ]);
//        DB::table('users')->insert([
//            'name' => 'user2',
//            'email' => 'user2@email.com',
//            'password' => bcrypt('password'),
//        ]);
    }
}
