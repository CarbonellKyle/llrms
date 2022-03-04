<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_positions')->insert([
            'name' => 'Teacher 1',
            'code' => 'TC1'
        ]);

        DB::table('tb_positions')->insert([
            'name' => 'Teacher 2',
            'code' => 'TC2'
        ]);
    }
}
