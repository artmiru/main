<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mk extends Model
{
    use HasFactory;

    protected $dates = ['date_time'];
    protected $fillable = [
        'date_time',
        'teacher_id',
        'price_id',
        'pic_id',
    ];

    protected function generateMkDates()
    {
        $period = CarbonPeriod::create(Carbon::now(), Carbon::now()->addMonth());
        $dat = array();
        foreach ($period as $date) {

            $d12 = date('Y-m-d 12:00:00', strtotime($date));
            $d17 = date('Y-m-d 17:00:00', strtotime($date));
            $d11 = date('Y-m-d 11:00:00', strtotime($date));
            $d19 = date('Y-m-d 19:00:00', strtotime($date));
            switch ($date->dayOfWeek) {
                case 0:
                    Mk::firstOrCreate(
                        [
                            'date_time' => $d12
                        ],
                        [
                            'teacher_id' => 3,
                            'pic_id' => random_int('001', '245'),
                            'price_id' => 11
                        ]
                    );
                    Mk::firstOrCreate(
                        [
                            'date_time' => $d17
                        ],
                        [
                            'teacher_id' => 3,
                            'pic_id' => random_int('001', '245'),
                            'price_id' => 11
                        ]
                    );
                    break;
                case 1:
                    Mk::firstOrCreate(
                        [
                            'date_time' => $d11
                        ],
                        [
                            'teacher_id' => 3,
                            'pic_id' => random_int('001', '245'),
                            'price_id' => 10
                        ]
                    );
                    break;
                case 3:
                    Mk::firstOrCreate(
                        [
                            'date_time' => $d11
                        ],
                        [
                            'teacher_id' => 3,
                            'pic_id' => random_int('001', '245'),
                            'price_id' => 10
                        ]
                    );
                    break;
                case 5:
                    Mk::firstOrCreate(
                        [
                            'date_time' => $d11
                        ],
                        [
                            'teacher_id' => 3,
                            'pic_id' => random_int('001', '245'),
                            'price_id' => 10
                        ]
                    );
                    break;
                case 6:
                    Mk::firstOrCreate(
                        [
                            'date_time' => $d19
                        ],
                        [
                            'teacher_id' => 3,
                            'pic_id' => random_int('001', '244'),
                            'price_id' => 11
                        ]
                    );
                    break;
            }

        }

    }
}
