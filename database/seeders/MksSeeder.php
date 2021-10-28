<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0;$i < 24;$i++){
        DB::table('mks')->insert([
            'title' => Str::random(10),
            'date_time' => date('Y-m-d H:i:s'),
            'id_img' => random_int(1,200),
            'id_teacher' => random_int(1,10),
            'id_price' => random_int(10,12)
        ]);
        }
    }
}
