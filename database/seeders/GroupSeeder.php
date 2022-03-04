<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Creates User Types at tb_groups
        
        DB::table('tb_groups')->insert([
            'name' => 'Personnel',
            'level' => 2
        ]);

        DB::table('tb_groups')->insert([
            'name' => 'Teacher',
            'level' => 3
        ]);

        DB::table('tb_groups')->insert([
            'name' => 'Student',
            'level' => 4
        ]);

    }
}
