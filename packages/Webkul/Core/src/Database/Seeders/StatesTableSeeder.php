<?php

namespace Webkul\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class StatesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('country_states')->delete();

        $states = json_decode(file_get_contents(__DIR__ . '/../../Data/states.json'), true);

        DB::table('country_states')->insert($states);

        DB::table('country_state_translations')->insert([
            'id' => 1,
            'locale' => 'ar',
            'name' => 'حلب',
            'country_state_id' => '47',
        ]);

        DB::table('country_state_translations')->insert([
            'id' => 2,
            'locale' => 'en',
            'name' => 'Aleppo',
            'country_state_id' => '47',
        ]);

        DB::table('country_state_translations')->insert([
            'id' => 3,
            'locale' => 'ar',
            'name' => 'دمشق',
            'country_state_id' => '48',
        ]);

        DB::table('country_state_translations')->insert([
            'id' => 4,
            'locale' => 'en',
            'name' => 'Damascus',
            'country_state_id' => '48',
        ]);
    }
}