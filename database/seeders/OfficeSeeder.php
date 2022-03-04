<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Creates Offices at tb_office

        DB::table('tb_office')->insert([
            'id' => 1,
            'officename' => 'Division Office',
        ]);

        DB::table('tb_office')->insert([
            'id' => 128009,
            'officename' => 'Bal-ason Central School',
            'district' => 'East 1'
        ]);

        DB::table('tb_office')->insert([
            'id' => 304129,
            'officename' => 'Bal-ason National High School',
            'district' => 'East 1'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128010,
            'officename' => 'Daan Lungsod Elementary School',
            'district' => 'East 1'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128016,
            'officename' => 'Elpidio Galarion Ampatin Primary School',
            'district' => 'East 1'
        ]);

        DB::table('tb_office')->insert([
            'id' => 315504,
            'officename' => 'Ginggog City CNHS - Pundasan NHS Annex',
            'district' => 'East 1'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128011,
            'officename' => 'Hindangon Elementary School',
            'district' => 'East 1'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128012,
            'officename' => 'Lawaan Elementary School',
            'district' => 'East 1'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128013,
            'officename' => 'Lawit Elementary School',
            'district' => 'East 1'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128014,
            'officename' => 'Libon Elementary School',
            'district' => 'East 1'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128015,
            'officename' => 'Mamaran Elementary School',
            'district' => 'East 1'
        ]);
        
        DB::table('tb_office')->insert([
            'id' => 111804,
            'officename' => 'Pignanaw Sa Banugan Elementary School',
            'district' => 'East 1'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128021,
            'officename' => 'Sta. Rita Elemenetary School',
            'district' => 'East 1'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128007,
            'officename' => 'Anakan Central School',
            'district' => 'East 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128008,
            'officename' => 'Bagubad Elementary School',
            'district' => 'East 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 315505,
            'officename' => 'Gingoon City CNHS - Anakan Annex',
            'district' => 'East 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128037,
            'officename' => 'Maribucao Elementary School',
            'district' => 'East 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 502155,
            'officename' => 'Mimbalagon Elementary School',
            'district' => 'East 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128018,
            'officename' => 'Mimbunga Elementary School',
            'district' => 'East 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 304135,
            'officename' => 'Mimbunga National High School',
            'district' => 'East 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128019,
            'officename' => 'Minsapinit Elementary School',
            'district' => 'East 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128020,
            'officename' => 'Punong Elementary School',
            'district' => 'East 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128022,
            'officename' => 'Tinabalan Elementary School',
            'district' => 'East 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128026,
            'officename' => 'Dulag Elementary School',
            'district' => 'North 1'
        ]);

        DB::table('tb_office')->insert([
            'id' => 304136,
            'officename' => 'Jacinto D Malimas Sr. National High School',
            'district' => 'North 1'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128033,
            'officename' => 'Kidahon Elementary School',
            'district' => 'North 1'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128035,
            'officename' => 'Malinao Elementary School',
            'district' => 'North 1'
        ]);

        DB::table('tb_office')->insert([
            'id' => 304134,
            'officename' => 'Malinao National High School',
            'district' => 'North 1'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128038,
            'officename' => 'Odiongan Central School',
            'district' => 'North 1'
        ]);

        DB::table('tb_office')->insert([
            'id' => 315502,
            'officename' => 'Odiongan NHS - Talisay NHS Annex',
            'district' => 'North 1'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128039,
            'officename' => 'Pandacdacan Elementary School',
            'district' => 'North 1'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128040,
            'officename' => 'Pangasihan Elementary School',
            'district' => 'North'
        ]);

        DB::table('tb_office')->insert([
            'id' => 500802,
            'officename' => 'Sioan Intergrated School',
            'district' => 'North 1'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128044,
            'officename' => 'Tagdaging Elementary School',
            'district' => 'North 1'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128045,
            'officename' => 'Talisay Elementary School',
            'district' => 'North 1'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128023,
            'officename' => 'Dinawehan Elementary School',
            'district' => 'North 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128024,
            'officename' => 'Dreamland Elementary School',
            'district' => 'North 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 501436,
            'officename' => 'Kamanikan Integrated School',
            'district' => 'North 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128032,
            'officename' => 'Kianlagan Elementary School',
            'district' => 'North 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 315506,
            'officename' => 'Kisandi National High School',
            'district' => 'North 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128034,
            'officename' => 'Malibud Central School',
            'district' => 'North 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 304133,
            'officename' => 'Malibud National High School',
            'district' => 'North 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128041,
            'officename' => 'San Jose Elementary School',
            'district' => 'North 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 202502,
            'officename' => 'Silangan Primary School',
            'district' => 'North 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128036,
            'officename' => 'Tagpako Elementary School',
            'district' => 'North 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 501400,
            'officename' => 'Talon Integrated School',
            'district' => 'North 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128047,
            'officename' => 'Topside Elementary School',
            'district' => 'North 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 111422,
            'officename' => 'Balay Ha Tagnauwan Ta Bayungon ES',
            'district' => 'North 3'
        ]);

        DB::table('tb_office')->insert([
            'id' => 502156,
            'officename' => 'Baliguihan Elementary School',
            'district' => 'North 3'
        ]);

        DB::table('tb_office')->insert([
            'id' => 111420,
            'officename' => 'Bayawon Ta Malagwas Elementary School',
            'district' => 'North 3'
        ]);

        DB::table('tb_office')->insert([
            'id' => 500800,
            'officename' => 'Dukdokaan Integrated School',
            'district' => 'North 3'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128027,
            'officename' => 'Eureka Elementary School',
            'district' => 'North 3'
        ]);

        DB::table('tb_office')->insert([
            'id' => 315501,
            'officename' => 'Eureka National High School',
            'district' => 'North 3'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128029,
            'officename' => 'Impaluhod Elementary School',
            'district' => 'North 3'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128030,
            'officename' => 'Kalipay Central School',
            'district' => 'North 3'
        ]);

        DB::table('tb_office')->insert([
            'id' => 304132,
            'officename' => 'Kalipay National High School',
            'district' => 'North 3'
        ]);

        DB::table('tb_office')->insert([
            'id' => 202503,
            'officename' => 'Minpakiki Elementary School',
            'district' => 'North 3'
        ]);

        DB::table('tb_office')->insert([
            'id' => 111092,
            'officename' => 'Sagu-Ilaw Ta Kabuka Elementary School',
            'district' => 'North 3'
        ]);

        DB::table('tb_office')->insert([
            'id' => 501024,
            'officename' => 'Sangalan Integrated School',
            'district' => 'North 3'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128052,
            'officename' => 'Barangay 18-A Elementary School',
            'district' => 'South 1'
        ]);

        DB::table('tb_office')->insert([
            'id' => 501023,
            'officename' => 'Civoleg Integrated School',
            'district' => 'South 1'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128050,
            'officename' => 'Don Restituto Baol Central School',
            'district' => 'South 1'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128051,
            'officename' => 'Esik Campilan Elementary School',
            'district' => 'South 1'
        ]);

        DB::table('tb_office')->insert([
            'id' => 315503,
            'officename' => 'Gingoog City CNHS - LURISA NHS Annex',
            'district' => 'South 1'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128053,
            'officename' => 'Lunotan Elementary School',
            'district' => 'South 1'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128056,
            'officename' => 'Ramon Arevalo Elementary School',
            'district' => 'South 1'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128057,
            'officename' => 'Ricoro Elementary School',
            'district' => 'South 1'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128058,
            'officename' => 'Roy Vizcara Elementary School',
            'district' => 'South 1'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128060,
            'officename' => 'Alagatan Elementary School',
            'district' => 'South 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 501379,
            'officename' => 'Alfonso Ang Militante Integrated School',
            'district' => 'South 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128064,
            'officename' => 'Binakalan Elementary School',
            'district' => 'South 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128028,
            'officename' => 'Eustaquio Taneza Elementary School',
            'district' => 'South 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 304131,
            'officename' => 'Gingoog City CNHS - BACKKISMI NHS Annex',
            'district' => 'South 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128054,
            'officename' => 'Magallanes Elementary School',
            'district' => 'South 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128055,
            'officename' => 'Manuel Lugod Central School',
            'district' => 'South 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 304130,
            'officename' => 'Gingoog City Comprehensive National High School',
            'district' => 'West 1'
        ]);

        DB::table('tb_office')->insert([
            'id' => 501432,
            'officename' => 'Kalagonoy Integrated School',
            'district' => 'West 1'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128068,
            'officename' => 'Kipuntos Elementary School',
            'district' => 'West 1'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128076,
            'officename' => 'San Juan Central School',
            'district' => 'West 1'
        ]);

        DB::table('tb_office')->insert([
            'id' => 501025,
            'officename' => 'Sulpicio Lugod Integrated School',
            'district' => 'West 1'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128063,
            'officename' => 'Baybay Elementary School',
            'district' => 'West 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 501435,
            'officename' => 'Fructuso Rife Integrated School',
            'district' => 'West 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128069,
            'officename' => 'Lunao Central School',
            'district' => 'West 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 315507,
            'officename' => 'Lunao National High School',
            'district' => 'West 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128071,
            'officename' => 'Mimbuntong Elementary School',
            'district' => 'West 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128072,
            'officename' => 'Midulean Elementary School',
            'district' => 'West 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 500741,
            'officename' => 'Murallon Integrated School',
            'district' => 'West 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 500811,
            'officename' => 'Pedro Maligmat Integrated School',
            'district' => 'West 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128078,
            'officename' => 'Tinulongan Elementary School',
            'district' => 'West 2'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128059,
            'officename' => 'Agay-ayan Elementary School',
            'district' => 'West 3'
        ]);

        DB::table('tb_office')->insert([
            'id' => 500801,
            'officename' => 'Bantaawan Integrated School',
            'district' => 'West 3'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128065,
            'officename' => 'Dona Josefa Pelaez Reyes Central School',
            'district' => 'West 3'
        ]);

        DB::table('tb_office')->insert([
            'id' => 111852,
            'officename' => 'Kalandang Ta Anahaw Elementary School',
            'district' => 'West 3'
        ]);

        DB::table('tb_office')->insert([
            'id' => 128067,
            'officename' => 'Kibuging Elementary School',
            'district' => 'West 3'
        ]);

        DB::table('tb_office')->insert([
            'id' => 500799,
            'officename' => 'Pigsalohan Integrated School',
            'district' => 'West 3'
        ]);

        DB::table('tb_office')->insert([
            'id' => 304137,
            'officename' => 'San Luis National High School',
            'district' => 'West 3'
        ]);
        
    }
}
