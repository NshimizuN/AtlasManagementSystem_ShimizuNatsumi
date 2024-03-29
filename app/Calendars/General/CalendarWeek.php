<?php
namespace App\Calendars\General;

use Carbon\Carbon;

class CalendarWeek{
  protected $carbon;
  protected $index = 0;

  function __construct($date, $index = 0){
    $this->carbon = new Carbon($date);
    $this->index = $index;
  }

  function getClassName(){
    return "week-" . $this->index;
  }

  /**
   * @return
   */

   function getDays(){
     $days = [];
    //  開始日〜終了日
     $startDay = $this->carbon->copy()->startOfWeek();
     $lastDay = $this->carbon->copy()->endOfWeek();
    //  作業日
     $tmpDay = $startDay->copy();
    //  月〜日曜日のループ
     while($tmpDay->lte($lastDay)){
       //前の月、もしくは後ろの月の場合は空白を表示
       if($tmpDay->month != $this->carbon->month){
         $day = new CalendarWeekBlankDay($tmpDay->copy());
         $days[] = $day;
         $tmpDay->addDay(1);
         continue;
        }

        // 今月
        $day = new CalendarWeekDay($tmpDay->copy());
        $days[] = $day;

        // 翌月に移動
        $tmpDay->addDay(1);
      }
      return $days;
    }
  }
