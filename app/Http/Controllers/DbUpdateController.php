<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DbUpdateController extends Controller
{
    public function index()
    {


//        $this->phoneFormatNewStudents();
        $this->mkVisitsUp();
//        $this->phoneFormatA1clients();
    }

    public function phoneFormatNewStudents()
    {
        $phones = DB::table('new_students')
//            ->where('sign_date', '>', '2021-10-01 00:00:00')
            ->get();

        foreach ($phones as $phone) {
            $p = preg_replace('/\D/', '', $phone->phone);

            if (trim($phone->phone) !== trim($p)) {
//                echo $phone->phone . ' - ' . $p . '<br>';
                $p = trim($p);
                DB::table('new_students')->where('id', $phone->id)->update(['phone' => $p]);
            } else {
//                echo $phone->phone . ' + ' . $p . '<br>';
            }
        }
        echo 'ok';
    }

    public function mkVisitsUp()
    {
//        INSERT INTO visits( `user_id`, `used_hour`, `abonement_id`, `mk_id`, `visit_status_id`, `date_time`, `comments`, `created_at` ) SELECT users.id, 3.0, NULL, mks.id, NULL, new_students.date_time, new_students.comments, new_students.sign_date FROM new_students LEFT JOIN visits ON visits.created_at = new_students.sign_date JOIN users ON users.phone = new_students.phone JOIN mks ON mks.date_time = new_students.date_time WHERE new_students.date_time > '2021-11-01 00:00:00' AND visits.created_at IS NULL;
//статус надо отдельным запросом
        $vs = DB::table('visits1')
            ->select('new_students.state', 'visits1.comments', 'visits1.id')
            ->where('visit_status_id', '=', NULL)
            ->join('users1', 'users1.id', '=', 'visits1.user_id')
            ->join("new_students", function ($join) {
                $join->on("new_students.name", "=", "users1.name")
                    ->on("new_students.family", "=", "users1.family")
                    ->on("new_students.phone", "=", "users1.phone")
                    ->on("new_students.date_time", "=", "visits1.date_time");
            })
            ->get();

        foreach ($vs as $v) {
            switch ($v->state) {
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

            DB::table('visits1')
                ->where('id', '=', $v->id)
                ->update([
                    'comments' => $v->comments . ' | ' . $v->state,
                    'visit_status_id' => $status
                ]);
        }
        echo 'ok';
    }

    public function userUp()
    {
//по фамилии
        //INSERT INTO users( `username`, `name`, `family`, `patronymic`, `phone`, `email`, `comments`, `cookie_id`, `blist`, `password`, `created_at` ) SELECT LPAD( FLOOR(RAND() * 999999.99), 5, '0'), new_students.name, new_students.family, new_students.surname, new_students.phone, new_students.email, new_students.comments, new_students.user_id, new_students.blist, LPAD( FLOOR(RAND() * 999999.99), 6, '0'), new_students.sign_date FROM new_students LEFT JOIN users ON users.family = new_students.family WHERE new_students.phone <> '' AND new_students.phone IS NOT NULL AND users.family IS NULL;
        //по тел
        //        INSERT INTO users( `username`, `name`, `family`, `patronymic`, `phone`, `email`, `comments`, `cookie_id`, `blist`, `password`, `created_at` ) SELECT LPAD( FLOOR(RAND() * 999999.99), 5, '0'), new_students.name, new_students.family, new_students.surname, new_students.phone, new_students.email, new_students.comments, new_students.user_id, new_students.blist, LPAD( FLOOR(RAND() * 999999.99), 6, '0'), new_students.sign_date FROM new_students LEFT JOIN users ON new_students.phone = users.phone WHERE new_students.sign_date > '2021-10-01 00:00:00' AND users.phone IS NULL GROUP BY `phone` ORDER BY new_students.sign_date DESC;
    }

    public function a1ClientsUp()
    {
//        INSERT INTO users( `username`, `name`, `family`, `patronymic`, `phone`, `email`, `comments`, `cookie_id`, `blist`, `password`, `created_at` ) SELECT LPAD( FLOOR(RAND() * 999999.99), 5, '0'), a1_clients.name, a1_clients.family, a1_clients.patronymic, a1_clients.phone, a1_clients.email, a1_clients.comments, a1_clients.cookie_id, a1_clients.blist, LPAD( FLOOR(RAND() * 999999.99), 6, '0'), a1_clients.reg_date FROM a1_clients LEFT JOIN users ON a1_clients.phone = users.phone WHERE a1_clients.reg_date > '2021-10-01 00:00:00' AND a1_clients.phone IS NOT NULL AND users.phone IS NULL GROUP BY a1_clients.phone ORDER BY a1_clients.reg_date DESC;    }
    }

    public function mkUp()
    {
//        INSERT INTO mks( `date_time`, `pic_id`, `teacher_id`, `price_id` ) SELECT mk_records.rec_date_time, mk_pics.id, teachers.id, prices.id FROM mk_records LEFT JOIN mks ON mks.date_time = mk_records.rec_date_time LEFT JOIN mk_pics ON mk_pics.src = mk_records.rec_img LEFT JOIN teachers ON teachers.folder = mk_records.rec_teacher LEFT JOIN prices ON prices.price = mk_records.rec_price WHERE mk_records.rec_date_time > '2021-10-01 00:00:00' ON DUPLICATE KEY UPDATE `date_time` = mk_records.rec_date_time, `pic_id` = mk_pics.id, `teacher_id` = teachers.id, `price_id` = prices.id;
    }

    public function phoneFormatA1clients()
    {
        $phones = DB::table('a1_clients')
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
                DB::table('a1_clients')
                    ->where('id', $phone->id)
                    ->update(['phone' => $p]);
            } else {
//                echo $phone->phone . '  ' . $p . '<br>';
            }
        }
        echo 'ok';
    }

}
