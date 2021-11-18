<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhoneUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Model::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            for ($i = 0; $i < 50; $i++) {
                DB::table('mk_user')->insert([
                    'mk_id' => random_int(01, 24),
                    'user_id' => random_int(01, 50),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        ];
    }
}
