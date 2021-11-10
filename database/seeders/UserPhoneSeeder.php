<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class UserPhoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 50; $i++) {
            DB::table('mk_user')->insert([
                'mk_id' => random_int(01, 24),
                'user_id' => random_int(01, 50),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
