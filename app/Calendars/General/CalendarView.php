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

  // タイトル（該当年月）を作成
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

        // ①予約登録ができたら
        if(in_array($day->everyDay(), $day->authReserveDay())){
          // ①②を表示させる
          $reservePart = $day->authReserveDate($day->everyDay())->first()->setting_part;
          // ②1部の予約が完了したら
          if($reservePart == 1){
            // ②「リモ1部」と表示する
            $reservePart = "リモ1部";
            // ②2部の予約が完了したら
          }else if($reservePart == 2){
            // ②「リモ2部」と表示する
            $reservePart = "リモ2部";
            // ②3部の予約が完了したら
          }else if($reservePart == 3){
            // ②「リモ3部」と表示する
            $reservePart = "リモ3部";
          }
          // ③過去現在なら
          if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
            $html[] = '<p class="m-auto p-0 w-75" style="font-size:14px  value="'. $day->authReserveDate($day->everyDay())->first()->setting_reserve .'" >'. $reservePart .'</p>';
            // ③未来なら
          }else{
            // ③「リモ○」と表示する
            // $html[] = '<a href="/delete/calendar">';
            // $html[]='<form action="{{ route('deleteParts', ['id' => $reserve_settings->id]) }}" method="POST">'
            $html[] = '<button type="submit" id="edit-modal-open" class="delete-modal-open btn btn-danger p-0 w-75" getData="{{ $getData->getData }}" getPart="{{ $getPart->getPart }}" reserve_settings="{{ $reserve_settings->reserve_settings }}  name="delete_date" style="font-size:12px" value="'. $day->authReserveDate($day->everyDay())->first()->setting_reserve .'" >'. $reservePart .'</button>';
            // $html[]='</form>'
            // $html[] = '</a>';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
          }
          // ①予約をしなかったら
        }else{
          // ④過去・当日なら
          if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
            // ④「受付終了」を表示する
            $html[] = '<p class="m-auto p-0 w-75" style="font-size:14px">受付終了</p>';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
            // ④未来なら
          }else{
          // ④予約フォームを表示
           $html[] = $day->selectPart($day->everyDay());
          }
        }
        $html[] = $day->getDate();
        // dd($day);
        // $html[] = $reservePart->getPart();
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
