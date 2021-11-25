<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DbUpdateController extends Controller
{
    public function index()
    {


//        $this->hourUsedSum();


//        $this->phoneFormat('a1_clients');
//        $this->phoneFormat('new_students');
//        $this->mkUp();
        $this->userUp();
//        $this->abonementsUp();
//        $this->visitsUp();
    }

    public function visitsUp()
    {
        $res = DB::unprepared("
INSERT INTO visits( old_visit_id, user_id, aid, sid, used_hour, abonement_id, mk_id, visit_status_id, date_time, comments, sms, created_at) SELECT * FROM( SELECT crs_visit_records.id, users.id AS user_id, users.aid, users.sid, crs_visit_records.hours, crs_visit_records.id_abonement, NULL AS mk_id, crs_visit_records.id_status, crs_visit_records.date_time, crs_visit_records.rec_comments, crs_visit_records.sms, crs_visit_records.reg_date FROM crs_visit_records LEFT JOIN users ON users.aid = crs_visit_records.id_client UNION SELECT NULL AS old_visit_id, users.id AS user_id, users.aid, users.sid, 3 AS used_hour, NULL AS ab_id, mks.id AS mk_id, new_students.state, new_students.date_time, new_students.comments, new_students.sms, new_students.sign_date FROM new_students LEFT JOIN users ON users.name = new_students.name AND users.family = new_students.family AND users.phone = new_students.phone LEFT JOIN mks ON mks.date_time = new_students.date_time ) AS X ORDER BY X.reg_date
");


//статус надо отдельным запросом
        if ($res) {
            $vs = DB::table('visits')->select('visits.visit_status_id', 'visits.comments', 'visits.id')->get();
            foreach ($vs as $v) {
                if ($v->visit_status_id == (1 || 2)) {
                    $status = 1;
                } elseif ($v->visit_status_id == 3) {
                    $status = 2;
                } elseif ($v->visit_status_id == 4) {
                    $status = 3;
                } elseif ($v->visit_status_id == 5) {
                    $status = 4;
                }
                DB::table('visits')
                    ->where('id', '=', $v->id)
                    ->update([
                        'comments' => $v->comments . ' | ' . $v->visit_status_id,
                        'visit_status_id' => $status,
                        'updated_at' => now()
                    ]);
            }
            foreach ($vs as $v) {
                switch ($v->visit_status_id) {
                    case 'Оплата на МК':
                    case 'Оплатит на МК':
                    case 'Оплатит в студии':
                    case 'Напомнили':
                    case 'Подарочный':
                    case 'Оплачено':
                    case 'Подарочный777':
                    case 'Записан':
                    case 'Заявка на запись':
                        $status = 1;
                        break;
                    case 'Пришел на МК':
                    case 'Частичный возврат':
                    case 'Не купил':
                    case 'Пришел':
                        $status = 2;
                        break;
                    case 'Отказался':
                    case 'Возврат':
                    case 'Ошибка':
                        $status = 4;
                        break;
                    case 'в ожидании платежа':
                    case 'Перезвонить':
                    case 'В ожидании':
                        $status = 6;
                        break;
                    case 'Не пришел':
                        $status = 3;
                        break;
                    case 'Выбирает МК':
                    case 'Выбирает':
                        $status = 5;
                        break;
                }

                DB::table('visits')
                    ->where('id', '=', $v->id)
                    ->update([
                        'comments' => $v->comments . ' | ' . $v->visit_status_id,
                        'visit_status_id' => $status,
                        'updated_at' => now()
                    ]);
            }
        }
        echo 'visitsUp ok';
    }

    public function phoneFormat($table = '')
    {
        $phones = DB::table($table)
//            ->where('reg_date', '>', '2021-01-01 00:00:00')
            ->get();

        foreach ($phones as $phone) {
            $p = preg_replace('/\D/', '', $phone->phone);

            if (trim($phone->phone) !== trim($p)) {
//                echo $phone->id.' = '.$phone->phone . ' - ' . $p . '<br>';
                $p = trim($p);
                if (empty($p)) {
                    $p = NULL;
                }
                DB::table($table)
                    ->where('id', $phone->id)
                    ->update(['phone' => $p]);
            } else {
//                echo $phone->phone . '  ' . $p . '<br>';
            }
        }
        echo 'ok';
    }

    public function abonementsUp()
    {
        $res = DB::unprepared("INSERT INTO `abonements`( `old_id`, `user_id`, `old_user_id`, `hour`, `payment_id`, `discount_id`, `admin_id`, `comments`, `created_at` ) SELECT crs_ab_records.id, users.id, crs_ab_records.id_client, crs_ab_records.qnt * 2, NULL, crs_ab_records.id_discount, crs_ab_records.id_admin, crs_ab_records.comments, crs_ab_records.reg_date FROM crs_ab_records JOIN users ON users.a1_id = crs_ab_records.id_client ORDER BY crs_ab_records.reg_date ON DUPLICATE KEY UPDATE `old_id` = crs_ab_records.id;");
        echo 'abonementsUp ok ' . $res;
    }

    public function mkUp()
    {
        $res = DB::unprepared("
INSERT INTO mks( `date_time`, `pic_id`, `teacher_id`, `price_id`, `created_at` ) SELECT mk_records.rec_date_time, mk_pics.id, teachers.id, prices.id, NOW() FROM mk_records LEFT JOIN mks ON mks.date_time = mk_records.rec_date_time LEFT JOIN mk_pics ON mk_pics.src = mk_records.rec_img LEFT JOIN teachers ON teachers.folder = mk_records.rec_teacher LEFT JOIN prices ON prices.price = mk_records.rec_price ORDER BY mk_records.rec_date_time ON DUPLICATE KEY UPDATE `date_time` = mk_records.rec_date_time;
");
        echo 'mkUp ok ' . $res;
    }

    public function userUp()
    {
        //обьединение a1_clients  and new students
        //юсер наме и пароль генерировать
        DB::unprepared("INSERT INTO users( `aid`, `sid`, `name`, `family`, `patronymic`, `phone`, `email`, `comments`, `cookie`, `blist`, `created_at`) SELECT * FROM( SELECT a1.id AS aid, a2.id AS sid, a2.name, a2.family, a2.surname, a2.phone, a2.email, a2.comments, a2.user_id, a2.blist, a2.sign_date FROM new_students AS a2 LEFT JOIN a1_clients AS a1 ON a2.name = a1.name AND a1.family = a2.family AND a1.phone = a2.phone UNION SELECT a1.id AS aid, a2.id AS sid, a1.name, a1.family, a1.patronymic, a1.phone, a1.email, a1.comments, a1.cookie_id, a1.blist, a1.reg_date FROM new_students AS a2 RIGHT JOIN a1_clients AS a1 ON a2.name = a1.name AND a1.family = a2.family AND a1.phone = a2.phone ) AS u WHERE `family` <> '' OR `phone` <> '' GROUP BY `name`, `family`, `phone`; UPDATE `users` SET `username` = LPAD( FLOOR(RAND() * 999999.99), 5, '0'), `password` = LPAD( FLOOR(RAND() * 999999.99), 5, '0');");
        // обновить скидку у юзера c crs_ab_records
        DB::unprepared("UPDATE users SET users.discount_id =( SELECT MAX(crs_ab_records.id_discount) FROM crs_ab_records WHERE crs_ab_records.id_client = users.aid GROUP BY crs_ab_records.id_client);");
        echo 'userUp ok';
    }

    public function hourUsedSum()
    {
        $hours = DB::table('visits')
            ->select('id', 'used_hour', 'user_id', 'date_time', 'old_user_id', 'abonement_id as ab')
            ->where([['visit_status_id', '=', 1], ['mk_id', '=', NULL], ['abonement_id', '!=', NULL]])
            ->orWhere([['visit_status_id', '=', 2], ['mk_id', '=', NULL], ['abonement_id', '!=', NULL]])
            ->orderBy('ab')
            ->orderBy('user_id')
            ->orderBy('date_time')
            ->get();
        $old_ab = null;
        $user_id = null;
        $all = 0;
        //важно чтобы правильно считалось order by в том же порядке как условия иф
        foreach ($hours as $hour) {

            if ($hour->user_id == $user_id and $hour->ab == 545) {
//                echo '<br>' . $all . '<br>';
                echo 'ab_id:' . $hour->ab . ' user_id:' . $hour->user_id . ' - ' . $hour->date_time . ' used:' . $hour->used_hour;
                $all += $hour->used_hour;
                echo ' всего: ' . $all . '<br>';
                DB::table('visits')
                    ->where('visits.id', '=', $hour->id)
                    ->update([
                        'hour_used_sum' => $all
                    ]);
            } else {
                $all = 0;
            }
            $old_ab = $hour->ab;
            $user_id = $hour->user_id;
        }
    }


}

