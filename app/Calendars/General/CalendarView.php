<?php
// 設置場所がApp\Calendars\GeneralなのでnamespaceをApp\Calendars\Generalで設定
namespace App\Calendars\General;

// CarbonはLaravelで日付を扱う時に利用可能なライブラリ
use Carbon\Carbon;
use Auth;

// スクール予約
class CalendarView{

  private $carbon;
  // コンストラクタで受け取った日付を元にCarbonオブジェクトを作成
  function __construct($date){
    $this->carbon = new Carbon($date);
  }

  public function getTitle(){
    return $this->carbon->format('Y年n月');
  }

  // カレンダーを出力する
  function render(){
    $html = [];
    $html[] = '<div class="calendar text-center">';
    $html[] = '<table class="table">';
    $html[] = '<thead>';
    $html[] = '<tr>';
    $html[] = '<th>月</th>';
    $html[] = '<th>火</th>';
    $html[] = '<th>水</th>';
    $html[] = '<th>木</th>';
    $html[] = '<th>金</th>';
    $html[] = '<th>土</th>';
    $html[] = '<th>日</th>';
    $html[] = '</tr>';
    $html[] = '</thead>';

    // 週カレンダーの組み込み
    $html[] = '<tbody>';

    // 週カレンダーオブジェクトの配列を取得
    $weeks = $this->getWeeks();

    // 週カレンダーオブジェクトを一週ずつ処理していきます。
    foreach($weeks as $week){
      // 週カレンダーオブジェクトを使ってHTMLのクラス名を出力します。
      $html[] = '<tr class="'.$week->getClassName().'">';

      // 週カレンダーオブジェクトから、日カレンダーオブジェクトの配列を取得します。
      $days = $week->getDays();

      // 日カレンダーオブジェクトをループさせながら、クラス名を出力し、<td>の中に日カレンダーを出力していきます。（60,62,64,88）
      foreach($days as $day){
        $startDay = $this->carbon->copy()->format("Y-m-01");
        $toDay = $this->carbon->copy()->format("Y-m-d");

        // 過去現在と未来をif文を使って分ける
        if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
          //受付終了を表示させる
          $html[] = '<td class="past-day border '.$day->pastClassName().'">';
        }else{
          // 予約フォームを表示する
          $html[] = '<td class="calendar-td '.$day->getClassName().'">';
        }
        $html[] = $day->render();
        // $html[] = $day->dayPartCounts($day->everyDay());

        // 予約内容
        if(in_array($day->everyDay(), $day->authReserveDay())){
          $reservePart = $day->authReserveDate($day->everyDay())->first()->setting_part;
          if($reservePart == 1){
            $reservePart = "リモ1部";
          }else if($reservePart == 2){
            $reservePart = "リモ2部";
          }else if($reservePart == 3){
            $reservePart = "リモ3部";
          }
          if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
            $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px"></p>';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
          }else{
            $html[] = '<button type="submit" class="btn btn-danger p-0 w-75" name="delete_date" style="font-size:12px" value="'. $day->authReserveDate($day->everyDay())->first()->setting_reserve .'">'. $reservePart .'</button>';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
          }
        }else{
          $html[] = $day->selectPart($day->everyDay());
        }
        $html[] = $day->getDate();
        $html[] = '</td>';
      }
      $html[] = '</tr>';
    }

    $html[] = '</tbody>';
    $html[] = '</table>';
    $html[] = '</div>';
    $html[] = '<form action="/reserve/calendar" method="post" id="reserveParts">'.csrf_field().'</form>';
    $html[] = '<form action="/delete/calendar" method="post" id="deleteParts">'.csrf_field().'</form>';

    return implode('', $html);
  }

 //週の情報を取得
  protected function getWeeks(){
    $weeks = [];
    // 初日
    $firstDay = $this->carbon->copy()->firstOfMonth();
    // 月末まで
    $lastDay = $this->carbon->copy()->lastOfMonth();
    // １周目まで
    $week = new CalendarWeek($firstDay->copy());
    $weeks[] = $week;
    // 作業用の日
    $tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();
    // 月末までループさせる
    while($tmpDay->lte($lastDay)){
      $week = new CalendarWeek($tmpDay, count($weeks));
      $weeks[] = $week;
      // 次の週＝7日加える
      $tmpDay->addDay(7);
    }
    return $weeks;
  }
}
