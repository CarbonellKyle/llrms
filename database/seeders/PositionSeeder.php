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
            'name' => 'Kindergarten Student',
            'code' => '0'
        ]);

        DB::table('tb_positions')->insert([
            'name' => 'Grade 1 Student',
            'code' => '1'
        ]);

        DB::table('tb_positions')->insert([
            'name' => 'Grade 2 Student',
            'code' => '2'
        ]);

        DB::table('tb_positions')->insert([
            'name' => 'Grade 3 Student',
            'code' => '3'
        ]);

        DB::table('tb_positions')->insert([
            'name' => 'Grade 4 Student',
            'code' => '4'
        ]);

        DB::table('tb_positions')->insert([
            'name' => 'Grade 5 Student',
            'code' => '5'
        ]);

        DB::table('tb_positions')->insert([
            'name' => 'Grade 6 Student',
            'code' => '6'
        ]);

        DB::table('tb_positions')->insert([
            'name' => 'Grade 7 Student',
            'code' => '7'
        ]);

        DB::table('tb_positions')->insert([
            'name' => 'Grade 8 Student',
            'code' => '8'
        ]);

        DB::table('tb_positions')->insert([
            'name' => 'Grade 9 Student',
            'code' => '9'
        ]);

        DB::table('tb_positions')->insert([
            'name' => 'Grade 10 Student',
            'code' => '10'
        ]);

        DB::table('tb_positions')->insert([
            'name' => 'Grade 11 Student',
            'code' => '11'
        ]);

        DB::table('tb_positions')->insert([
            'name' => 'Grade 12 Student',
            'code' => '12'
        ]);
        
    }
}
