<?php

function DateFormate($date='', $formated_date=''){
    $newDate = \Carbon\Carbon::parse($date)->translatedFormat($formated_date);
        return mb_strtolower($newDate);
}

function PlacesText($qnt='')
{
    if ($qnt == 1) {
        $text = 'место';
    }else if ($qnt == 2 OR $qnt == 3 OR $qnt == 4) {
        $text = 'места';
    }else if ($qnt == 0 OR $qnt == 5 OR $qnt == 6 OR $qnt == 7 OR $qnt == 8) {
        $text = 'мест';
    }else{
        $text = 'мест';
    }

    return $text;
}
