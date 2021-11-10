<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

//Статусы
//Наименование
//Описание
//Промежуточный
//NEW
//Создан
//Нет
//FORM_SHOWED
//Платежная форма открыта покупателем
//Нет
//DEADLINE_EXPIRED
//Просрочен
//Нет
//CANCELED
//Отменен
//Нет
//PREAUTHORIZING
//Проверка платежных данных
//Да
//AUTHORIZING
//Резервируется
//Да
//AUTHORIZED
//Зарезервирован
//Нет
//AUTH_FAIL
//Не прошел авторизацию
//Да
//REJECTED
//Отклонен
//Нет
//3DS_CHECKING
//Проверяется по протоколу 3-D Secure
//Нет
//3DS_CHECKED
//Проверен по протоколу 3-D Secure
//Да
//REVERSING
//Резервирование отменяется
//Да
//PARTIAL_REVERSED
//Резервирование отменено частично
//Нет
//REVERSED
//Резервирование отменено
//Нет
//CONFIRMING
//Подтверждается
//Да
//CONFIRMED
//Подтвержден
//Нет
//REFUNDING
//Возвращается
//Да
//PARTIAL_REFUNDED
//Возвращен частично
//Нет
//REFUNDED
//Возвращен полностью
//Нет
}
