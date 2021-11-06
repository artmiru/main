<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Phone;

class PhonesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 30; $i++) {
            Phone::create([
                'phone' => '+7921'.random_int(1000000, 9999999),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
