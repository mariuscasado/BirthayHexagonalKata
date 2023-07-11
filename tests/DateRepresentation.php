<?php

use App\OurDate;

class DateRepresentation
{
    public static function toOurDate(string $date = null): OurDate
    {
        $dateTime = DateTime::createFromFormat('Y/m/d H:i:s', $date . ' 00:00:00');
        return new OurDate($date, $dateTime);
    }

}