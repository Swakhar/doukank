<?php

namespace Webkul\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class LocalesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('channels')->delete();

        DB::table('locales')->delete();

        DB::table('locales')->insert([
                'id' => 1,
                'code' => 'en',
                'name' => 'English',
            ],
            [
                'id' => 2,
                'code' => 'ar',
                'name' => 'Arabic',
            ],
            [
                'id' => 3,
                'code' => 'fr',
                'name' => 'French',
            ]);
    }
}