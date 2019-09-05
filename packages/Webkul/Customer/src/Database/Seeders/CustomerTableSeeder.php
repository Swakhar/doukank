<?php

namespace Webkul\Customer\Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CustomerTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('customers')->delete();

//        DB::table('customers')->insert([
//            [
//                'id' => 1,
//                'first_name' => 'khaled',
//                'email' => 'khaled@badenjki.com',
//                'last_name' => 'badenjki',
//                'password' => '1234',
//                'is_verified' => 1,
//                'phone' => 1,
//                'channel_id' => 1,
//            ]
//        ]);
    }
}