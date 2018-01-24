<?php
/**
 * Created by PhpStorm.
 * User: mvdkpj01
 * Date: 1/23/18
 * Time: 10:02 PM
 */

namespace App\Models\Util;


use Carbon\Carbon;

class Calendar
{

    public static function invert_date_to_yyyy_mm_dd($date){
        if(!empty($date))
            return Carbon::parse($date)->format('Y-m-d');
    }
}