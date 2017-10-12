<?php

namespace App\Util;

use Carbon\Carbon;

class DateHelper
{
    public static function getFridays()
    {
        $fridays = [];
        $startDate = Carbon::parse("2017-01-01")->next(Carbon::FRIDAY);
        $endDate = Carbon::parse("2017-12-31");

        for ($date=$startDate; $date->lte($endDate); $date->addWeek()) { 
        	$fridays[] = $date->format('Y-m-d');
        }

        return $fridays;
    }
}
