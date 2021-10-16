<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
    use HasFactory;

    public static function getListdayInMonth()
    {
        $arrday = [];
        $month = date('m');
        $year = date('Y');
        for ($day=1; $day <=31 ; $day++) { 
            $time = mktime(12, 0, 0, $month, $day, $year);
            if (date('m',$time) == $month)
             $arrday[] = date('Y-m-d', $time);
        }
        return $arrday;
    }
}
