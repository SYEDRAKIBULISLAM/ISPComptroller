<?php
/**
 * Created by PhpStorm.
 * User: Romeo
 * Date: 8/20/2016
 * Time: 3:51 PM
 */

namespace App\Http\Controllers\Module;


use App\Start_month;
use Carbon\Carbon;

class DateSettings
{
    public $setDay;
    public function __construct(){
        $this->setDay = Start_month::findOrFail(1)->day;
    }
    public function fromDate($thisYear, $thisMonth, $thisDay){
        if ($thisDay < $this->setDay){
            if($thisMonth == 1){
                $year = $thisYear - 1;
                $month = 12;
            }
            else{
                $year = $thisYear;
                $month = $thisMonth - 1;
            }
            $day = $this->setDay;
        }
        else {
            $year = $thisYear;
            $month = $thisMonth;
            $day = $this->setDay;
        }
        return  Carbon::createFromDate($year, $month, $day);

    }
    public function toDate($thisYear, $thisMonth, $thisDay){
        if ($thisDay > $this->setDay - 1){
            if($thisMonth == 12){
                $year = $thisYear + 1;
                $month = 1;
            }
            else{
                $year = $thisYear;
                $month = $thisMonth + 1;
            }
            $day = $this->setDay - 1;
        }
        else {
            $year = $thisYear;
            $month = $thisMonth;
            $day = $this->setDay - 1;
        }
        return Carbon::createFromDate($year, $month, $day);
    }
}