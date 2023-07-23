<?php
namespace App\Calendars\General;

use App\Models\Calendars\ReserveSettings;
use Carbon\Carbon;
use Auth;

class CalendarWeekDay{
  protected $carbon;

  function __construct($date){
    $this->carbon = new Carbon($date);
  }

  // format()関数に「D」を指定すると「Sun」「Mon」などの曜日を省略形式で取得できます
  function getClassName(){
    return "day-" . strtolower($this->carbon->format("D"));
  }

  //受付終了
  function pastClassName(){
    // $html[] ='受付終了';
    return ;
  }

  /**
   * @return
   */
  // format()関数に「j」を指定すると先頭にゼロをつけない日付けを取得できます。
   function render(){
     return '<p class="day">' . $this->carbon->format("j"). '日</p>';
   }

  //  予約フォーム
   function selectPart($ymd){
    //  １部予約のReserveSettingsモデルのsetting_reserve（開講日）とsetting_part（部）を取得
     $one_part_frame = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '1')->first();
    //  ２部予約のReserveSettingsモデルのsetting_reserve（開講日）とsetting_part（部）を取得
     $two_part_frame = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '2')->first();
     //  ３部予約のReserveSettingsモデルのsetting_reserve（開講日）とsetting_part（部）を取得
     $three_part_frame = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '3')->first();

    //  1部を予約したら
     if($one_part_frame){
      //  ReserveSettingsモデルsetting_partカラムに１を登録
       $one_part_frame = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '1')->first()->limit_users;
     }else{
       $one_part_frame = '0';
     }
    //  ２部を予約したら
     if($two_part_frame){
       //  ReserveSettingsモデルsetting_partカラムに２を登録
       $two_part_frame = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '2')->first()->limit_users;
     }else{
       $two_part_frame = '0';
     }
    //  ３部を予約したら
     if($three_part_frame){
       //  ReserveSettingsモデルsetting_partカラムに３を登録
       $three_part_frame = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '3')->first()->limit_users;
     }else{
       $three_part_frame = '0';
     }

     $html = [];
     $html[] = '<select name="getPart[]" class="border-primary" style="width:60px; border-radius:5px;" form="reserveParts">';
     $html[] = '<option value="" selected></option>';

    //  １部の予約が埋まったら
     if($one_part_frame == "0"){
      //  残り0枠を表示する
       $html[] = '<option value="1" disabled>リモ1部(残り0枠)</option>';
      //  １部の予約が残ってたら
     }else{
      //  残数を表示する
       $html[] = '<option value="1">リモ1部(残り'.$one_part_frame.'枠)</option>';
     }
     //  ２部の予約が埋まったら
     if($two_part_frame == "0"){
       //  残り0枠を表示する
       $html[] = '<option value="2" disabled>リモ2部(残り0枠)</option>';
        //  ２部の予約が残ってたら
     }else{
       //  残数を表示する
       $html[] = '<option value="2">リモ2部(残り'.$two_part_frame.'枠)</option>';
     }
     //  ３部の予約が埋まったら
     if($three_part_frame == "0"){
       //  残り0枠を表示する
       $html[] = '<option value="3" disabled>リモ3部(残り0枠)</option>';
        //  ３部の予約が残ってたら
     }else{
       //  残数を表示する
       $html[] = '<option value="3">リモ3部(残り'.$three_part_frame.'枠)</option>';
     }
     $html[] = '</select>';
     return implode('', $html);
   }

   function getDate(){
     return '<input type="hidden" value="'. $this->carbon->format('Y-m-d') .'" name="getData[]" form="reserveParts">';
   }

   function everyDay(){
     return $this->carbon->format('Y-m-d');
   }

   function authReserveDay(){
     return Auth::user()->reserveSettings->pluck('setting_reserve')->toArray();
   }

  //  予約が登録される
   function authReserveDate($reserveDate){
    //  reserveSettingsモデルのsetting_reserveカラムにユーザー情報を登録
     return Auth::user()->reserveSettings->where('setting_reserve', $reserveDate);
   }

}
