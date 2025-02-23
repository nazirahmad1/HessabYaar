<?php

namespace App\Services;
use Morilog\Jalali\Jalalian;

class GetTodayDate
{
    public static function todayDate()
    {
          // Get today's Jalali date
          $date = Jalalian::now();
          $today_date = $date->getYear() . "/" . $date->getMonth() . "/" . $date->getDay();

        return $today_date;
    }
}


